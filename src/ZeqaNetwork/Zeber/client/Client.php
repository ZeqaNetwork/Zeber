<?php

declare(strict_types=1);

namespace ZeqaNetwork\Zeber\client;

use ZeqaNetwork\Zeber\network\PacketId;
use ZeqaNetwork\Zeber\network\types\LoginInfo;
use ZeqaNetwork\Zeber\network\ZeberNetSession;

class Client{

    public function __construct(
        private ZeberNetSession $session,
        private int $id,
        private string $name,
        private int $type
    ) {
    }

    public function getNetSession(): ZeberNetSession{
        return $this->session;
    }

    public function getId(): int{
        return $this->id;
    }

    public function getName(): string{
        return $this->name;
    }

    public function getType(): int{
        return $this->type;
    }

    public function isServer(): bool{
        return $this->type === LoginInfo::TYPE_SERVER;
    }

    public function isProxy(): bool{
        return $this->type === LoginInfo::TYPE_PROXY;
    }

    public function handlePacket(string $id, mixed $data){
        switch($id) {
            case PacketId::FORWARD:
                $this->handleForward($data);
                break;
        }
    }

    public function sendPacket(string $id, mixed $data) {
        $this->session->sendPacket([
            "id" => $id,
            "data" => $data
        ]);
    }

    private function handleForward(array $data) {
        $target = $data["target"];

        $targetClient = ClientManager::getByName($target);
        $targetClient?->sendPacket(PacketId::FORWARD, $data);
    }
}