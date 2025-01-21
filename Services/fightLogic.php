<?php

include_once 'Classes/DbConnection.php';

session_start();

// Récupération de la classe de personnage choisie
if (isset($_SESSION['perso']))
{
    $perso = $_SESSION['perso'];
}

$db: DbConnection = new DbConnection();

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
    $xp = 10;
    $classe = "Guerrier";
    $stuff = "Épée";

    if($attaquant == JOUEUR){
        $degat = calculerDegatsHero($xp, $classe, $stuff);
        $_SESSION['hpMonstre'] -= $degat;
    }
    else
    {
        $degat = calculerDegatsMonstre($typeMonstre, $stuff);
        $_SESSION['hpHero'] -= $degat;
    }
};

function calculerDegatsHero($xp, $classe, $stuff){
    if (!$xp) {
        $xp = 0;
    }

    if (!$classe) {
        return "Erreur : classe non définie.";
    }

    if (!$stuff) {
        return "Erreur : équipement non défini.";
    }

    echo "XP : " . $xp . ", Classe : " . $classe . ", Stuff : " . $stuff . "<br>";

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

        default:
            echo "Classe inconnue";
            $bonusClasse = 0;
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

        default:
        echo "Classe inconnue";
        $bonusStuff = 0;
        break;
    }
    return ($xp + $bonusStuff + $bonusClasse);
}

function calculerDegatsMonstre($Monstre, $Stuff){
    $stmt: PDOStatement = $db->executeQuery('SELECT * FROM equipement WHERE id = ' . $Stuff);
    

    $bonusStuff = 0;
    switch($Monstre){
        case "Zombie" :
            $typeMonstre = 10;
            break;

        case "David Lafarge" : 
            $typeMonstre = 1;
            break;

        case "Brachiosaurus" : 
            $typeMonstre = 7;
            break;

        case "Brendon Desvaux" : 
            $typeMonstre = 1337;
            break;

        case "Fiddlesticks" : 
            $typeMonstre = 6;
            break;

        case "Vampire" : 
            $typeMonstre = 5;
            break;

        case "Gordon Freeman" : 
            $typeMonstre = 17;
            break;

        case "Dragon Blanc aux Yeux Bleus" : 
            $typeMonstre = 999;
            break;

        case "Golem" : 
            $typeMonstre = 250;
            break;

        case "Loup-garou" : 
            $typeMonstre = 13;
            break;

        case "Troll" : 
            $typeMonstre = 25;
            break;

        case "Archer des enfers" : 
            $typeMonstre = 666;
            break;

        case "Spectre de la Nuit" : 
            $typeMonstre = 6;
            break;

        case "David Baszucki" : 
            $typeMonstre = 18;
            break;

        default:
            $typeMonstre = 0;
            echo "Type de monstre inconnu : " . $Monstre . "<br>";
            break;
    }

    switch ($Stuff){
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
        default:
            $bonusStuff = 0;
            echo "Equipement inconnu";
            break;
    }
    return ($bonusStuff + $typeMonstre);
}

?>