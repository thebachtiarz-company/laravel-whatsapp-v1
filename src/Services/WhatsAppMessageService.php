<?php

declare(strict_types=1);

namespace TheBachtiarz\WhatsApp\Services;

use TheBachtiarz\Base\App\Services\AbstractService;
use TheBachtiarz\WhatsApp\Libraries\CurlWhatsappLibrary;
use Throwable;

use function array_merge;
use function implode;

class WhatsAppMessageService extends AbstractService
{
    /**
     * Groups ids
     *
     * @var array
     */
    protected array $groupIds = [];

    /**
     * Person ids
     *
     * @var array
     */
    protected array $personIds = [];

    /**
     * Message
     */
    protected string $message = '';

    /**
     * Constructor
     */
    public function __construct(
        protected CurlWhatsappLibrary $curlWhatsappLibrary,
    ) {
    }

    // ? Public Methods

    /**
     * Send whatsapp message
     *
     * @return array
     */
    public function sendMessage(): array
    {
        try {
            $params = [
                'to' => implode(separator: ',', array: array_merge($this->getPersonIds(), $this->getGroupIds())),
                'body' => $this->getMessage(),
            ];

            $this->curlWhatsappLibrary->execute(CurlWhatsappLibrary::MESSAGES_POST_CHAT, $params);

            $this->setResponseData(message: 'Sending OK', data: '', httpCode: 200);

            return $this->serviceResult(status: true, message: 'Sending OK', data: '');
        } catch (Throwable $th) {
            $this->log(log: $th, channel: 'curl');

            $this->setResponseData(message: $th->getMessage());

            return $this->serviceResult(message: $th->getMessage());
        }
    }

    // ? Protected Methods

    // ? Private Methods

    // ? Getter Modules

    /**
     * Get group ids
     */
    public function getGroupIds(): array
    {
        return $this->groupIds;
    }

    /**
     * Get person ids
     */
    public function getPersonIds(): array
    {
        return $this->personIds;
    }

    /**
     * Get message
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    // ? Setter Modules

    /**
     * Add group id
     */
    public function addGroupId(string $groupId): self
    {
        $this->groupIds[] = $groupId;

        return $this;
    }

    /**
     * Set group ids
     */
    public function setGroupIds(array $groupIds): self
    {
        $this->groupIds = $groupIds;

        return $this;
    }

    /**
     * Add person id
     */
    public function addPersonId(string $personId): self
    {
        $this->personIds[] = $personId;

        return $this;
    }

    /**
     * Set person ids
     */
    public function setPersonIds(array $personIds): self
    {
        $this->personIds = $personIds;

        return $this;
    }

    /**
     * Set message
     */
    public function setMessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }
}
