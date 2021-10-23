<?php
/**
 * Used by home.html --> home.js --> getFormState.php
 * Used by requests.php --> requests.js --> getFormState.php
 * 
 * Gets the state of the form either show(checked) or hide(unchecked)
 */
ini_set('display_errors', 1);
error_reporting(E_ALL);
// connect to database
require('includes/dbcreds.php');

// define/update and execute the query
$select = "SELECT `state` FROM `form` WHERE `id` = 1";
$result = mysqli_query($cnxn, $select);
if($result){
    if(mysqli_fetch_assoc($result)['state'] == "CHECKED"){
        echo "true";
    } else {
        echo "false";
    }
} else {
    echo "Failed!!";
}

