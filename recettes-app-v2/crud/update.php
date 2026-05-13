<?php

require_once "../db.php";

require_once "../functions.php";

// GET ID

$id = $_GET['id'];

// GET RECIPE

$recipe = getRecipeById($pdo, $id);

// GET CATEGORIES

$categories = getCategories($pdo);

// SUBMIT

if(isset($_POST['submit'])){

    $name = sanitize($_POST['name']);

    $prep_time = sanitize($_POST['prep_time']);

    $category_id = sanitize($_POST['category_id']);

    updateRecipe(
        $pdo,
        $name,
        $prep_time,
        $category_id,
        $id
    );

    header("Location: read.php");

    exit;
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Modifier</title>

    <link rel="stylesheet"
          href="../css/style.css">

</head>

<body>

<h1>Modifier recette</h1>

<form method="POST">

    <input type="text"
           name="name"
           value="<?= $recipe['name'] ?>">

    <br><br>

    <input type="number"
           name="prep_time"
           value="<?= $recipe['prep_time'] ?>">

    <br><br>

    <select name="category_id">

        <?php foreach($categories as $category): ?>

        <option value="<?= $category['id'] ?>"

        <?php
        if($category['id']
           == $recipe['category_id']){

            echo "selected";
        }
        ?>>

        <?= $category['name'] ?>

        </option>

        <?php endforeach; ?>

    </select>

    <br><br>

    <button type="submit"
            name="submit">

        Modifier

    </button>

</form>

</body>
</html>