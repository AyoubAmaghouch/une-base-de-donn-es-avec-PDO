<?php

require_once "../db.php";

$id = $_GET['id']; // Récupérer l'id de la recette à supprimer depuis l'URL

$sql = "DELETE FROM recipes WHERE id = ?"; //  la requête SQL pour supprimer la recette avec l'id spécifié

$stmt = $pdo->prepare($sql); //SQL Injection

$stmt->execute([$id]);

header("Location: read.php");