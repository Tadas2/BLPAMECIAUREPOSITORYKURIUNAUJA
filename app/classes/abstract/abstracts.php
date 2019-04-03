<?php

namespace App\abstracts;

abstract class Sensor {

    private $reading;

    abstract public function read();

    protected function getLastReading() {
        return $this->reading;
    }

}
?>

