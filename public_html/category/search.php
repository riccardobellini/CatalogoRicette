<?php
require_once '../../main/functions.php';

$json_result = array();
$json_row = array();
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $param = trim(strip_tags($_GET['query']));

    $res = search_category_by_name($param);
    while ($obj = $res->fetch()) {
        $id = htmlentities(stripslashes($obj['ID']));
        $name = htmlentities(stripslashes($obj['NOME']));

        $json_row['id'] = $id;
        $json_row['name'] = $name;
        array_push($json_result, $json_row);
    }
}
if (count($json_result) > 0) {
    echo json_encode($json_result);
} else {
    echo json_encode(new stdClass);
}
flush();

?>