<?php

declare(strict_types=1);

namespace TheBachtiarz\WhatsApp\Libraries;

use TheBachtiarz\Base\App\Libraries\Curl\CurlLibrary;
use TheBachtiarz\WhatsApp\Libraries\Messages\PostChat;

class CurlWhatsappLibrary extends CurlLibrary
{
    public const MESSAGES_POST_CHAT = 'messages-post-chat';

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->classEntity = [
            self::MESSAGES_POST_CHAT => PostChat::class,
        ];
    }

    // ? Public Methods

    // ? Protected Methods

    // ? Private Methods

    // ? Getter Modules

    // ? Setter Modules
}
