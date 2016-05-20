<?php
/**
 * Created by PhpStorm.
 * User: Wilson
 * Date: 5/21/2016
 * Time: 12:36 AM
 */
include 'constant.php';
$title = 'Question';
$section = 'question';
$questions = [];
$cid = $_GET['cid'];
$pid = $_GET['pid'];


try{
    $getQuestions = $conn->query("select * from question where passage_id =".$pid)->fetchAll(PDO::FETCH_ASSOC);
    foreach($getQuestions as $q){
        $questions[] = $q;
    }
}catch(PDOException $e){
    echo $e->getMessage();
}
include "header.php";
?>
<div class="container">
    <ol class="breadcrumb">
        <li><a href="index.php">Category</a></li>
        <li><a href="javascript:history.back()">Passage</a></li>
        <li class="active">Question</li>
    </ol>
    <?php if(count($questions) == 0){
        echo '<h3 class="text-center">No Questions Added.</h3>';
    }?>
</div>


<?php include "footer.php";?>
