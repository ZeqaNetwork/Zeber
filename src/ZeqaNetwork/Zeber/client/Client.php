<?php

declare(strict_types=1);

namespace ZeqaNetwork\Zeber\client;

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
    }
}