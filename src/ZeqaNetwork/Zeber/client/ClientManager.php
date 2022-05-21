<?php

declare(strict_types=1);

namespace ZeqaNetwork\Zeber\client;

class ClientManager{

    /** @var Client[] */
    public static array $clients = [];

    public static function add(Client $client) : void{
        self::$clients[$client->getId()] = $client;
    }

    public static function remove(Client $client) : void{
        unset(self::$clients[$client->getId()]);
    }

    public static function get(int $id) : ?Client{
        return self::$clients[$id] ?? null;
    }
}