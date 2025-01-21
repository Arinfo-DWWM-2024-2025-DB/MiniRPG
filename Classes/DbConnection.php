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

    public function insertPersonnage($nom, $classe, $pv, $niveau, $equipement) {
        $stmt = $this->executeQuery(
            'INSERT INTO personnage (id, nom, classe_id, pv, niveau, equipement_id) VALUES (NULL, :nom, :classe, :pv, :niveau, :equipement)', 
            [   
                ':nom' => $nom, 
                ':classe' => $classe, 
                ':pv' => $pv, 
                ':niveau' => $niveau,
                ':equipement' => $equipement
            ]
        );

        $id = -1;
        if ($stmt->rowCount() > 0) {
            $id = $GLOBALS['__DB_CONN']->lastInsertId();
        }        

        return [$stmt->rowCount(), $this->getPersonnage($id)];
    }

    /* DB -> Objet */
    public function getEquipement($id) {
        $stmt = $this->executeQuery('SELECT * FROM equipement WHERE id = :id', [':id' => $id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($data) {
            return new Equipement($data);
        }
        return null;
    }

    public function getAllEquipements() {
        $stmt = $this->executeQuery('SELECT * FROM equipement');
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public function getPersonnage($id) {
        $stmt = $this->executeQuery('SELECT * FROM personnage WHERE id = :id', [':id' => $id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($data) {
            return new Personnage($data);
        }
        return null;
    }

    public function getAllPersonnages() {
        $stmt = $this->executeQuery('SELECT * FROM personnage');
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public function getClassePersonnage($id) {
        $stmt = $this->executeQuery('SELECT * FROM classe WHERE id = :id', [':id' => $id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($data) {
            return new ClassePersonnage($data);
        }
        return null;
    }

    public function getAllClassesPersonnage() {
        $stmt = $this->executeQuery('SELECT * FROM classe');
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public function getAllEquipementClasses() {
        $stmt = $this->executeQuery('SELECT * FROM equipement_classe');
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public function getMonstre($id) {
        $stmt = $this->executeQuery('SELECT * FROM monstre WHERE id = :id', [':id' => $id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($data) {
            return new Monstre($data);
        }
        return null;
    }        

    public function getAllMonstres() {
        $stmt = $this->executeQuery('SELECT * FROM monstre');
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public function getRandomMonstre() {
        $stmt = $this->executeQuery('SELECT * FROM monstre ORDER BY RAND() LIMIT 1');
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($data) {
            return new Monstre($data);
        }
        return null;
    }

    /* Objet -> DB */
    public function updatePersonnage(Personnage $personnage) {
        $query = 'UPDATE personnage SET nom = :nom, pv = :pv, niveau = :niveau, classe_id = :classe_id WHERE id = :id';
        $params = [
            ':nom' => $personnage->getNom(),
            ':pv' => $personnage->getPv(),
            ':niveau' => $personnage->getNiveau(),
            ':classe_id' => $personnage->getClasse()->getId(),
            ':id' => $personnage->getId()
        ];
        $res = $this->executeQuery($query, $params);
        return $res->rowCount();
    }

    public function updateClassePersonnage(ClassePersonnage $classePersonnage) {
        $query = 'UPDATE classe SET nom = :nom WHERE id = :id';
        $params = [ 
            ':nom' => $classePersonnage->getNom(),
            ':id' => $classePersonnage->getId()
        ];
        $res = $this->executeQuery($query, $params);
        return $res->rowCount();
    }

    public function updateMonstre(Monstre $monstre) {
        $query = 'UPDATE monstre SET nom = :nom, pv = :pv, puissance = :puissance, equipement_id = :equipement_id WHERE id = :id';
        $params = [
            ':nom' => $monstre->getNom(),
            ':pv' => $monstre->getPv(),
            ':puissance' => $monstre->getPuissance(),
            ':equipement_id' => $monstre->getEquipement()->getId(),
            ':id' => $monstre->getId()
        ];
        $res = $this->executeQuery($query, $params);
        return $res->rowCount();
    }

    public function updateEquipement(Equipement $equipement) {
        $query = 'UPDATE equipement SET nom = :nom, type = :type, puissance = :puissance WHERE id = :id';
        $params = [
            ':nom' => $equipement->getNom(),   
            ':type' => $equipement->getType(),
            ':puissance' => $equipement->getPuissance(),
            ':id' => $equipement->getId()
        ];
        $res = $this->executeQuery($query, $params);
        return $res->rowCount();
    }

    public function deletePersonnage($id) {
        $query = 'DELETE FROM personnage WHERE id = :id';
        $params = [ ':id' => $id ];
        $res = $this->executeQuery($query, $params);
        return $res->rowCount();
    }
}

?>