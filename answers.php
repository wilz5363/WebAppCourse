<?php
/**
 * Created by PhpStorm.
 * User: Wilson
 * Date: 6/2/2016
 * Time: 9:02 PM
 */
include 'constant.php';
$title = 'Question';
$section = 'question';
$answers = [];
$qid = $_GET['qid'];
$passage_title = $_GET['passage'];

try {
    $ansStmt = $conn->prepare("select * from selection where question_id = ?");
    $ansStmt->bindParam(1, $qid);
    $ansStmt->execute();
    $resultset = $ansStmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($resultset as $r) {
        $answers[] = $r;
    }
    $ansStmt->closeCursor();
} catch (PDOException $e) {
    echo $e->getMessage();
}

if($_SERVER['REQUEST_METHOD'] == 'POST' and isset($_POST['updateBtn'])){
    $update_all = $conn->prepare("update selection set selection_status = 0 where question_id = ?");
    $update_all->bindParam(1, $qid);
    $update_all->execute();
    $update_all->closeCursor();

    $update_single = $conn->prepare("update selection set selection_status = 1 where id = ?");
    $update_single->bindParam(1, $_POST['updateBtn']);
    $update_single->execute();
    $update_single->closeCursor();

    header("location: answers.php?qid=$qid&passage=$passage_title");
}

include "header.php";
?>
<div class="container">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="index.php">Category</a></li>
            <li><a href="javascript:history.back()">Passage</a></li>
            <li class="active"><?php echo $passage_title; ?></li>
        </ol>

        <h1 class="page-header">Answer Selection</h1>
        <?php
        if (count($answers) == 0) {
            echo '<h1 class="text-center page-header">No answer selection added yet.</h1>';
        } else {
            ?>
           <form action="" method="post" role="form">
               <table class="table table-hover">
                   <thead>
                   <tr>
                       <th>#</th>
                       <th>Answer Selection</th>
                       <th>Current Answer</th>
                       <th>Edit Answer</th>
                   </tr>
                   </thead>
                   <tbody>
                   <?php
                   $count = 0;
                   foreach ($answers as $answer) {
                       echo '<tr>'
                           . '<td>' . ++$count . '</td>'
                           . '<td>' . htmlspecialchars($answer['selection_content']) . '</td>'
                           . '<td>' . ($answer['selection_status'] == 1 ? 'TRUE' : 'FALSE') . '</td>'
                           . '<td><button id="updateAnswer" name="updateBtn" class="btn btn-primary" value="'.$answer['id'].'">Make this the answer</button></td>'
                           . '</tr>';
                   }
                   ?>
                   </tbody>
               </table>
           </form>
        <?php } ?>
    </div>

</div>

<?php
include "footer.php";
?>