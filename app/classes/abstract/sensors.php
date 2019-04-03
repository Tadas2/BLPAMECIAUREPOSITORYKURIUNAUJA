<?php

namespace App\sensors;

class Sensors {

    private $id;
    private $sensors;

    public function __construct() {
        $this->sensors = [];
    }

    public function add($id, \App\abstracts\Sensor $sensor) {
        $this->sensors[$id] = $sensor;
    }

    public function setReading($id) {
        
    }

    public function getReading($id) {
        return $this->sensors[$id]->read();
    }

    public function setReadings() {
        
    }

    public function getReadings() {
        $readings = [];

        foreach ($this->sensors as $id => $sensor) {
            $readings[$id] = $sensor->read();
        }

        return $readings;
    }

}
?>

