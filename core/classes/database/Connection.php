<?php

namespace Core\Database;

use PDO;

class Connection extends \Core\Database\Abstracts\Connection {

    public function __construct($creds) {
        $this->pdo = null;
        $this->setCredentials($creds);
    }

    /**
     * Connect To Database
     * #1 Reikia patikrinti ar $this->pdo nera null (jeigu null, vadinasi jau priconnectinom)
     * #2 Jei ne, sukurti $this->pdo = new PDO ...
     * #3 Jeigu globaline konstanta DEBUG yra nustatyta, executinti šias dvi eilutes
     *  $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     *  $this->pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, true);
     * Jeigu nepavyko sukurti PDO instancijos, throw'inti exceptioną panaudojant try, catch
     * @throws Exception
     */
    public function connect() {
        if (!$this->pdo) {
            try {
                $this->pdo = new \PDO(
                        "mysql:host=$this->host", $this->user, $this->pass);

                if (DEBUG) {
                    $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $this->pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, true);
                }
            } catch (\PDOException $exception) {
                throw new \PDOException('could not connect to database');
            }
        }
    }

}
