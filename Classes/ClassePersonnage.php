<?php

include_once 'Classes/ObjetDb.php';

class ClassePersonnage extends ObjetDb {
    private string $nom;

    public function save() : int {
        $query = 'UPDATE classe SET nom = :nom WHERE id = :id';
        $params = [
            ':nom' => $this->nom,
            ':id' => $this->getId()
        ];
        $res = $this->db->executeQuery($query, $params);
        return $res->rowCount();
    }

    public function __construct(array $data) {
        parent::__construct($data);

        $this->nom = $data['nom'];
    }

    public function getNom(): string
    {
        return $this->nom;
    }
}

?>