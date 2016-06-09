<?php
/**
 * Created by PhpStorm.
 * User: Wilson
 * Date: 6/8/2016
 * Time: 6:47 PM
 */

$title = 'Categories';
$section = 'category';
include 'constant.php';


include "header.php";
?>

<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-lg-offset-3 col-md-offset-3">
            <form action="" method="post" role="form" id="passwordForm">
                <h1 class="page-header">Edit Password</h1>
                <div class="form-group">
                    <label for="oldPassword">Old Password: </label>
                    <input type="password" class="form-control" name="oldPasswordInput" id="oldPassword" placeholder="Old Password" required>
                </div>

                <div class="form-group">
                    <label for="newPassword">New Password: </label>
                    <input type="password" class="form-control" name="newPasswordInput" id="newPassword" placeholder="New Password" required>
                </div>

                <div class="form-group">
                    <label for="confirmPassword">Password: </label>
                    <input type="password" class="form-control" name="confirmPasswordInput" id="confirmPassword" placeholder="Confirm New Password" required>
                </div>
                <button type="submit" class="btn btn-primary btn-block" id="updatePasswordBtn">Submit</button>
            </form>
        </div>
    </div>
</div>
<?php
include "footer.php";
?>
