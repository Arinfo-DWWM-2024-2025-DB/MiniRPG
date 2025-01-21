<?php

include_once 'Classes/ObjetDb.php';

class Personnage extends ObjetDb
{    
    private string $nom;
    private int $pv;
    private int $niveau;
    private int $classe_id;
    private int $equipement_id;

    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->nom = $data['nom'];
        $this->pv = $data['pv'];
        $this->niveau = $data['niveau'];
        $this->classe_id = $data['classe_id'];
        $this->equipement_id = $data['equipement_id'];
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

    public function getEquipement(): Equipement
    {
        return $this->db->getEquipement($this->equipement_id);
    }
}

?>