<?php

session_start();

// Récupération de la classe de personnage choisie
if (isset($_SESSION['perso']))
{
    $perso = $_SESSION['perso'];
}

$db = new PDO('mysql:host=localhost;dbname=minirpg', 'root', '');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);


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


// Attaque

function calculerDegats($xp, $classe, $stuff){
    $bonusStuff = 0;
    $bonusClasse = 0;

    switch($classe){
        case "Guerrier" :
            $bonusClasse = 10;
            break;

        case "Civil" : 
            $bonusClasse = 4;
            break;

        case "Mage" : 
            $bonusClasse = 7;
            break;

        case "Archer" : 
            $bonusClasse = 8;
            break;

        case "Bandit" : 
            $bonusClasse = 6;
            break;
    }


    switch ($stuff){
        case "Épée" : 
            $bonusStuff = 10;
            break;
        case "Masse" : 
            $bonusStuff = 15;
            break;
        case "Bâton" : 
            $bonusStuff = 2;
            break;
        case "Arc avec 2 élastiques et un stabilo" : 
            $bonusStuff = 3;
            break;
        case "Couteau" : 
            $bonusStuff = 7;
            break;
        case "Arbalète" : 
            $bonusStuff = 12;
            break;
        case "Arc" : 
            $bonusStuff = 9;
            break;
        case "Arc des enfers" : 
            $bonusStuff = 66;
            break;
        case "Matraque électrique" : 
            $bonusStuff = 8;
            break;
        case "M4A1-S" : 
            $bonusStuff = 45;
            break;
        case "Boule de feu" : 
            $bonusStuff = 12;
            break;
        case "Télékinésie" : 
            $bonusStuff = 8;
            break;
    }
    return (10 + $xp / $bonusClasse + $bonusStuff);
}


function attaque($attaquant){
    

    if($attaquant == JOUEUR){
        $degat = calculerDegats($xp, $classe, $stuff);
        $_SESSION['hpMonstre'] =- $degat
    }
};



function recevoirDegats(){

}


?>