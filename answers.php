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
} catch (PDOException $e) {
    echo $e->getMessage();
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
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Answer Selection</th>
                    <th>Selection Status</th>
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
                        . '</tr>';
                }
                ?>
                </tbody>
            </table>
        <?php } ?>
    </div>
</div>
