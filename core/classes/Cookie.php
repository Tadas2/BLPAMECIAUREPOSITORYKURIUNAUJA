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

        $json_cookie = [];

        if ($this->exists()) {
            $json_cookie = json_decode($_COOKIE[$this->name], true);
            if ($json_cookie !== null) {
                return $json_cookie;
            } else {
                trigger_error('Nepaejo', E_USER_WARNING);
                return $json_cookie;
            }
        }
        return $json_cookie;
    }

    public function save($data, $expires_in = 3600): void {

        setcookie($this->name, json_encode($data), time() + $expires_in);
    }

}
?>

