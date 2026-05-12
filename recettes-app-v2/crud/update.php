<?php

require_once "../db.php";

$id = $_GET['id']; // Récupérer l'id de la recette à modifier depuis l'URL

$sql = "SELECT * FROM recipes WHERE id = ?";
$stmt = $pdo->prepare($sql); //knwjdo query 
$stmt->execute([$id]);

$recipe = $stmt->fetch(PDO::FETCH_ASSOC);

$categories = $pdo->query("SELECT * FROM categories")
                  ->fetchAll(PDO::FETCH_ASSOC); //select categories.

if(isset($_POST['submit'])) {

    $name = $_POST['name'];
    $prep_time = $_POST['prep_time'];
    $category_id = $_POST['category_id'];

    $sql = "UPDATE recipes
            SET name = ?,
                prep_time = ?,
                category_id = ?,
                edited_at = NOW()
            WHERE id = ?";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        $name,
        $prep_time,
        $category_id,
        $id
    ]);

    header("Location: read.php");
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Modifier</title>
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
<?php if($category['id'] == $recipe['category_id']) echo "selected"; ?>>

<?= $category['name'] ?>

</option>

<?php endforeach; ?>

</select>

<br><br>

<button type="submit" name="submit">
    Modifier
</button>

</form>

</body>
</html>