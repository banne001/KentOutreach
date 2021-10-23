<?php
/**
 * Used in customize.php --> customize.js --> update.Bio
 * Update the bio.
 */

ini_set('display_errors', 1);
error_reporting(E_ALL);
// connect to database
require('includes/dbcreds.php');

// description to be uploaded
$desc = $_POST['desc'];

// define/update and execute the query
$update = "UPDATE `form` SET `state`= '$desc' WHERE `id` = 2";
$result = mysqli_query($cnxn, $update);

echo "$desc";