<?php

declare(strict_types=1);

namespace ZeqaNetwork\Zeber\network;

use AkmalFairuz\Sobana\server\ServerSession;
use pocketmine\utils\Utils;
use ZeqaNetwork\Zeber\client\Client;
use ZeqaNetwork\Zeber\client\ClientManager;
use function igbinary_unserialize;
use function json_encode;
use function json_last_error_msg;

class ZeberNetSession extends ServerSession{

    private Client $client;

    public function onConnect(): void{
        ClientManager::add($this->client = new Client($this, $this->getId()));
    }

    public function sendPacket(array $data) {
        $this->write(Utils::assumeNotFalse(json_encode($data), "Failed to encode JSON: " . json_last_error_msg()));
    }

    public function handlePacket(string $packet): void{
        $decoded = igbinary_unserialize($packet);
    }

    public function onClose(): void{
        ClientManager::remove($this->client);
    }
}