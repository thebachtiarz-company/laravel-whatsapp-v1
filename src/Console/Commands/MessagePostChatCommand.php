<?php

declare(strict_types=1);

namespace TheBachtiarz\WhatsApp\Console\Commands;

use TheBachtiarz\Base\App\Console\Commands\AbstractCommand;
use TheBachtiarz\WhatsApp\Services\WhatsAppMessageService;

use function explode;

class MessagePostChatCommand extends AbstractCommand
{
    /**
     * Constructor
     */
    public function __construct(
        protected WhatsAppMessageService $whatsAppMessageService,
    ) {
        $this->signature    = 'whatsapp:message:post:chat
                                {--groupIds= : Group(s) ID (multiple with comma)}
                                {--personIds= : Person(s) ID (multiple with comma)}
                                {--message= : Body message}';
        $this->commandTitle = 'Send whatsapp message';
        $this->description  = 'Send whatsapp notification to message apps';

        parent::__construct();
    }

    // ? Public Methods

    public function commandProcess(): bool
    {
        $this->whatsAppMessageService
            ->setPersonIds(explode(separator: ',', string: $this->option('groupIds') ?? ''))
            ->setGroupIds(explode(separator: ',', string: $this->option('personIds') ?? ''))
            ->setMessage($this->option('message'))
            ->sendMessage();

        return true;
    }

    // ? Protected Methods

    // ? Private Methods

    // ? Getter Modules

    // ? Setter Modules
}
