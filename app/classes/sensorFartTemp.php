<?php
class SensorFartTemp extends App\abstracts\Sensor {
    
    public function read() {
        return rand(365, 425) / 100;
    }

} 
?>

