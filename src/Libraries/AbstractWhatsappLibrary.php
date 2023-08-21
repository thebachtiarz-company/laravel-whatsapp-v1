<?php

declare(strict_types=1);

namespace TheBachtiarz\WhatsApp\Libraries;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http as CURL;
use TheBachtiarz\Base\App\Libraries\Curl\AbstractCurl;
use TheBachtiarz\Base\App\Libraries\Curl\Data\CurlResponse;
use TheBachtiarz\Base\App\Libraries\Curl\Data\CurlResponseInterface;
use Throwable;

use function array_merge;
use function assert;
use function count;
use function sprintf;

abstract class AbstractWhatsappLibrary extends AbstractCurl
{
    // ? Public Methods

    // ? Protected Methods

    protected function sendRequest(string $method): CurlResponseInterface
    {
        $pendingRequest = $this->curl();

        if ($this->token) {
            $pendingRequest->withToken($this->token);
        }

        if ($this->userAgent) {
            $pendingRequest->withUserAgent($this->userAgent);
        }

        $response = $pendingRequest->{$method}($this->urlDomainResolver(), $this->bodyDataResolver());
        assert($response instanceof Response);

        return $this->customResponse($response);
    }

    protected function urlDomainResolver(): string
    {
        return sprintf(
            '%s/%s/%s',
            tbwaconfig('api_base_url'),
            tbwaconfig('instance_id'),
            $this->getSubUrl(),
        );
    }

    protected function bodyDataResolver(): array
    {
        $this->body['token']    = tbwaconfig('token');
        $this->body['priority'] = tbwaconfig('message_priority');

        return $this->body;
    }

    /**
     * Custom request curl response
     */
    protected function customResponse(Response $response): CurlResponseInterface
    {
        $result = new CurlResponse();
        assert($result instanceof CurlResponseInterface);

        try {
            $response = $response->json();

            $result = new CurlResponse($response);
        } catch (Throwable $th) {
            $this->logInstance()->log($th, 'curl');

            $result->setMessage($th->getMessage());
        } finally {
            // $this->logInstance()->log(json_encode($result->toArray()), 'curl');

            return $result;
        }
    }

    // ? Private Methods

    /**
     * Request curl init
     */
    private function curl(): PendingRequest
    {
        $headers = ['Accept' => 'application/json'];

        if (count($this->header)) {
            $headers = array_merge($headers, $this->header);
        }

        return CURL::withHeaders($headers);
    }

    // ? Getter Modules

    // ? Setter Modules
}
