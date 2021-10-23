<?php
/**
 * Used by home.html --> home.js --> getBio.php
 * Gets the server descriptions of the slides and bio
 */

ini_set('display_errors', 1);
error_reporting(E_ALL);
// connect to database
require('includes/dbcreds.php');

$values = array();

// gets the Bio descriptions
$selectBio = "SELECT `state` FROM `form` WHERE `id` = 2";
$resultBio = mysqli_query($cnxn, $selectBio);
$values['bio'] = mysqli_fetch_assoc($resultBio)['state'];

// gets the Slides Descriptions
$select = "SELECT `state` FROM `form` WHERE `id` > 2";
$result = mysqli_query($cnxn, $select);

// prints the
$sub = true;
$index = 1;
foreach ($result as $row){
    if($sub){
        $description = "header" . "$index";
        $values["$description"] = $row['state'];
        $sub = false;
    } else {
        $description = "sub" . "$index";
        $values["$description"] = $row['state'];
        $sub = true;
        $index = $index + 1;
    }
}
echo json_encode($values);