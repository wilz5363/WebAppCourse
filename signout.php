<?php
/**
 * Created by PhpStorm.
 * User: Wilson
 * Date: 6/6/2016
 * Time: 1:41 PM
 */

session_start();
if(isset($_SESSION['user'])){
    session_destroy();
}
header("location: login.php");