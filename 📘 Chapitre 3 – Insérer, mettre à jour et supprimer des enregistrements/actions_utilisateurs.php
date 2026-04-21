<?php
require 'db.php';
try {
    $stmt = $pdo -> prepare ("insert into utilisateurs (nom , email) values (:nom , :email)");
$stmt -> execute ([
    'nom' => $_POST['nom'],
    'email' => $_POST['email']
]);
echo "utilistauer bone conexeion";

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}


$stmt = $pdo -> prepare ("update utilisateurs set email = :email WHERE id = :id");
$stmt -> execute([
    'email' => 'ayoubamaghouche@gmail.com',
    'id' => 3
]);
echo "utilistauer bone conexeion";

$stmt = $pdo -> prepare ("delete from utilisateurs where id = :id");
$stmt -> execute([
    'id' => 3
]);
echo "utilistauer bone conexeion";
echo $stmt->rowCount() . " ligne(s) affectée(s).";
