<?php
/**
 * Used in requested.php --> requests.js --> updateFormState.php
 * Update the state of the form to either show or hide.
 */
ini_set('display_errors', 1);
error_reporting(E_ALL);
// connect to database
require('includes/dbcreds.php');

$state = $_POST['state'];


// define/update and execute the query
$update = "UPDATE `form` SET `state`= '$state' WHERE `id` = 1";
$result = mysqli_query($cnxn, $update);