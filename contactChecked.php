<?php
/**
 * Used by requests.php --> requests.js --> contactChecked.php.
 * updates the list of requests to be checked or unchecked.
 */
ini_set('display_errors', 1);
error_reporting(E_ALL);
// connect to database
require('includes/dbcreds.php');

// get the values and assign if checked
$request_id = $_POST['id'];
$check = "";
if ( $_POST['check']== "true"){
    $check = "checked";
}

// define/update and execute the query
$update = "UPDATE `requests` SET `contacted`= '$check' WHERE `request_ID` = '$request_id'";
$result = mysqli_query($cnxn, $update);

