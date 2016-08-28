<?php

require_once 'database.php';


// UTILITIES

function issetor(&$var, $defaultValue = false) {
    return isset($var) ? $var : $defaultValue;
}

function key_exists_or($key, $array, $defaultValue = false) {
    return array_key_exists($key, $array) ? $array[$key] : $defaultValue;
}



function categorylist() {
    $pdo = Database::connect();
    $sql = 'SELECT ID, NOME FROM CATEGORIA ORDER BY NOME';
    Database::disconnect();
    return $pdo->query($sql);
}

function getcategory($id) {
    $pdo = Database::connect();
    $sql = 'SELECT ID, NOME FROM CATEGORIA WHERE ID = ?';
    $statement = $pdo->prepare($sql);
    Database::disconnect();
    $statement->execute(array($id));
    return $statement->fetch();
}

function search_category_by_name($name) {
    $pdo = Database::connect();
    $sql = 'SELECT ID, NOME FROM CATEGORIA WHERE LOWER(NOME) LIKE LOWER(?) ORDER BY NOME';
    $statement = $pdo->prepare($sql);
    Database::disconnect();
    $statement->execute(array('%'.$name.'%'));
    return $statement;
}

function editcategory($id, $name) {
    $pdo = Database::connect();
    $sql = 'UPDATE CATEGORIA SET NOME = ? WHERE ID = ?';
    $statement = $pdo->prepare($sql);
    Database::disconnect();
    $statement->execute(array($name, $id));
}

function addcategory($name) {
    $pdo = Database::connect();
    $sql = 'INSERT INTO CATEGORIA (NOME) VALUES(TRIM(?))';
    $statement = $pdo->prepare($sql);
    Database::disconnect();
    $statement->execute(array($name));
}

function booklist() {
    $pdo = Database::connect();
    $sql = 'SELECT ID, TITOLO FROM LIBRO ORDER BY TITOLO';
    Database::disconnect();
    return $pdo->query($sql);
}

function getbook($id) {
    $pdo = Database::connect();
    $sql = 'SELECT ID, TITOLO FROM LIBRO WHERE ID = ?';
    $statement = $pdo->prepare($sql);
    Database::disconnect();
    $statement->execute(array($id));
    return $statement->fetch();
}

function editbook($id, $title) {
    $pdo = Database::connect();
    $sql = 'UPDATE LIBRO SET TITOLO = ? WHERE ID = ?';
    $statement = $pdo->prepare($sql);
    Database::disconnect();
    $statement->execute(array($title, $id));
}

function addbook($title) {
    $pdo = Database::connect();
    $sql = 'INSERT INTO LIBRO (TITOLO) VALUES(TRIM(?))';
    $statement = $pdo->prepare($sql);
    Database::disconnect();
    $statement->execute(array($title));
}

function ingredientlist() {
    $pdo = Database::connect();
    $sql = 'SELECT ID, NOME FROM INGREDIENTE ORDER BY NOME';
    Database::disconnect();
    return $pdo->query($sql);
}

function getingredient($id) {
    $pdo = Database::connect();
    $sql = 'SELECT ID, NOME FROM INGREDIENTE WHERE ID = ?';
    $statement = $pdo->prepare($sql);
    Database::disconnect();
    $statement->execute(array($id));
    return $statement->fetch();
}

function search_ingredient_by_name($name) {
    $pdo = Database::connect();
    $sql = 'SELECT ID, NOME FROM INGREDIENTE WHERE LOWER(NOME) LIKE LOWER(?) ORDER BY NOME';
    $statement = $pdo->prepare($sql);
    Database::disconnect();
    $statement->execute(array('%'.$name.'%'));
    return $statement;
}

function editingredient($id, $name) {
    $pdo = Database::connect();
    $sql = 'UPDATE INGREDIENTE SET NOME = ? WHERE ID = ?';
    $statement = $pdo->prepare($sql);
    Database::disconnect();
    $statement->execute(array($name, $id));
}

function addingredient($name) {
    $pdo = Database::connect();
    $sql = 'INSERT INTO INGREDIENTE (NOME) VALUES(TRIM(?))';
    $statement = $pdo->prepare($sql);
    Database::disconnect();
    $statement->execute(array($name));
}

