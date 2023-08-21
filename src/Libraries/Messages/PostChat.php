<?php

declare(strict_types=1);

namespace TheBachtiarz\WhatsApp\Libraries\Messages;

use TheBachtiarz\Base\App\Libraries\Curl\CurlInterface;
use TheBachtiarz\Base\App\Libraries\Curl\Data\CurlResponseInterface;
use TheBachtiarz\WhatsApp\Libraries\AbstractWhatsappLibrary;

class PostChat extends AbstractWhatsappLibrary implements CurlInterface
{
    // ? Public Methods

    public function execute(array $data = []): CurlResponseInterface
    {
        return $this->setHeader(['Content-Type' => 'application/x-www-form-urlencoded'])
            ->setSubUrl('messages/chat')
            ->setBody($data)
            ->get();
    }

    // ? Protected Methods

    // ? Private Methods

    // ? Getter Modules

    // ? Setter Modules
}
