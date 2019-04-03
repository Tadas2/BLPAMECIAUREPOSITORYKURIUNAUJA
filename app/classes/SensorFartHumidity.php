<?php

class SensorFartHumidity extends App\abstracts\Sensor {

    public function read() {
        $this->reading = rand(1, 100) . '%';
        return $this->reading;
    }

}
?>

