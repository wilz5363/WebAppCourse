<?php

$title = 'Passage';
$section = 'passage';
include 'constant.php';
$passage_id;
$getPassage;
if(isset($_GET['pid'])){
    $passage_id = $_GET['pid'];

    try{
        $getPassage = $conn->query("select passage.content, passage.title, passage.id, category.name from passage, category where passage.category_id = category.id and passage.id = '".$passage_id."'")->fetch(PDO::FETCH_ASSOC);
    }catch(PDOException $e){
        echo $e->getMessage();
    }
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    if(isset($_POST['updateBtn'])){
        $passge_title = validate($_POST['passageTitleInput']);
        $passage_content = validate($_POST['passageContentInput']);

        try{
            $updatePassage = $conn->prepare("update passage set title = ?, content = ?, updated_at = now() where id = ?");
            $updatePassage->bindParam(1, $passge_title);
            $updatePassage->bindParam(2, $passage_content);
            $updatePassage->bindParam(3, $passage_id);
            $updatePassage->execute();
            header("location:passage.php?pid=$passage_id");
        }catch(PDOException $e){
            echo $e->getMessage();
        }

    }
}



include 'header.php'; ?>

<div class="container">
    <ol class="breadcrumb">
        <li><a href="index.php">Category</a></li>
        <li><a href="javascript:history.back()">Passages</a></li>
        <li><?php echo $getPassage['title'];?></li>
    </ol>


    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <form class="form-horizontal" method="post" action="">
                <fieldset>
                    <legend>Passage</legend>
                    <div class="form-group">
                        <label for="passageTitle" class="col-lg-2 control-label">Title: </label>
                        <div class="col-lg-10">
                            <input type="text" name="passageTitleInput" id="passageTitle" class="form-control"
                                   required="required" autofocus value="<?php echo htmlspecialchars($getPassage['title']);?>" onchange="changeDetection()">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="passageContent" class="col-lg-2 control-label">Textarea</label>
                        <div class="col-lg-10">
                                <textarea class="form-control" rows="25" id="passageContent" name="passageContentInput"
                                          style="overflow: scroll"><?php echo htmlspecialchars($getPassage['content']);?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="category" class="col-lg-2 control-label">Category: </label>
                        <div class="col-lg-10">
                            <input type="text" name="categoryInput" id="category" class="form-control"
                                   value="<?php echo htmlspecialchars($getPassage['name']);?>" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-10 col-lg-offset-2">
                            <a href="javascript:history.back()" class="btn btn-default">Cancel</a>
                            <button type="submit" id="passageUpdateBtn" name="updateBtn" class="btn btn-primary" disabled>Update</button>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
