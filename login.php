<?php
$section = "login";
$title = "Login";
include 'constant.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['submitBtn'])) {
        $username = validate($_POST['adminNameInput']);
        $password = validate($_POST['passwordInput']);

        try {
            $loginQuery = $conn->prepare("select count(*) as admin_count from admin where username = ? and password = ?");
            $loginQuery->bindParam(1, $username);
            $loginQuery->bindParam(2, $password);
            $loginQuery->execute();
            $result = $loginQuery->fetch(PDO::FETCH_ASSOC);
            if($result['admin_count'] >0){
               $_SESSION['user'] = $username;
                header("location: index.php");
            }else{
                $err_msg = 'Wrong username or password.';
            }

        } catch (PDOException $e) {
            $err_msg = 'Somthing\'s with the server. Please try again.';
        }
    }
}

include 'header.php'; ?>

<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3 text-center well">
            <?php if (isset($err_msg)) {?>
                <div class="alert alert-danger">
                	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                	<strong>Attention!!</strong> <?php echo $err_msg;?>
                </div>
            <?php } ?>
            <form action="" method="post" role="form" autocomplete="off">
                <legend>Log in</legend>

                <div class="form-group">
                    <label for="adminName" class="col-sm-2 control-label">Admin:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="adminName" name="adminNameInput">
                    </div>
                </div>
                <div class="form-group">
                    <label for="password" class="col-sm-2 control-label">Password</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" id="password" name="passwordInput">
                    </div>
                </div>
                <button type="submit" name="submitBtn" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
