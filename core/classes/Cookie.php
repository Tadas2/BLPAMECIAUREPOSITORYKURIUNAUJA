<?php

namespace Core;

class Cookie extends Abstracts\Cookie {

    public function __construct(string $name) {
        $this->name = $name;
    }

    public function delete(): void {
        
    }

    public function exists(): bool {
        return isset($_COOKIE[$this->name]);
    }

    public function read(): array {
        
    }

    public function save($data, $expires_in = 3600): void {
        
    }

}
?>

