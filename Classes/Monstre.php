<?php

include_once 'Classes/ObjetDb.php';

class Monstre extends ObjetDb
{
    private string $nom;
    private int $pv;
    private int $puissance;
    private string $equipement_id;

    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->nom = $data['nom'];
        $this->pv = $data['pv'];
        $this->puissance = $data['puissance'];
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

    public function getPuissance(): int
    {
        return $this->puissance;
    }

    public function getEquipement(): Equipement
    {
        return $this->db->getEquipement($this->equipement_id);
    }
}

?>