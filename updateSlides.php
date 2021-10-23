<?php
/**
 * Used in customize.php --> customize.js --> updateSlides.php
 * Updates the Slides description
 */
ini_set('display_errors', 1);
error_reporting(E_ALL);
// connect to database
require('includes/dbcreds.php');
$values = array();
// retrieving values
$header = $_POST['header'];
$sub = $_POST['sub'];
$headerId=$_POST['id'] * 2 + 1;
$subId=$headerId + 1;

// define/update and execute the query
// update header
$update = "UPDATE `form` SET `state`= '$header' WHERE `id` = '$headerId'";
$result = mysqli_query($cnxn, $update);

//update subheader
$update = "UPDATE `form` SET `state`= '$sub' WHERE `id` = '$subId'";
$result = mysqli_query($cnxn, $update);

// select the
$select = "SELECT `state` FROM `form` WHERE `id` BETWEEN '$headerId' AND '$subId'";
$resultS = mysqli_query($cnxn, $select);

// printing
$index = 1;
foreach ($resultS as $row){
    if($index == 1){
        $values["header"] = $row['state'];
        $index++;
    } else {
        $values["sub"] = $row['state'];
    }
}
echo json_encode($values);
