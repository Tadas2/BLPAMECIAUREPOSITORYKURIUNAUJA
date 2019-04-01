<?php

namespace App\Model;

use App\User;
use Core\FileDB;

/**
 * Class for working between database class and "User" class.
 */
class ModelUser {

    /**
     * @var type string Name of a table
     */

    private $table_name;
    /**
     * @var type class FileDB
     */
    private $db;

    /**
     * ModelUsers constructor.
     * @param FileDB $db
     * @param $table_name
     */
    public function __construct(FileDB $db, $table_name) {
        $this->table_name = $table_name;
        $this->db = $db;
    }

    /**
     * Loads the specific user from given ID
     * @param type string $id
     * @return User|bool
     */
    public function load($id) {
        $data_row = $this->db->getRow($this->table_name, $id);

        if ($data_row) {
            return new User($data_row);
        } else {
            return false;
        }
    }

    /**
     * Checks if row by this ID exists and Inserts specific row into given table and saves it.
     * @param type string $id
     * @param User $user
     * @return bool
     */
    public function insert($id, User $user) {
        if (!$this->db->getRow($this->table_name, $id)) {
            $this->db->setRow($this->table_name, $id, $user->getData());
            $this->db->save();

            return true;
        } else {
            return false;
        }
    }

    /**
     * Checks if row by this ID exists and Updates specific row into given table and saves it.
     * @param type string $id
     * @param User $user
     * @return bool
     */
    public function update($id, User $user) {
        if ($this->db->getRow($this->table_name, $id)) {
            $this->db->setRow($this->table_name, $id, $user->getData());
            $this->db->save();

            return true;
        } else {
            return false;
        }
    }

    /**
     * Deletes given row by the ID and saves into the database.
     * @param $id
     * @return bool
     */
    public function delete($id) {
        if ($this->db->getRow($this->table_name, $id)) {
            $this->db->deleteRow($this->table_name, $id);
            $this->db->save();

            return true;
        } else {
            return false;
        }
    }

    /**
     * Loads all the rows from given table as array of objects.
     * @return array
     */
    public function loadAll() {
        $user_array = [];

        foreach ($this->db->getRows($this->table_name) as $user) {
            $user_array[] = new User($user);
        }

        return $user_array;
    }

    /**
     * Deletes all the rows from the given table, and saves into the database.
     * @return bool
     */
    public function deleteAll() {
        if ($this->db->deleteRows($this->table_name)) {
            $this->db->save();

            return true;
        } else {
            return false;
        }
    }
}