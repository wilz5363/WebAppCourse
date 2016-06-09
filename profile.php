<?php
/**
 * Created by PhpStorm.
 * User: Wilson
 * Date: 6/8/2016
 * Time: 6:24 PM
 */
$title = 'Profile';
$section  = 'profile';
include "constant.php";

$user = $_SESSION['user'];

$getUser = $conn->query("select * from admin where username = '$user'")->fetch(PDO::FETCH_ASSOC);

include "header.php";
?>
<div class="container">
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-lg-offset-3 col-md-offset-3">
			<form action="" method="post" role="form">
				<h1 class="page-header">Profile</h1>
				<div class="form-group">
					<label for="name">Name: </label>
					<input type="text" class="form-control" name="nameInput" id="name" value="<?php echo $getUser['name']?>">
				</div>

                <div class="form-group">
                        <label for="username">Username: </label>
                    <input type="text" class="form-control" name="usernameInput" id="username" value="<?php echo $getUser['username']?>" readonly>
                </div>

                <div class="form-group">
                    <label for="phoneno">Password: </label>
                    <input type="password" class="form-control" name="passwordInput" id="password" value="<?php echo $getUser['password']?>" readonly disabled>
                    <a href="changePassword.php">Edit Password</a>
                </div>



				<button type="submit" class="btn btn-primary">Submit</button>
			</form>
		</div>
	</div>
</div>



<?php include "footer.php";?>
