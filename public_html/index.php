<?php

declare(strict_types = 1);

class FileDb {

    private $file_uri;
    private $data;

    public function __construct($file_uri) {
        $this->file_uri = $file_uri;
        $this->data = null;
        $this->load();
    }

    public function setRow($table, $row_id, $row_data) {
        $this->data[$table][$row_id] = $row_data;
    }

    public function setRowColumn($table, $row_id, $column_id, $column_data) {
        $this->data[$table][$row_id][$column_id] = $column_data;
    }

    public function getRow($table, $row_id) {
        return $this->data[$table][$row_id];
    }

    public function getRowColumn($table, $row_id, $column_id) {
        return $this->data[$table][$row_id][$column_id];
    }

    public function load() {
        if (!file_exists($this->file_uri)) {
            $this->data = [];
        } else {
            $json_data = file_get_contents($this->file_uri);
            $this->data = json_decode($json_data, true);
        }
    }

    public function save() {
        $data_json = json_encode($this->data);
        if (file_put_contents($this->file_uri, $data_json)) {
            return true;
        } else {
            throw new Exception('Neisejo issaugoti i faila.');
        }
    }

}

class Gerimas {

    private $data;

    public function __construct($data = null) {
        if (!$data) {
            $this->data = [
                'name' => null,
                'amount_ml' => null,
                'abarot' => null
            ];
        } else {
            $this->setData($data);
        }
    }

    public function setName(string $name) {
        $this->data['name'] = $name;
    }

    public function getName($name) {
        return $this->data['name'];
    }

    public function setAmount(int $amount_ml) {
        $this->data['amount_ml'] = $amount_ml;
    }

    public function getAmount($amount_ml) {
        return $this->data['amount_ml'];
    }

    public function setAbarot(float $abarot) {
        $this->data['abarot'] = $abarot;
    }

    public function getAbarot($abarot) {
        return $this->data['abarot'];
    }

    public function getData() {
        return $this->data;
    }

    public function setData(array $data) {
        $this->setName($data['name'] ?? null);
        $this->setAmountMl($data['amount_ml'] ?? null);
        $this->setAbarot($data['abarot'] ?? null);
    }

}
class ModelGerimai {
    
}
