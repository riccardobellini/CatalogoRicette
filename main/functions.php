<?php

require_once 'database.php';


// UTILITIES

function issetor(&$var, $defaultValue = false) {
    return isset($var) ? $var : $defaultValue;
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

?>
