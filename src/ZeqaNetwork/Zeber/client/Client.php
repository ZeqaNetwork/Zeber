<?php

declare(strict_types=1);

namespace ZeqaNetwork\Zeber\client;

use ZeqaNetwork\Zeber\network\ZeberNetSession;

class Client{

    public function __construct(
        private ZeberNetSession $session,
        private int $id
    ) {

    }

    public function getNetSession(): ZeberNetSession{
        return $this->session;
    }

    public function getId(): int{
        return $this->id;
    }
}