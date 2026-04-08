<?php
require_once 'functions.php';


if (isset($_GET['search']) && !empty($_GET['search'])) {
    $recipes = searchRecipes($_GET['search']);
}
elseif (isset($_GET['category']) && !empty($_GET['category'])) {
    $recipes = filterByCategory($_GET['category']);
}
elseif (isset($_GET['sort']) && !empty($_GET['sort'])) {
    $recipes = sortRecipes($_GET['sort']);
}
else {
    $recipes = getRecipes();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Recipes</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <h1>Recipe Management</h1>

    <div class="controls">
        <form method="GET" action="index.php" style="display: flex; gap: 15px; width: 100%;">
            <input type="text" name="search" placeholder="Search..." value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>">
            
            <select name="category">
                <option value="">-- Category --</option>
                <option value="Entrée">Entrée</option>
                <option value="Plat">Plat</option>
                <option value="Dessert">Dessert</option>
            </select>

            <select name="sort">
                <option value="">-- Sort by --</option>
                <option value="temps_asc">Time Shortest</option>
                <option value="temps_desc">Time Longest </option>
                <option value="recent">Newest</option>
                <option value="ancien">Oldest</option>
            </select>

            <button type="submit">Apply</button>
            <a href="index.php"><button type="button">Reset</button></a>
        </form>
    </div>

    <div class="card-container">
        <?php if (empty($recipes)): ?>
            <p class="error-msg">No recipes found</p>
        <?php else: ?>
            <?php foreach ($recipes as $recipe): ?>
                <div class="card">
                    <img src="<?= htmlspecialchars($recipe['image']) ?>" alt="<?= htmlspecialchars($recipe['name']) ?>">
                    
                    <h3><?= htmlspecialchars($recipe['name']) ?></h3>
                    
                    <p>Category: <span class="tag"><?= htmlspecialchars($recipe['category']) ?></span></p>
                    
                    <p>Time: ⏱ <?= htmlspecialchars($recipe['prep_time']) ?> min</p>
                    
                    <p><small>Added on: <?= htmlspecialchars($recipe['created_at']) ?></small></p>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</body>
</html>