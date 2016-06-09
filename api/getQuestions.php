<?php
/**
 * Created by PhpStorm.
 * User: Wilson
 * Date: 6/7/2016
 * Time: 3:45 AM
 */
$id = $_GET['id'];
include "constant.php";
$sql = "";

try{
    $getQuestions = $conn->query("SELECT question_content, selection_content, selection_status FROM question, selection WHERE passage_id ='$id' AND question.id = selection.question_id")->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($getQuestions);
}catch(PDOException $e){
    echo $e->getMessage();
}