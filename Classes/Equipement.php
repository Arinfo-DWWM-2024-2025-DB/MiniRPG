<?php

include_once 'Classes/ObjetDb.php';

class Equipement extends ObjetDb
{
    private string $nom;
    private string $type_equipement;
    private int $puissance;

    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->nom = $data['nom'];
        $this->type_equipement = $data['type_equipement'];
        $this->puissance = $data['puissance'];
    }

    public function getNom(): string
    {
        return $this->nom;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getPuissance(): int
    {
        return $this->puissance;
    }
}

?>