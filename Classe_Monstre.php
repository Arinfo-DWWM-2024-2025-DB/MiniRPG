<?php

class Monstre
{
    private string $nom;
    private int $pv;
    private int $niveau;

    public function __construct(string $nom, int $pv, int $niveau)
    {
        $this->nom = $nom;
        $this->pv = $pv;
        $this->niveau = $niveau;
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
}

?>