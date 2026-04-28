<?php
require "db.php";
require "functions.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $id = $_POST['id'] ?? null;

    if ($id) {
        deleteData($pdo, $id);
    }

    header("Location: index.php");
    exit();
}