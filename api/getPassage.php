<?php
/**
 * Created by PhpStorm.
 * User: Wilson
 * Date: 5/21/2016
 * Time: 8:53 PM
 */

include 'constant.php';
$passage_id = $_GET['pid'];
$getPassage = $conn->query("  select passage.content, passage.title, passage.id, category.name from passage, category where passage.category_id = category.id and passage.id = '".$passage_id."'")->fetch(PDO::FETCH_ASSOC);

echo json_encode($getPassage);