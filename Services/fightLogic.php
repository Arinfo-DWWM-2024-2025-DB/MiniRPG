<?php

include_once 'Classes/DbConnection.php';

session_start();

if (!isset($_SESSION['hero_name'])) {
    header('Location: hero.php');
    exit;
}

// Récupération de la classe de personnage choisie
if (isset($_SESSION['perso']))
{
    $perso = $_SESSION['perso'];
}

$db = new DbConnection();

//Variables de session
if (!isset($_SESSION['hpHero'])) {
    $_SESSION['hpHero'] = 100;
}
if (!isset($_SESSION['hpMonstre'])) {
    $_SESSION['hpMonstre'] = 100;
}
if (!isset($_SESSION['compteur'])) {
    $_SESSION['compteur'] = 0;
}

// Constantes pour identifier les joueurs
define('JOUEUR', 1);
define('MONSTRE', 2);

// A chaque attaque, le compteur +1. Si le compteur est pair, c'est le héro qui attaque. S'il est impair alors c'est au monstre.
function attaque($attaquant){
    if($attaquant == JOUEUR){
        $degat = calculerDegatsHero();
        $_SESSION['hpMonstre'] -= $degat;
    }
    else
    {
        $degat = calculerDegatsMonstre();
        $_SESSION['hpHero'] -= $degat;
    }
};

function calculerDegatsHero(){
    $bonusStuff = $_SESSION['puissanceEquipementHero'];
    $bonusClasse = $_SESSION['niveauHero'];
    
    return ($bonusStuff * $bonusClasse) * rand(1, 2);
}

function calculerDegatsMonstre(){   
    $bonusStuff = $_SESSION['puissanceEquipementMonstre'];
    $typeMonstre = $_SESSION['puissanceMonstre'];
    return ($bonusStuff * $typeMonstre);
}

?>