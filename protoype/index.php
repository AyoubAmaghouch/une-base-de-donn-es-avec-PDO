<?php
require 'db.php';
require 'functions.php';

$recipes = getAllRecipes($pdo);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mes Recettes</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <h1>Mes Recettes</h1>

    <div class="grid">

        <?php foreach ($recipes as $recipe) : ?>
            <div class="card">
                <img src="<?= htmlspecialchars($recipe['image']) ?>"
                     alt="<?= htmlspecialchars($recipe['name']) ?>">
                <div class="card-body">
                    <h2><?= htmlspecialchars($recipe['name']) ?></h2>
                    <span class="badge <?= $recipe['category'] ?>">
                        <?= $recipe['category'] ?>
                    </span>
                    <span class="time">
                        <?= $recipe['prep_time'] ?> min
                    </span>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>