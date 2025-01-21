<?php

include_once 'Classes/ObjetDb.php';

class Personnage extends ObjetDb
{    
    private string $nom;
    private int $pv;
    private int $niveau;
    private int $classe_id;

    public function save() : int {
        $query = 'UPDATE personnage SET nom = :nom, pv = :pv, niveau = :niveau, classe_id = :classe_id WHERE id = :id';
        $params = [
            ':nom' => $this->nom,
            ':pv' => $this->pv,
            ':niveau' => $this->niveau,
            ':classe_id' => $this->classe_id,
            ':id' => $this->getId()
        ];
        $res = $this->db->executeQuery($query, $params);
        return $res->rowCount();
    }

    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->nom = $data['nom'];
        $this->pv = $data['pv'];
        $this->niveau = $data['niveau'];
        $this->classe_id = $data['classe_id'];
    }

    public function getNom(): string
    {
        return $this->nom;
    }

    public function getPv(): int
    {
        return $this->pv;
    }

    public function setPv(int $pv): void
    {
        $this->pv = $pv;
    }

    public function getNiveau(): int
    {
        return $this->niveau;
    }

    public function getClasse(): ClassePersonnage
    {
        return $this->db->getClassePersonnage($this->classe_id);
    }
}

?>