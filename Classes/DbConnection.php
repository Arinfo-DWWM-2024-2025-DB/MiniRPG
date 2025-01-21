<?php
include_once 'Classes/Monstre.php';
include_once 'Classes/Personnage.php';
include_once 'Classes/Equipement.php';
include_once 'Classes/ClassePersonnage.php';

class DbConnection {
    /* Membres */
    private $db;

    /* Constructeur */
    public function __construct() {
        try {
            if (!isset($GLOBALS['__DB_CONN'])) {
                $GLOBALS['__DB_CONN'] = new PDO('mysql:host=localhost;dbname=minirpg', 'root', '');
                $GLOBALS['__DB_CONN']->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
        } catch (PDOException $e) {
            die('Erreur construction DB : ' . $e->getMessage());
        }
    }

    /* Getters */
    public function getDb() {
        return $GLOBALS['__DB_CONN'];
    }

    /* Méthodes */
    public function executeQuery($query, $params = []) {
        try {
            $stmt = $GLOBALS['__DB_CONN']->prepare($query);
            $stmt->execute($params);
            return $stmt;
        } catch (PDOException $e) {
            die('Erreur exécution requête : ' . $e->getMessage());
        }
    }

    public function insertPersonnage($nom, $classe, $pv, $niveau) {
        $stmt = $this->executeQuery(
            'INSERT INTO personnage (id, nom, classe_id, pv, niveau) VALUES (NULL, :nom, :classe, :pv, :niveau)', 
            [   
                ':nom' => $nom, 
                ':classe' => $classe, 
                ':pv' => $pv, 
                ':niveau' => $niveau
            ]
        );

        $id = -1;
        if ($stmt->rowCount() > 0) {
            $id = $GLOBALS['__DB_CONN']->lastInsertId();
        }        

        return [$stmt->rowCount(), $this->getPersonnage($id)];
    }

    /* DB -> Objet */
    public function getEquipment($id) {
        $stmt = $this->executeQuery('SELECT * FROM equipement WHERE id = ' . $id);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($data) {
            return new Equipement($data);
        }
        return null;
    }

    public function getPersonnage($id) {
        $stmt = $this->executeQuery('SELECT * FROM personnage WHERE id = ' . $id);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($data) {
            return new Personnage($data);
        }
        return null;
    }

    public function getClassePersonnage($id) {
        $stmt = $this->executeQuery('SELECT * FROM classe WHERE id = ' . $id);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($data) {
            return new ClassePersonnage($data);
        }
        return null;
    }

    public function getMonstre($id) {
        $stmt = $this->executeQuery('SELECT * FROM monstre WHERE id = ' . $id);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($data) {
            return new Monstre($data);
        }
        return null;
    }        

    public function getRandomMonstre() {
        $stmt = $this->executeQuery('SELECT * FROM monstre ORDER BY RAND() LIMIT 1');
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($data) {
            return new Monstre($data);
        }
        return null;
    }
}

?>