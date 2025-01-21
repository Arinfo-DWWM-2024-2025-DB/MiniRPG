<?php
// Tour 1: perso 1 -> attaque, maj PV perso 2
// Tour 2: perso 2 -> attaque + maj PV perso 1
include 'Services/fightLogic.php';

while ($_SESSION['hpHero'] > 0 && $_SESSION['hpMonstre'] > 0) {
    // Tour impair c'est le monstre qui attaque
    if ($_SESSION['compteur'] % 2 != 0) {
        // Attaque le heros
        $dgtA = attaque(MONSTRE);
        // Affiche les dégâts
        echo "Le monstre a infligé " . $dgtA . "dégâts au héros";
    } else { // Sinon tour pair c'est le héros qui attaque
        // Attaque le monstre
        $dgtB = attaque(JOUEUR);
        // Maj des pv du Monstre
        echo "Le héros a infligé " . $dgtB . "dégâts au monstre";
    }

    // maj des pv du Hero
    echo "PV du héros : " . $_SESSION['hpHero'];
    echo "PV du monstre : " . $_SESSION['hpMonstre'];

    // passe au tour suivant
    $_SESSION['compteur']++;
}
?>