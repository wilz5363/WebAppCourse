<?php
include 'constant.php';
$title = 'Passages';
$section = 'passages';


if ($_SERVER['REQUEST_METHOD'] == 'GET' AND isset($_GET['cid'])) {
//get categories
    try {
        $getCategory = $conn->prepare('select name from category where id=?');
        $getCategory->bindParam(1, $_GET['cid']);
        $getCategory->execute();
        $category = $getCategory->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo $e->getMessage();
        exit();
    }

//get passages
    try {
        $getPassages = $conn->prepare('select passage.id, passage.title, passage.updated_at, category.name from passage, category where category.id = passage.category_id and category.id = ?');
        $getPassages->bindParam(1, $_GET['cid']);
        $getPassages->execute();
        $passages = $getPassages->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo $e->getMessage();
        exit();
    }
}


//post new passage
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'validate.php';
    $title = validate($_POST['passageTitleInput']);
    $content = validate($_POST['passageContentInput']);
    $categoryId = $_GET['cid'];

    try {
        $postNewPassage = $conn->prepare('insert into passage(title, content, category_id) values (?,?,?)');
        $postNewPassage->bindParam(1, $title);
        $postNewPassage->bindParam(2, $content);
        $postNewPassage->bindParam(3, $categoryId);
        $postNewPassage->execute();
        header("location:passages.php?cid=" . $_GET['cid']);
    } catch (PDOException $e) {
        echo $e->getMessage();
        exit();
    }
}
include 'header.php'; ?>
<div class="container">
    <ol class="breadcrumb">
        <li><a href="index.php">Category</a></li>
        <li class="active">Passages</li>
    </ol>
    <h1 class="page-header">Passages</h1>

    <?php
    if (count($passages) == 0) {
        echo '<h3 class="text-center">No Passages Added.</h3>';
    } else { ?>
        <table class="table table-hover">
            <thead>
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Last Updated At</th>
                <th>Category</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($passages as $passage) {
                echo '<tr>'
                    . '<td>' . $passage['id'] . '</td>'
                    . '<td>' . $passage['title'] . '</td>'
                    . '<td>' . $passage['updated_at'] . '</td>'
                    . '<td>' . $passage['name'] . '</td>'
                    . '<td><a href="passage.php?pid=' . $passage['id'] . '">View Passage </a><a href="question.php?cid='.$_GET['cid'].'&pid=' . $passage['id'] . '">|| View Questions</a></td>'
                    . ' </tr > ';
            }
            ?>
            </tbody>
        </table>
    <?php
    }
    ?>
</div>


<div class="modal fade" id="modal-id">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="post" action="">
                    <fieldset>
                        <legend>Insert New Passage</legend>
                        <div class="form-group">
                            <label for="passageTitle" class="col-lg-2 control-label">Title: </label>
                            <div class="col-lg-10">
                                <input type="text" name="passageTitleInput" id="passageTitle" class="form-control"
                                       required="required" style="text-transform:uppercase" autofocus>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="passageContent" class="col-lg-2 control-label">Textarea</label>
                            <div class="col-lg-10">
                                <textarea class="form-control" rows="25" id="passageContent" name="passageContentInput"
                                          style="overflow: scroll;text-transform:uppercase"></textarea>
                                <grammarly-btn>
                                    <div style="z-index: 2; opacity: 1; transform: translate(409.156px, 53px);"
                                         class="_9b5ef6-textarea_btn _9b5ef6-not_focused" data-grammarly-reactid=".0">
                                        <div class="_9b5ef6-transform_wrap" data-grammarly-reactid=".0.0">
                                            <div title="Protected by Grammarly" class="_9b5ef6-status"
                                                 data-grammarly-reactid=".0.0.0">&nbsp;</div>
                                        </div>
                                    </div>
                                </grammarly-btn>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="category" class="col-lg-2 control-label">Category: </label>
                            <div class="col-lg-10">
                                <input type="text" name="categoryInput" id="category" class="form-control"
                                       value="<?php echo $category['name']; ?>" readonly>
                            </div>
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

<?php include 'footer.php'; ?>

