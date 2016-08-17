<?php
include '../header.php';
require_once '../../main/functions.php';
?>

<?php

function _performupdate() {
    $id = $_POST['ingredientId'];
    $name = $_POST['ingredientName'];

    if ($id !== '' && $name !== '') {
        editingredient($id, $name);
        header("Location: list.php");
    }
}

function _performinsert() {
    $name = $_POST['ingredientName'];
    if ($name !== '') {
        addingredient($name);
        header("Location: list.php");
    }
}

$name = $_POST['ingredientName'];
if ($name !== '') {
    $method = $_GET['method'];
    if ($method === 'add') {
        _performinsert();
    } else if ($method === 'edit') {
        _performupdate();
    }
}
?>