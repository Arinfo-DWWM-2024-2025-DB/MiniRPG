<?php
// Tour 1: perso 1 -> attaque, maj PV perso 2
// Tour 2: perso 2 -> attaque + maj PV perso 1
include_once 'Services/fightLogic.php';

$db = new DbConnection();

if (isset($_POST['reset'])) {
    session_destroy();
    header('Location: hero.php');
    exit;
}

if (!isset($_SESSION['player'])) {    
    [$res, $player] = $db->insertPersonnage($_SESSION['hero_name'], $_SESSION['class_hero'], 100, 1, $_POST['stuffHero']);
    $_SESSION['player'] = serialize($player);    
} 
$_SESSION['monster'] = serialize($db->getRandomMonstre());

$player = unserialize($_SESSION['player']);
$monster = unserialize($_SESSION['monster']);

$_SESSION['hpHero'] = $player->getPv();
$_SESSION['hpMonstre'] = $monster->getPv();
$_SESSION['niveauHero'] = $player->getNiveau();
$_SESSION['puissanceMonstre'] = $monster->getPuissance();
$_SESSION['puissanceEquipementHero'] = $player->getEquipement()->getPuissance();
$_SESSION['puissanceEquipementMonstre'] = $monster->getEquipement()->getPuissance();

echo "Statistiques de départ du héros :<br>";
echo "Nom : " . $player->getNom() . "<br>";
echo "PV : " . $player->getPv() . "<br>";
echo "Niveau : " . $player->getNiveau() . "<br>";
echo "Nom de l'équipement : " . $player->getEquipement()->getNom() . "<br>";
echo "Puissance de l'équipement : " . $player->getEquipement()->getPuissance() . "<br><br>";

echo "Statistiques de départ du monstre :<br>";
echo "Nom : " . $monster->getNom() . "<br>";
echo "PV : " . $monster->getPv() . "<br>";
echo "Puissance : " . $monster->getPuissance() . "<br>";
echo "Nom de l'équipement : " . $monster->getEquipement()->getNom() . "<br>";
echo "Puissance de l'équipement : " . $monster->getEquipement()->getPuissance() . "<br><br>";

while ($_SESSION['hpHero'] > 0 && $_SESSION['hpMonstre'] > 0) {
    // Tour impair c'est le monstre qui attaque
    if ($_SESSION['compteur'] % 2 != 0) {
        // Attaque le heros
        $dgtA = attaque(MONSTRE);
        // Affiche les dégâts
        echo "Le monstre a infligé " . $dgtA . "dégâts au héros" . "<br>";
    } else { // Sinon tour pair c'est le héros qui attaque
        // Attaque le monstre
        $dgtB = attaque(JOUEUR);
        // Maj des pv du Monstre
        echo "Le héros a infligé " . $dgtB . "dégâts au monstre" . "<br>";
    }

    // Si le héros ou le monstre n'ont plus de pv, on les met à 0
    $_SESSION['hpHero'] = $_SESSION['hpHero'] < 0 ? 0 : $_SESSION['hpHero'];
    $_SESSION['hpMonstre'] = $_SESSION['hpMonstre'] < 0 ? 0 : $_SESSION['hpMonstre'];

    // maj des pv du Hero
    echo "PV du héros : " . $_SESSION['hpHero'] . "<br>";
    echo "PV du monstre : " . $_SESSION['hpMonstre'] . "<br>";

    // passe au tour suivant
    $_SESSION['compteur']++;
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/combat.css">
    <title>Mini RPG - Combat</title>
</head>

<body>
    <form method="POST">        
        <button type="submit" name="reset">Reset</button>
    </form>
</body>

</html>
