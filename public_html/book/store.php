<?php
include '../header.php';
require_once '../../main/functions.php';
?>

<?php

function _performupdate() {
    $id = $_POST['bookId'];
    $title = $_POST['bookTitle'];

    if ($id !== '' && $title !== '') {
        editbook($id, $title);
        header("Location: list.php");
    }
}

function _performinsert() {
    $title = $_POST['bookTitle'];
    if ($title !== '') {
        addbook($title);
        header("Location: list.php");
    }
}

$title = $_POST['bookTitle'];
if ($title !== '') {
    $method = $_GET['method'];
    if ($method === 'add') {
        _performinsert();
    } else if ($method === 'edit') {
        _performupdate();
    }
}
?>