<?php

declare(strict_types=1);

use TheBachtiarz\WhatsApp\Interfaces\Configs\WhatsAppConfigInterface;

if (! function_exists('tbwaconfig')) {
    /**
     * TheBachtiarz whatsapp config
     *
     * @param string|null $keyName   Config key name | null will return all
     * @param bool|null   $useOrigin Use original value from config
     */
    function tbwaconfig(string|null $keyName = null, bool|null $useOrigin = true): mixed
    {
        $configName = WhatsAppConfigInterface::CONFIG_NAME;

        return tbconfig($configName, $keyName, $useOrigin);
    }
}
