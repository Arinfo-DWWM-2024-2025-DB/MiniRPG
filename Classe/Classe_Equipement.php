<?php

class Equipement
{
    private string $nom;
    private string $type;
    private int $puissance;

    public function __construct(string $nom, string $type, int $puissance)
    {
        $this->nom = $nom;
        $this->type = $type;
        $this->puissance = $puissance;
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