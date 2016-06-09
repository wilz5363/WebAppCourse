<?php
/**
 * Created by PhpStorm.
 * User: Wilson
 * Date: 6/6/2016
 * Time: 4:23 PM
 */
include 'constant.php';
$category = $_GET['cid'];
$getPassageSelections = $conn->query("select id, title from passage where category_id = '$category' limit 5")->fetch(PDO::FETCH_ASSOC);

echo json_encode($getPassageSelections);