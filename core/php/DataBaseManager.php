<?php

/**
 * Created by PhpStorm.
 * User: Andre
 * Date: 07/02/2016
 * Time: 07:55 PM
 */
// define('SERVER', 'localhost');
// define('USERNAME', 'root');
// define('PASSWORD', 'liverpool');
// define('DB', 'memorama');

class DataBaseManager {

    private $mysqli;
    private static $_instance = null;

    /**
     * DataBaseManager constructor.
     */
    private function __construct() {
        $server = getenv('DB_SERVER');
        $username = getenv('DB_USERNAME');
        $password = getenv('DB_PASSWORD');
        $db = getenv('DB_NAME');
        $port = getenv('DB_PORT');

        $this->mysqli = new mysqli($server, $username, $password, $db, $port);
        // $this->mysqli = new mysqli(SERVER, USERNAME, PASSWORD, DB);
        if ($this->mysqli->connect_errno) {
            echo "Fallo al conectar a MySQL: (" . $this->mysqli->connect_errno . ") " . $this->mysqli->connect_error;
        }

        if (!$this->mysqli->set_charset('utf8')) {
            printf("Error cargando el conjunto de caracteres utf8: %s\n", $this->mysqli->error);
            exit;
        }
    }

    public function __destruct() {
        self::$_instance = null;
        $this->mysqli = null;
    }

    public static function getInstance() {
        if (self::$_instance === null) {
            self::$_instance = new DataBaseManager();
        }
        return self::$_instance;
    }

    final public function __clone() {
        throw new Exception('Only one instance is allowed');
    }

    public function insertQuery($query) {
        return $this->mysqli->query($query);
    }

    public function realizeQuery($query) {
        if ($result = $this->mysqli->query($query)) {
            $result = $result->fetch_all(MYSQLI_ASSOC);
            return $result;
        } else {
            return null;
        }
    }

    public function prepare($query) {
        return $this->mysqli->prepare($query);
    }

    public function close() {
        $this->mysqli->close();
    }

}