function addrecipe($title, $ingredients, $categories, $volume, $year) {
    $pdo = Database::connect();
    $pdo->beginTransaction();
    try {
        $ins_rec_sql = 'INSERT INTO RICETTA (TITOLO) VALUES(TRIM(?))';
        $ins_rec_stmt = $pdo->prepare($ins_rec_sql);
        $ins_rec_stmt->execute(array($title));

        $recipeId = $pdo->lastInsertId();

        if (count($ingredients) > 0) {
            $ins_ingr_sql = 'INSERT INTO RICETTA_INGREDIENTE (ID_RICETTA, ID_INGREDIENTE) VALUES (?, ?)';
            $ins_ingr_stmt = $pdo->prepare($ins_ingr_sql);
            foreach ($ingredients as $key => $value) {
                $ins_ingr_stmt->execute(array($recipeId, $value));
            }
        }

        if (count($categories) > 0) {
            $ins_categ_sql = 'INSERT INTO RICETTA_CATEGORIA (ID_RICETTA, ID_CATEGORIA) VALUES (?, ?)';
            $ins_categ_stmt = $pdo->prepare($ins_categ_sql);
            foreach ($categories as $key => $value) {
                $ins_categ_stmt->execute(array($recipeId, $value));
            }
        }

        $pdo->commit();
    } catch (PDOException $e) {
        echo $e->getMessage();
        $pdo->rollBack();
    }
    Database::disconnect();
}

function recipelist() {
    $pdo = Database::connect();
    $sql = 'SELECT ID, TITOLO FROM RICETTA ORDER BY TITOLO';
    Database::disconnect();
    return $pdo->query($sql);
}

function search_recipe($recipeTitle, $ingredientName, $categoryId) {
    $pdo = Database::connect();
    $sql = 'SELECT DISTINCT R.ID, R.TITOLO FROM RICETTA R JOIN RICETTA_INGREDIENTE RI ON R.ID = RI.ID_RICETTA JOIN INGREDIENTE I ON I.ID = RI.ID_INGREDIENTE JOIN RICETTA_CATEGORIA RC ON RI.ID_RICETTA = RC.ID_CATEGORIA ';
    $hasWhere = false;
    $recTitleParam = '';
    $ingrNameParam = '';
    if (trim($recipeTitle) !== '') {
        $hasWhere = true;
        $sql .= ' WHERE LOWER(R.TITOLO) LIKE LOWER(?) ';
        $recTitleParam = '%'.trim($recipeTitle).'%';
    }
    if (trim($ingredientName) !== '') {
        if (!$hasWhere) {
            $sql .= ' WHERE ';
            $hasWhere = true;
        } else {
            $sql .= ' AND ';
        }
        $sql .= 'LOWER(I.NOME) LIKE LOWER(?) ';
        $ingrNameParam = '%'.trim($ingredientName).'%';
    }
    if (trim($categoryId) !== '') {
        if (!$hasWhere) {
            $sql .= ' WHERE ';
            $hasWhere = true;
        } else {
            $sql .= ' AND ';
        }
        $sql .= 'C.ID = ? ';
    }
    $sql .= ' ORDER BY R.TITOLO';
    $param = array();
    if (trim($recipeTitle) !== '') {
        array_push($param, $recTitleParam);
    }
    if (trim($ingredientName) !== '') {
        array_push($param, $ingrNameParam);
    }
    if (trim($categoryId) !== '') {
        array_push($param, trim($categoryId));
    }
    $statement = $pdo->prepare($sql);
    $statement->execute($param);
    Database::disconnect();
    return $statement;
}

function get_recipe_ingredients($recId) {
    $pdo = Database::connect();
    $sql = 'SELECT I.ID, I.NOME FROM INGREDIENTE I JOIN RICETTA_INGREDIENTE RI ON I.ID = RI.ID_INGREDIENTE WHERE RI.ID_RICETTA = ?';
    $statement = $pdo->prepare($sql);
    Database::disconnect();
    $statement->execute(array($recId));
    return $statement->fetchAll();
}

function get_recipe_title($recId) {
    $pdo = Database::connect();
    $sql = 'SELECT TITOLO FROM RICETTA WHERE ID = ?';
    $statement = $pdo->prepare($sql);
    Database::disconnect();
    $statement->execute(array($recId));
    return $statement->fetch()['TITOLO'];
}

function get_recipe_categories($recId) {
    $pdo = Database::connect();
    $sql = 'SELECT C.ID, C.NOME FROM CATEGORIA C JOIN RICETTA_CATEGORIA RC ON C.ID = RC.ID_CATEGORIA WHERE RC.ID_RICETTA = ?';
    $statement = $pdo->prepare($sql);
    Database::disconnect();
    $statement->execute(array($recId));
    return $statement->fetchAll();
}

?>
