<?php

declare(strict_types=1);

namespace ZeqaNetwork\Zeber;

use pocketmine\plugin\PluginBase;
use ZeqaNetwork\Zeber\network\PacketDecoder;
use ZeqaNetwork\Zeber\network\PacketEncoder;
use ZeqaNetwork\Zeber\network\ZeberServerManager;
use ZeqaNetwork\Zeber\network\ZeberNetSession;

class Zeber extends PluginBase{

    public function onEnable(): void{
        $cfg = $this->getConfig();

        $server = new ZeberServerManager(
            $cfg->get("listen_address", "0.0.0.0"),
            (int) $cfg->get("listen_port", 5770),
            ZeberNetSession::class,
            PacketEncoder::class,
            PacketDecoder::class
        );
        $server->start();
    }
}