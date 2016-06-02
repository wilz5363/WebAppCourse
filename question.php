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

$subsection = ($cid == '1' ? 'tf' : ($cid == '2' ? 'multi' : ($cid == '3' ? 'exam' : 'nill')));

if ($subsection == 'nill') {
    header("location: errorPage.html");
}

try {
    $passage_title = $conn->query("select title from passage where id ='" . $pid . "'")->fetch(PDO::FETCH_ASSOC);

    $getQuestions = $conn->query("select * from question where passage_id =" . $pid)->fetchAll(PDO::FETCH_ASSOC);
    foreach ($getQuestions as $q) {
        $questions[] = $q;
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    try {

        $insert_question = $conn->prepare("insert into question(question_content, passage_id) values (?,?)");
        $insert_question->bindParam(1, $_POST['questionInput']);
        $insert_question->bindParam(2, $pid);
        $insert_question->execute();
        $last_id = $conn->lastInsertId();

        if ($subsection == 'tf') {
            for ($i = 1; $i < 4; $i++) {
                if (!is_null($_POST['choice' . $i])) {
                    $insert_selections = $conn->prepare("insert into selection(selection_content,selection_status, question_id) values (?,1,?)");
                    $insert_selections->bindParam(1, $_POST['choise' . $i]);
                    $insert_selections->bindParam(2, $last_id);
                    $insert_selections->execute();

                } else {
                    $insert_selections = $conn->query("insert into selection(selection_content,selection_status, question_id) values (?,0,?)");
                    $insert_selections->bindParam(1, $_POST['choise' . $i]);
                    $insert_selections->bindParam(2, $last_id);
                    $insert_selections->execute();
                }
            }
            header("location: question.php?cid=$cid&pid=$pid");
        } else if ($subsection == 'multi') {
            for ($i = 1; $i < 5; $i++) {
                if (!is_null($_POST['choice' . $i])) {
                    $insert_selections = $conn->prepare("insert into selection(selection_content,selection_status, question_id) values (?,1,?)");
                    $insert_selections->bindParam(1, $_POST['choise' . $i]);
                    $insert_selections->bindParam(2, $last_id);
                    $insert_selections->execute();
                } else {
                    $insert_selections = $conn->prepare("insert into selection(selection_content,selection_status, question_id) values (?,0,?)");
                    $insert_selections->bindParam(1, $_POST['choise' . $i]);
                    $insert_selections->bindParam(2, $last_id);
                    $insert_selections->execute();
                }
            }
            header("location: question.php?cid=$cid&pid=$pid");
        }


    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}


include "header.php";
?>
<div class="container">
    <ol class="breadcrumb">
        <li><a href="index.php">Category</a></li>
        <li><a href="javascript:history.back()">Passage</a></li>
        <li class="active"><?php echo $passage_title['title']; ?></li>
    </ol>

    <h1 class="page-header">Questions</h1>
    <?php if (count($questions) == 0) {
        echo '<h3 class="text-center">No Questions Added.</h3>';
    } else { ?>
        <table class="table table-hover">
            <thead>
            <tr>
                <th>#</th>
                <th>Question</th>
                <th>Answer</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <?php
            $id = 0;
            foreach ($questions as $question) {
                $id++;
                echo '<tr>'
                    . '<td>' . $id . '</td>'
                    . '<td>' . $question['question_content'] . '</td>'
                    . '<td><a href="answers.php?qid=' . $question['id'] . '&passage=' . $passage_title['title'] . '">View Question</a></td>'
                    . '</tr>';
            }
            ?>
            </tbody>
        </table>
    <?php } ?>
</div>


<div class="modal fade" id="modal-id">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="post" action="" autocomplete="off">
                    <fieldset>
                        <legend>Insert New Question</legend>
                        <div class="form-group">
                            <label for="question" class="col-lg-2 control-label">Question</label>
                            <div class="col-lg-10">
                                <input type="text" name="questionInput" id="question" class="form-control"
                                       required="required" autofocus>
                            </div>
                        </div>
                        <span class="small">Select the correct answer.</span>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Answer Selections</label>
                            <?php if ($subsection == 'tf') { ?>
                                <div class="col-lg-10">
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="choice1" id="optionsRadios1"
                                                   value="TRUE">
                                            <input type="text" class="form-control" name="choise1" value="TRUE"
                                                   readonly>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-10 col-lg-offset-2">
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="choice2" id="optionsRadios1"
                                                   value="FALSE">
                                            <input type="text" class="form-control" name="choise2" value="FALSE"
                                                   readonly>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-10 col-lg-offset-2">
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="choice3" id="optionsRadios1"
                                                   value="NOT STATED">
                                            <input type="text" class="form-control" name="choise3" value="NOT STATED"
                                                   readonly>
                                        </label>
                                    </div>
                                </div>
                            <?php } else if ($subsection == 'multi') { ?>
                                <div class="col-lg-10 col-lg-offset-2">
                                    <div class="radio">
                                        <input type="radio" name="choice1" id="optionsRadios1">
                                        <input type="text" class="form-control" name="choise1" required>
                                    </div>
                                </div>
                                <div class="col-lg-10 col-lg-offset-2">
                                    <div class="radio">
                                        <input type="radio" name="choice2" id="optionsRadios2">
                                        <input type="text" class="form-control" name="choise2" required>
                                    </div>
                                </div>
                                <div class="col-lg-10 col-lg-offset-2">
                                    <div class="radio">
                                        <input type="radio" name="choice3" id="optionsRadios3">
                                        <input type="text" class="form-control" name="choise3" required>
                                    </div>
                                </div>
                                <div class="col-lg-10 col-lg-offset-2">
                                    <div class="radio">
                                        <input type="radio" name="choice4" id="optionsRadios4">
                                        <input type="text" class="form-control" name="choise4" required>
                                    </div>
                                </div>
                                <div class="col-lg-10 col-lg-offset-2">
                                    <div class="radio">
                                        <input type="radio" name="choice5" id="optionsRadios5">
                                        <input type="text" class="form-control" name="choise5" required>
                                    </div>
                                </div>

                            <?php } ?>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-10 col-lg-offset-2">
                                <button type="reset" class="btn btn-default">Cancel</button>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
            <div class="modal-footer">
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<?php include "footer.php"; ?>
