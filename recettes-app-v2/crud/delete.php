<?php

require_once "../db.php";

require_once "../functions.php";

// GET ID

$id = $_GET['id'];

// DELETE

deleteRecipe($pdo, $id);

// REDIRECT

header("Location: read.php");

exit;