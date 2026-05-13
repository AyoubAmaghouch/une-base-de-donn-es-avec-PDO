<?php

require_once "../db.php";

require_once "../functions.php";

// GET RECIPES

$recipes = getRecipes($pdo);

?>

<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Liste des recettes</title>

    <link rel="stylesheet"
          href="../css/style.css">

</head>

<body>

<h1>Liste des recettes</h1>

<a href="create.php"
   class="add-btn">

   Ajouter une recette

</a>

<table>

    <tr>

        <th>Nom</th>

        <th>Image</th>

        <th>Catégorie</th>

        <th>Temps</th>

        <th>Actions</th>

    </tr>

    <?php foreach($recipes as $recipe): ?>

    <tr>

        <td>
            <?= $recipe['name'] ?>
        </td>

        <td>

            <?php if($recipe['image']): ?>

                <img src="../images/<?= $recipe['image'] ?>">

            <?php else: ?>

                Pas d'image

            <?php endif; ?>

        </td>

        <td>
            <?= $recipe['category_name'] ?>
        </td>

        <td>
            <?= $recipe['prep_time'] ?> min
        </td>

        <td>

            <a href="update.php?id=<?= $recipe['id'] ?>"
               class="update-btn">

               Modifier

            </a>

            <a href="delete.php?id=<?= $recipe['id'] ?>"
               class="delete-btn"
               onclick="return confirm('Supprimer cette recette ?')">

               Supprimer

            </a>

        </td>

    </tr>

    <?php endforeach; ?>

</table>

</body>
</html>