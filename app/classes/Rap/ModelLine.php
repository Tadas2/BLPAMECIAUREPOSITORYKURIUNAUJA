<?php

namespace App\Rap;

class ModelLine {

    protected $table_name;

    /**
     *
     * @var \Core\FileDB
     */
    protected $db;

    public function __construct(\Core\FileDB $db, $table_name) {
        $this->table_name = $table_name;
        $this->db = $db;
    }

    public function load($email) {
        $data_row = $this->db->getRow($this->table_name, $email);
        if ($data_row) {
            return new Line($data_row);
        }
    }

    public function insert(Line $line) {
        if (!$this->exists($line)) {
            $this->db->setRow($this->table_name, microtime(), $line->getData());
            $this->db->save();

            return true;
        }
    }

    public function update(Line $line) {
        if ($this->exists($line)) {
            $this->db->setRow($this->table_name, microtime(), $line->getData());
            $this->db->save();

            return true;
        }
    }

    public function delete(Line $line) {
        if ($this->exists($line)) {
            $this->db->deleteRow($this->table_name, $line->getEmail());
            $this->db->save();

            return true;
        }
    }

    public function loadAll() {
        $line_masyvas = [];
        foreach ($this->db->getRows($this->table_name) as $line) {
            $line_masyvas[] = new Line($line);
        }

        return $line_masyvas;
    }

    public function deleteAll() {
        if ($this->db->deleteRows($this->table_name)) {
            $this->db->save();
            return true;
        }
    }

    public function getCount() {
        $get_count = $this->db->getCount($this->table_name);
        if ($get_count) {
            return $get_count;
        }

        return 0;
    }

    public function exists(Line $line) {
        return $this->db->rowExists($this->table_name, $line->getEmail());
    }

}
