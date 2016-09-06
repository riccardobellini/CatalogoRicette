<?php
if (!isset($_GET['ajax'])) {
    include '../header.php';
}
require_once '../../main/functions.php';
?>

<?php

function _performupdate() {
    $id = $_POST['categoryId'];
    $name = $_POST['categoryName'];

    if ($id !== '' && $name !== '') {
        editcategory($id, $name);
    }
    return $id;
}

function _performinsert() {
    $name = $_POST['categoryName'];
    if ($name !== '') {
        return addcategory($name);
    }
}

$name = $_POST['categoryName'];
if ($name !== '') {
    $method = $_GET['method'];
    $categId = '';
    if ($method === 'add') {
        $categId = _performinsert();
    } else if ($method === 'edit') {
        $categId = _performupdate();
    }

    if (isset($_GET['ajax'])) {
        header('Content-Type: application/json');
        $responseData = [ 'id' => $categId, 'nome' => htmlspecialchars($name)];
        echo json_encode($responseData);
    } else {
        header('Location: list.php');
    }
}
?>