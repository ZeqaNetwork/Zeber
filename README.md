# Zeber

### Requirements
https://github.com/AkmalFairuz/Sobana

### Usage
- Sending Packet
```php
// Send packet by client name
ClientManager::getByName("AS1-Practice")?->sendPacket(
    ForwardBuilder::create(
        "zeber", 
        [
            "action" => "broadcast_message", 
            "message" => "Hi"
        ]
    )
);
```
- Handling Packet
```php
    // ZeberNetSession.php
    // ...
    public function handlePacket(string $packet): void{
        foreach(igbinary_unserialize($packet) as $p){
            $id = $p["id"];
            $data = $p["data"];
            if($this->authenticated){
                $this->client->handlePacket($id, $data);
            }else{
                switch($id){
                    case PacketId::LOGIN:
                        $loginInfo = LoginInfo::create($data);
                        $name = $loginInfo->name;
                        if(ClientManager::getByName($name) !== null) {
                            $this->sendPacket(PacketBuilder::create(PacketId::AUTH, false));
                            $this->close();
                            break;
                        }
                        ClientManager::add($this->client = new Client($this, $this->getId(), $name, $loginInfo->type));
                        $this->authenticated = true;
                        break;
                }
            }
        }
    }
    // ...
```