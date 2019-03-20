<?php

class Jacuzzi {

    public $amount_water;
    public $amount_non_water;

    public function __construct($vanduo = 0, $biski_ne_vanduo = 0) {
        $this->amount_water = $vanduo;
        $this->amount_non_water = $biski_ne_vanduo;
    }

    public function getWaterPurity() {
        return $this->amount_water / ($this->amount_water + $this->amount_non_water) * 100;
    }

}

$Jacuzzi = new Jacuzzi(100, 100);
print $Jacuzzi->getWaterPurity();
