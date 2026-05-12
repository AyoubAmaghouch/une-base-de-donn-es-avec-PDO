<?php

require_once "../db.php";

$categories = $pdo->query("SELECT * FROM categories")->fetchAll(PDO::FETCH_ASSOC); // Récupérer row de array

if(isset($_POST['submit'])) {

    $name = $_POST['name']; // Récupérer les données du formulaire
    $prep_time = $_POST['prep_time'];// Récupérer les données du formulaire
    $category_id = $_POST['category_id']; // Récupérer l'id de la catégorie sélectionnée

    $image = "";

    if(isset($_FILES['image']) && $_FILES['image']['error'] == 0) { // Vérifier si une image a été téléchargée sans erreur

        $image = time() . "_" . $_FILES['image']['name']; //files variable fore files / and time 1715520000

        move_uploaded_file(
            $_FILES['image']['tmp_name'],
            "../images/" . $image
        );
    }

    $sql = "INSERT INTO recipes(name, prep_time, image, category_id)
            VALUES(?, ?, ?, ?)"; // ? palce holder

    $stmt = $pdo->prepare($sql); // prépartion de query 

    $stmt->execute([ // execute la query avec les données du formulaire
        $name,
        $prep_time,
        $image,
        $category_id
    ]);

    header("Location: read.php");
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Ajouter</title>
</head>
<body>

<h1>Ajouter une recette</h1>

<form method="POST" enctype="multipart/form-data">

<input type="text" name="name" placeholder="Nom">

<br><br>

<input type="number" name="prep_time" placeholder="Temps préparation">

<br><br>

<input type="file" name="image">

<br><br>

<select name="category_id">

<?php foreach($categories as $category): ?>

<option value="<?= $category['id'] ?>">
    <?= $category['name'] ?>
</option>

<?php endforeach; ?>

</select>

<br><br>

<button type="submit" name="submit">
    Ajouter
</button>

</form>

</body>
</html>