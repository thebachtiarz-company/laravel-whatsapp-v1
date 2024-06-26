<?php

declare(strict_types=1);

namespace TheBachtiarz\WhatsApp\Providers;

use TheBachtiarz\Base\BaseConfigInterface;
use TheBachtiarz\WhatsApp\Interfaces\Configs\WhatsAppConfigInterface;

use function array_merge;
use function tbbaseconfig;

class DataService
{
    /**
     * List of config who need to registered into current project
     */
    public function registerConfig(): array
    {
        $registerConfig = [];

        $configRegistered = tbbaseconfig(BaseConfigInterface::CONFIG_REGISTERED);
        $registerConfig[] = [
            BaseConfigInterface::CONFIG_NAME . '.' . BaseConfigInterface::CONFIG_REGISTERED => array_merge(
                $configRegistered,
                [WhatsAppConfigInterface::CONFIG_NAME],
            ),
        ];

        return $registerConfig;
    }
}
