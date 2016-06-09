<?php
/**
 * Created by PhpStorm.
 * User: Wilson
 * Date: 6/8/2016
 * Time: 12:23 PM
 */
include "constant.php";
$qid = $_GET['qid'];
$cid = $_GET['cid'];
$pid = $_GET['pid'];

    try{
        $deleteQuestion = $conn->prepare("update  question set status = 'UNAVAILABLE' where id = ?");
        $deleteQuestion->bindParam(1, $qid);
        $deleteQuestion->execute();
        header("location:question.php?cid=$cid&pid=$pid");
    }catch(PDOException $e){
        echo $e->getMessage();
    }



