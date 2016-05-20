<?php
include 'constant.php';
$title = 'Passage';
$section = 'passage';

$passage_id = $_GET['pid'];

$getPassage = $conn->query("  select passage.content, passage.title, passage.id, category.name from passage, category where passage.category_id = category.id and passage.id = '".$passage_id."'")->fetch(PDO::FETCH_ASSOC);
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
                                   value="<?php echo htmlspecialchars($getPassage['name']);?>" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-10 col-lg-offset-2">
                            <a href="javascript:history.back()" class="btn btn-default">Cancel</a>
                            <button type="submit" id="passageUpdateBtn" class="btn btn-primary" disabled>Update</button>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
