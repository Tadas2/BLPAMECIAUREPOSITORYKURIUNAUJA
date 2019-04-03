<?php

namespace App\abstracts;

abstract class Sensor {

    private $reading;

    abstract protected function read();

    protected function getLastReading() {
        return read();
    }

}
?>

