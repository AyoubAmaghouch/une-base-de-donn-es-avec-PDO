<?php


// SANITIZE


function sanitize($data){

    return htmlspecialchars(trim($data));
}


// GET ALL CATEGORIES


function getCategories($pdo){

    $sql = "SELECT * FROM categories";

    $stmt = $pdo->query($sql);

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


// GET ALL RECIPES


function getRecipes($pdo){

    $sql = "SELECT recipes.*,
                   categories.name AS category_name

            FROM recipes

            LEFT JOIN categories

            ON recipes.category_id = categories.id";

    $stmt = $pdo->query($sql); // no prepare because no user input

    return $stmt->fetchAll(PDO::FETCH_ASSOC); // associative array
}

// GET RECIPE BY ID


function getRecipeById($pdo, $id){

    $sql = "SELECT * FROM recipes WHERE id = ?";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([$id]);

    return $stmt->fetch(PDO::FETCH_ASSOC);
}


// CREATE RECIPE
 

function createRecipe($pdo,
                      $name,
                      $prep_time,
                      $image,
                      $category_id){

    $sql = "INSERT INTO recipes(
                name,
                prep_time,
                image,
                category_id
            )

            VALUES(?, ?, ?, ?)"; //placeholders

    $stmt = $pdo->prepare($sql);

    return $stmt->execute([
        $name,
        $prep_time,
        $image,
        $category_id
    ]);
}


// UPDATE RECIPE


function updateRecipe($pdo,
                      $name,
                      $prep_time,
                      $category_id,
                      $id){

    $sql = "UPDATE recipes

            SET
                name = ?,
                prep_time = ?,
                category_id = ?,
                edited_at = NOW() 

            WHERE id = ?";

    $stmt = $pdo->prepare($sql);

    return $stmt->execute([
        $name,
        $prep_time,
        $category_id,
        $id
    ]);
}

// DELETE RECIPE

function deleteRecipe($pdo, $id){

    $sql = "DELETE FROM recipes WHERE id = ?";

    $stmt = $pdo->prepare($sql);

    return $stmt->execute([$id]);
}