<?php
/**
 * Created by PhpStorm.
 * User: Wilson
 * Date: 6/8/2016
 * Time: 8:40 PM
 */
session_start();
include "api/constant.php";
include "validate.php";
$opassword = validate($_POST['oldPasswordInput']);
$nPassword = validate($_POST['newPasswordInput']);
try {
    $searchOPassword = $conn->prepare("select count(*) as admin_count from admin where password = ?");
    $searchOPassword->bindParam(1, $opassword);
    $searchOPassword->execute();
    $result = $searchOPassword->fetch(PDO::FETCH_ASSOC);
//    $searchOPassword->closeCursor();
} catch (PDOException $e) {
    $e->getMessage();
}
if ($result['admin_count'] > 0) {

    try {
        $updateNPassword = $conn->prepare("update admin set password = ? where username = ?");
        $updateNPassword->bindParam(1, $nPassword);
        $updateNPassword->bindParam(2, $_SESSION['user']);
        if ($updateNPassword->execute()) {
            echo "success";
        } else {
            echo "Unable to update password. Pleas try again.";
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }

} else {
    echo "Old Password was not correct. Please try again";
}