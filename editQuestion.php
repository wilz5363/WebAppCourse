<?php
/**
 * Created by PhpStorm.
 * User: Wilson
 * Date: 6/7/2016
 * Time: 11:37 PM
 */
$title = "Edit Question";
$section = "editQuestion";
include "constant.php";

$previous = "javascript:history.go(-1)";
$id;
if(isset($_SERVER['HTTP_REFERER'])) {
	$previous;
}

	if(isset($_GET['qid'])){
		$id = $_GET['qid'];
	}
	try{
		$getQuestion = $conn->prepare("select question_content from question where id = ?");
		$getQuestion->bindParam(1, $id);
		$getQuestion->execute();
		$questionResult = $getQuestion->fetch(PDO::FETCH_ASSOC);
		$getQuestion->closeCursor();
	}catch(PDOException $e){
		echo $e->getMessage();
	}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
	if(isset($_POST['updateBtn'])){
		$questionContent = validate($_POST['questionContentInput']);
		try{
			$updateQuestion = $conn->prepare("update question set question_content = ? where id = ?");
			$updateQuestion->bindParam(1, $questionContent);
			$updateQuestion->bindParam(2, $id);
			$updateQuestion->execute();

			header("location: editQuestion.php?qid=".$id);

		}catch(PDOException $e){
			echo $e->getMessage();
		}
	}
}




include "header.php";
?>
<div class="container">
	<div class="row">
		<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-lg-offset-3">
			<form action="" method="post" role="form">
				<div class="form-group">
					<h3 for="questionContent">Question</h3>
					<textarea name="questionContentInput" id="questionContent" cols="67" rows="10" required><?php echo htmlspecialchars($questionResult['question_content'])?></textarea>
				</div>
				<button type="submit" class="btn btn-primary btn-block" name="updateBtn">Update</button>
			</form>
		</div>
	</div>
</div>
<?php include "footer.php";?>
