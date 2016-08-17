<?php
include '../header.php';
require_once '../../main/functions.php';
?>

<?php

function _performupdate() {
    $id = $_POST['categoryId'];
    $name = $_POST['categoryName'];

    if ($id !== '' && $name !== '') {
        editcategory($id, $name);
        header("Location: list.php");
    }
}

function _performinsert() {
    $name = $_POST['categoryName'];
    if ($name !== '') {
        addcategory($name);
        header("Location: list.php");
    }
}

$name = $_POST['categoryName'];
if ($name !== '') {
    $method = $_GET['method'];
    if ($method === 'add') {
        _performinsert();
    } else if ($method === 'edit') {
        _performupdate();
    }
}
?>