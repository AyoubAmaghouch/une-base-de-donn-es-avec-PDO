<?php
require "db.php";

// get all data
function getallData($pdo){
    $sql = "SELECT * FROM products";
    $stmt = $pdo->prepare($sql); //Sécurité contre SQL Injection
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// delete data
function deleteData($pdo,$id){
    $sql = "DELETE FROM products WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([$id]);
}

// add product
function Add_Products($pdo, $prdName, $price, $quantity){
    $sql = "INSERT INTO products(name , price , quantity) VALUES(? , ? , ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$prdName , $price , $quantity]);
}

// get product by id
function getProductById($pdo, $id){
    $stmt = $pdo->prepare("SELECT * FROM products WHERE id=?");
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// update product
function updateProduct($pdo, $id, $name, $price, $quantity){
    $stmt = $pdo->prepare("UPDATE products SET name=?, price=?, quantity=? WHERE id=?");
    return $stmt->execute([$name, $price, $quantity, $id]);
}