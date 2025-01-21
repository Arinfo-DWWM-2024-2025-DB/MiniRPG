<?php

include_once 'Classes/ObjetDb.php';

class ClassePersonnage extends ObjetDb {
    private string $nom;

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