<?php

namespace App;

class Gerimas {

    /**
     * @var array
     */
    private $data;

    /**
     * Gerimas constructor.
     * @param null $data
     */
    public function __construct($data = null) {
        if (!$data) {
            $this->data = [
                'name' => null,
                'abarot' => null,
                'amount' => null,
                'photo' => null
            ];
        } else {
            $this->setData($data);
        }
    }

    /**
     * @param string $name
     */
    public function setName(string $name) {
        $this->data['name'] = $name;
    }

    /**
     * @return mixed
     */
    public function getName() {
        return $this->data['name'];
    }

    /**
     * @param float $abarot
     */
    public function setAbarot(float $abarot) {
        $this->data['abarot'] = $abarot;
    }

    /**
     * @return mixed
     */
    public function getAbarot() {
        return $this->data['abarot'];
    }

    /**
     * @param int $amount
     */
    public function setAmount(int $amount) {
        $this->data['amount'] = $amount;
    }

    /**
     * @return mixed
     */
    public function getAmount() {
        return $this->data['amount'];
    }

    /**
     * @param string $photo
     */
    public function setPhoto(string $photo) {
        $this->data['photo'] = $photo;
    }

    /**
     * @return mixed
     */
    public function getPhoto() {
        return $this->data['photo'];
    }

    /**
     * @param array $data
     */
    public function setData(array $data) {
        $this->setName($data['name'] ?? '');
        $this->setAbarot($data['abarot'] ?? '');
        $this->setAmount($data['amount'] ?? '');
        $this->setPhoto($data['photo'] ?? '');
    }

    /**
     * @return array
     */
    public function getData() {
        return $this->data;
    }
}