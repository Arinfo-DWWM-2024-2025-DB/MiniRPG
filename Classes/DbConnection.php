<?php

class DbConnection {
    private $db;

    public function __construct() {
        try {
            if ($GLOBALS['__DB_CONN'] == null) {
                $GLOBALS['__DB_CONN'] = new PDO('mysql:host=localhost;dbname=minirpg', 'root', '');
                $GLOBALS['__DB_CONN']->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
        } catch (PDOException $e) {
            die('Erreur construction DB : ' . $e->getMessage());
        }
    }

    public function getDb() {
        return $GLOBALS['__DB_CONN'];
    }

    public function executeQuery($query, $params = []) {
        $stmt = $GLOBALS['__DB_CONN']->prepare($query);
        $stmt->execute($params);
        return $stmt;
    }
}

?>