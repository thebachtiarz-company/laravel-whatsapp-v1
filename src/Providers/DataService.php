<?php

namespace TheBachtiarz\Whatsapp\Providers;

use TheBachtiarz\Base\BaseConfigInterface;
use TheBachtiarz\Whatsapp\Interfaces\Configs\WhatsappConfigInterface;

class DataService
{
    /**
     * List of config who need to registered into current project
     *
     * @return array
     */
    public function registerConfig(): array
    {
        $registerConfig = [];

        $configRegistered = tbbaseconfig(BaseConfigInterface::CONFIG_REGISTERED);
        $registerConfig[] = [
            BaseConfigInterface::CONFIG_NAME . '.' . BaseConfigInterface::CONFIG_REGISTERED => array_merge(
                $configRegistered,
                [WhatsappConfigInterface::CONFIG_NAME],
            ),
        ];

        return $registerConfig;
    }
}
