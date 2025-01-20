<?php

class Personnage
{
    private string $nom;
    private int $pv;
    private int $niveau;
    private Classe $classe;
    private array $equipements = []; // Tableau d'équipements

    public function __construct(string $nom, int $pv, int $niveau, Classe $classe)
    {
        $this->nom = $nom;
        $this->pv = $pv;
        $this->niveau = $niveau;
        $this->classe = $classe;
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

    public function getClasse(): Classe
    {
        return $this->classe;
    }

    public function getEquipements(): array
    {
        return $this->equipements;
    }

    public function ajouterEquipement(Equipement $equipement): void
    {
        $this->equipements[] = $equipement;
    }
}

?>