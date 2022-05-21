<?php

declare(strict_types=1);

namespace ZeqaNetwork\Zeber\network;

class PacketId{

    // Login Information (name, server or proxy)
    const LOGIN = "login";
    // Forward packet to another client
    const FORWARD = "forward";
}