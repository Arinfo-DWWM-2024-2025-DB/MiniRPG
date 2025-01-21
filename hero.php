<?php

include 'Classes/DbConnection.php';

session_start();

$pdo = new DbConnection();
$classes = $pdo->getAllClassesPersonnage();
$equipementClasses = $pdo->getAllEquipementClasses();
$equipements = [];

foreach ($equipementClasses as $equipementClass) {
    if (!isset($equipements[$equipementClass['classe_id']])) {  
        $equipements[$equipementClass['classe_id']] = [];
    }

    $equipements[$equipementClass['classe_id']][] = [
        $equipementClass['equipement_id'],
        $pdo->getEquipement($equipementClass['equipement_id'])->getNom()
    ];
}

$availableEquipements = [];
if (isset($_POST['hero_name'])) {
    $availableEquipements = $equipements[$_POST['class-hero']];

    $_SESSION['hero_name'] = $_POST['hero_name'];
    $_SESSION['class_hero'] = $_POST['class-hero'];
}


?>




<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Création d'un personnage</title>
    <!-- <link rel="stylesheet" href="./css/hero.css"> -->
</head>

<body>
    <div class="formContainer">
    <h1>Crée ton héros !</h1>

    <form method="POST">
        <label>Nom du héros : </label>
        <input type="text" id="hero-name" name="hero_name" value="<?= isset($_POST['hero_name']) ? htmlspecialchars($_POST['hero_name']) : '' ?>" required>
        <br>
        <label for="class">Classe du héros :</label>
        <select id="class-hero" name="class-hero" required>
            <?php foreach ($classes as $class): ?>
                <option value="<?= htmlspecialchars($class['id']) ?>" <?= isset($_POST['class-hero']) && $_POST['class-hero'] == $class['id'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($class['nom']) ?>
                </option>
            <?php endforeach; ?>
        </select>
        <br><br>

        <button type="submit" id="hero-submit">Sélectionner le héros</button>
    </form>

    <br><br>

    <form action="combat.php" method="POST">
        <label for="stuff">Équipement :</label>
        <select id="stuffHero" name="stuffHero" required>
            <?php foreach ($availableEquipements as $equipement): ?>
                <option value="<?= htmlspecialchars($equipement[0]) ?>">
                    <?= htmlspecialchars($equipement[1]) ?>
                </option>
            <?php endforeach; ?>
        </select>
        <br><br>
        <button type="submit">Commencer l'aventure</button>
    </form>
    
    </div>

    <script src="/js/hero.js"></script>
</body>

</html>