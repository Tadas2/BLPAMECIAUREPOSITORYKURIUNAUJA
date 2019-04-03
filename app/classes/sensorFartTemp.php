<?php

class SensorFartTemp extends App\abstracts\Sensor {
    
    
    public function read() {
        $this->reading = rand(365, 425) / 10;
        return $this->reading;
    }

}
?>

