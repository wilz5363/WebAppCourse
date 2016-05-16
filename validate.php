<?php
/**
 * Created by PhpStorm.
 * User: Wilson
 * Date: 5/16/2016
 * Time: 2:44 PM
 */
function validate($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}