<?php

session_start();

try {
    // Connexion à la base de données
    $pdo = new PDO('mysql:host=localhost;dbname=minirpg;charset=utf8', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Erreur de connexion : ' . $e->getMessage());
}


//Récupération des classes
$sqlClasses = "SELECT id, nom FROM classe";
$classes = [];
try {
    $stmt = $pdo->query($sqlClasses);
    $classes = $stmt->fetchAll(PDO::FETCH_ASSOC);
}catch (PDOException $e) {
    die('Erreur lors de la récupération des classes : ' . $e->getMessage());
}


//Récupération des equipements : nom, id et classe associée + deux jointures
$sqlEquipements = "
    SELECT e.id AS equipement_id, e.nom AS equipement_nom, c.id AS classe_id 
    FROM equipement e
    INNER JOIN equipement_classe ec ON e.id = ec.equipement_id
    INNER JOIN classe c ON ec.classe_id = c.id
    ";

$equipements = [];
try {
    $stmt = $pdo->query($sqlEquipements);
    $equipements = $stmt->fetchAll(PDO::FETCH_ASSOC);
}catch (PDOException $e) {
    die('Erreur lors de la récupération des équipements : ' . $e->getMessage());
}

?>




<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Création d'un personnage</title>
<link rel="stylesheet" href="css/hero.css"
</head>

<body>
    <div class="formContainer">
    <h1>Crée ton héros !</h1>
    <form action="combat.php" method="POST">
        <label>Nom du héros : </label>
        <input type="text" id="hero-name" name="hero_name" required>
        <br>
        <label for="class">Classe du héros :</label>
        <select id="classHero" name="classHero" required>
            <?php foreach ($classes as $class): ?>
                <option value="<?= htmlspecialchars($class['id']) ?>">
                    <?= htmlspecialchars($class['nom']) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label for="stuff">Équipement :</label>
        <select id="stuffHero" name="stuffHero" required>
            <option value="épée">Épée</option>
            <option value="bâton">Bâton</option>
            <option value="arc">Arc</option>
            <option value="dague">Dague</option>
        </select>
        <br><br>
        <button type="submit">Commencer l'aventure</button>
    </form>
    </div>
</body>

</html>