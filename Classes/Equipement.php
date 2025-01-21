<?php

include_once 'Classes/ObjetDb.php';

class Equipement extends ObjetDb
{
    private string $nom;
    private string $type;
    private int $puissance;

    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->nom = $data['nom'];
        $this->type = $data['type'];
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