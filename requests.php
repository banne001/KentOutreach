<?php
/*
 * Heather Monatt
 * requests.php
 * Display requests for help
 */

// Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();

if (!isset($_SESSION['loggedin'])) {
    header("location: adminLogin.html");
}

// Redirect if form has not been submitted
//if(empty($_POST)){
   // header("location: KentOutreach/form.html");
//}

// Includes
require('includes/dbcreds.php');

?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <!--Custom CSS -->
    <link rel="stylesheet" href="styles/footer.css">
    <link rel="stylesheet" href="styles/requests.css">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
    <title>Kent Outreach</title>

</head>
<nav class="navbar navbar-expand-sm txt-white">
    <div class="container">
        <a href="requests.php" class="navbar-brand" id="logo"><strong>Kent Outreach</strong></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse ml-auto" id="navbarNavDropdown">
            <ul class="navbar-nav ml-auto txt-white">
                <span class="navbar-text pt-3 px-3">
                 
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    Logged in as Peter</span>
                <li class="nav-item dropdown">
                    <a class="nav-link" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Menu <img src="images/hamMenu.jpg" alt="Menu" id="menu">
                    </a>
                    <div class="dropdown-menu dropdown-menu-right px-3" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="http://java-chip.greenriverdev.com/KentOutreach/requests.php">Requests</a>
                        <a class="dropdown-item" href="customize.php">Customize Home Page</a>
                        <a class="dropdown-item" href="logout.php">Log Out</a>
                    </div>
                </li>
            </ul>
        </div>
    </div>

</nav>
<br>
<div class="container py-3">
    <h1><strong>OUTREACH REQUESTS</strong></h1>
</div>

<div class="container" id="main" style="overflow-x:auto;">
    <h2><strong>Requests</strong></h2>
    <br>
    <table id="requests-table" class="display">
        <thead>
        <tr>
            <td>Contacted</td>
            <td>Timestamp</td>
            <td>Name</td>
            <td>Zip
            <td>Email</td>
            <td>Phone</td>
            <td>Needs</td>
            <td>Other Description</td>

        </tr>
        </thead>
        <tbody>

    <?php
    $sql = "SELECT * FROM requests";
    global $cnxn;
    $result = mysqli_query($cnxn, $sql);

    //var_dump($result);

    foreach($result as $row){
        $request_date = date("M d, Y g:i a", strtotime($row['requestDate']."- 3 hours"));
        $fullname = $row['firstName'] . " " . $row['lastName'];
        $zip = $row['zip'];
        $email = $row['email'];
        $phone = $row['phone'];
        $needs = $row['need'];
        $otherInput = $row['otherDescription'];
        
        $request_id = $row['request_ID'];
        $contacted = $row['contacted'];

        if($contacted == "checked"){
            echo"<tr id='t$request_id' style='background: tan'>";
        } else {
            echo"<tr id='t$request_id'>";
        }

        echo "<td class='text-center'><p class='d-none'>$request_id</p><input type='checkbox' class='contacted' id='$request_id' $contacted></td>";
        echo"<td>$request_date</td>";
        echo"<td>$fullname</td>";
        echo"<td>$zip</td>";
        echo"<td>$email</td>";
        echo"<td>$phone</td>";
        echo"<td>$needs</td>";
        echo"<td>$otherInput</td>";
        echo"</tr>";

    }
    ?>
        </tbody>
    </table>
    <br>
</div>
<div class="container d-flex justify-content-center ">
    <div class="custom-control custom-switch px-auto justify-content-center align-items-center">
        <input type="checkbox" class="custom-control-input align-content-center " id="toggleForm">
        <label class="custom-control-label" for="toggleForm">Hide/Show the Schedule Form</label>
    </div>
    <!--<div id="results"></div>-->
</div>
<br><br>
<div class="container">
    <a href="http://java-chip.greenriverdev.com/KentOutreach/home.html" class="links"><p><strong>Go Back to Home Page</strong></p></a>
</div>
<br><br>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
<!--<script src="scripts/form.js"></script>-->
<script src="//cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="scripts/requests.js"></script>


</body>
</html>



