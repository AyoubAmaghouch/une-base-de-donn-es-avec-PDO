<?php
require "db.php";
require "functions.php";

$erreurs = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $prdName = trim($_POST['prdName'] ?? "");
    $price = trim($_POST['price'] ?? "");
    $quantity = trim($_POST['quantity'] ?? "");

    // validation
    if (empty($prdName)) {
        $erreurs[] = "Name is required";
    }

    if (empty($price) || !is_numeric($price) || $price <= 0) {
        $erreurs[] = "Price must be a positive number";
    }

    if (empty($quantity) || !is_numeric($quantity) || $quantity < 0) {
        $erreurs[] = "Quantity must be valid";
    }

    // success
    if (empty($erreurs)) {
        Add_Products($pdo, $prdName, $price, $quantity);
        header("Location: index.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container py-5">

    <div class="col-md-6 mx-auto">

        <div class="card shadow p-4">

            <h3 class="text-center mb-4">Add Product</h3>

            <!-- errors -->
            <?php if (!empty($erreurs)): ?>
                <div class="alert alert-danger">
                    <?php foreach($erreurs as $e): ?>
                        <div><?= $e ?></div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <form method="POST">

                <div class="mb-3">
                    <label>Name</label>
                    <input type="text" name="prdName" class="form-control"
                           value="<?= htmlspecialchars($_POST['prdName'] ?? '') ?>">
                </div>

                <div class="mb-3">
                    <label>Price</label>
                    <input type="text" name="price" class="form-control"
                           value="<?= htmlspecialchars($_POST['price'] ?? '') ?>">
                </div>

                <div class="mb-3">
                    <label>Quantity</label>
                    <input type="text" name="quantity" class="form-control"
                           value="<?= htmlspecialchars($_POST['quantity'] ?? '') ?>">
                </div>

                <div class="d-flex justify-content-between">
                    <a href="index.php" class="btn btn-secondary">⬅ Back</a>

                    <button type="submit" class="btn btn-success">
                        ➕ Add Product
                    </button>
                </div>

            </form>

        </div>

    </div>

</div>

</body>
</html>