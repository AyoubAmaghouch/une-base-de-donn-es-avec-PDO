<?php

require_once "../db.php";

require_once "../functions.php";

// GET CATEGORIES

$categories = getCategories($pdo);

// SUBMIT

if(isset($_POST['submit'])){

    $name = sanitize($_POST['name']);

    $prep_time = sanitize($_POST['prep_time']);

    $category_id = sanitize($_POST['category_id']);

    $image = "";

    // IMAGE

    if(isset($_FILES['image'])
       && $_FILES['image']['error'] == 0){

        $image = time() . "_"
               . $_FILES['image']['name'];

        move_uploaded_file(
            $_FILES['image']['tmp_name'],
            "../images/" . $image
        );
    }

    // CREATE

    createRecipe(
        $pdo,
        $name,
        $prep_time,
        $image,
        $category_id
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

    <title>Ajouter</title>

    <link rel="stylesheet"
          href="../css/style.css">

</head>

<body>

<h1>Ajouter une recette</h1>

<form method="POST"
      enctype="multipart/form-data">

    <input type="text"
           name="name"
           placeholder="Nom">

    <br><br>

    <input type="number"
           name="prep_time"
           placeholder="Temps préparation">

    <br><br>

    <input type="file"
           name="image">

    <br><br>

    <select name="category_id">

        <?php foreach($categories as $category): ?>

        <option value="<?= $category['id'] ?>">

            <?= $category['name'] ?>

        </option>

        <?php endforeach; ?>

    </select>

    <br><br>

    <button type="submit"
            name="submit">

        Ajouter

    </button>

</form>

</body>
</html>