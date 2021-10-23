<?php
/*
 * customize.php
 * able to customize about us section and the testimonials/text
 * in the Kent Outreach home page
 */

// Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();

if (!isset($_SESSION['loggedin'])) {
    header("location: adminLogin.html");
}

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
<!-- Nav Bar-->
<nav class="navbar navbar-expand-sm txt-white">
    <div class="container">
        <a href="requests.php" class="navbar-brand" id="logo"><strong>Kent Outreach</strong></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse ml-auto" id="navbarNavDropdown">
            <ul class="navbar-nav ml-auto txt-white">
                <!--Logged in text-->
                <span class="navbar-text pt-3 px-3">Logged in as Peter</span>
                <!--DropDown Menu-->
                <li class="nav-item dropdown">
                    <a class="nav-link" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Menu <img src="images/hamMenu.jpg" alt="Menu" id="menu">
                    </a>
                    <div class="dropdown-menu dropdown-menu-right px-3" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="http://java-chip.greenriverdev.com/KentOutreach/requests.php">Requests</a>
                        <a class="dropdown-item" href="http://java-chip.greenriverdev.com/KentOutreach/customize.php">Customize Home Page</a>
                        <a class="dropdown-item" href="logout.php">Log Out</a>
                    </div>
                </li>
            </ul>
        </div>
    </div>

</nav>
<div class="container">
    <br>
    <h2>Customize Carousal Texts</h2>
    <!--Slide 1-->
    <div class="row bg-light">
        <div class="col-9">
            <h4>Slide 1</h4>
            <div class="container">
                <!-- Slide 1 Header-->
                <h5><label for="slideHeader1">Header</label></h5>
                <h6 id="header1"><?php
                    $sql = "SELECT state FROM `form` WHERE id=3";
                    $result = mysqli_query($cnxn, $sql);
                    echo mysqli_fetch_assoc($result)['state'];
                    ?></h6>
                <!-- Header Input 1 -->
                <textarea id="slideHeader1" class="d-none w-100" name="description" rows="10"><?php
                    $sql = "SELECT state FROM `form` WHERE id=3";
                    $result = mysqli_query($cnxn, $sql);
                    echo mysqli_fetch_assoc($result)['state'];
                    ?></textarea>
                <!-- Slide 1 Sub-->
                <h5><label for="slideSub1">SubHeader</label></h5>
                <h6 id="sub1"><?php
                    $sql = "SELECT state FROM `form` WHERE id=4";
                    $result = mysqli_query($cnxn, $sql);
                    echo mysqli_fetch_assoc($result)['state'];
                    ?></h6>
                <!--Sub Input 1-->
                <textarea id="slideSub1" class="d-none w-100" name="description" rows="10"><?php
                    $sql = "SELECT state FROM `form` WHERE id=4";
                    $result = mysqli_query($cnxn, $sql);
                    echo mysqli_fetch_assoc($result)['state'];
                    ?></textarea>
            </div>
        </div>
        <!-- Buttons: Edit, Save, Cancel for Slide 1-->
        <div class="col-3 p-5 text-center">
            <button class="btn btn-dark" id="editSlide1">Edit</button>
            <button class="btn btn-dark d-none" id="saveSlide1">Save</button>
            <br><br>
            <button class="btn btn-dark d-none" id="cancelSlide1">Cancel</button>
        </div>
    </div>
    <div class="row">

        <div class="col-9">
            <!--Slide 2-->
            <h4>Slide 2</h4>
            <div class="container">
                <!-- Slide 2 Header-->
                <h5><label for="slideHeader2">Header</label></h5>
                <h6 id="header2"><?php
                    $sql = "SELECT state FROM `form` WHERE id=5";
                    $result = mysqli_query($cnxn, $sql);
                    echo mysqli_fetch_assoc($result)['state'];
                    ?></h6>
                <!-- Header Input 2 -->
                <textarea id="slideHeader2" class="d-none w-100" name="description" rows="10"><?php
                    $sql = "SELECT state FROM `form` WHERE id=5";
                    $result = mysqli_query($cnxn, $sql);
                    echo mysqli_fetch_assoc($result)['state'];
                    ?></textarea>
                <!-- Slide 2 Sub-->
                <h5><label for="slideSub2">SubHeader</label></h5>
                <h6 id="sub2"><?php
                    $sql = "SELECT state FROM `form` WHERE id=6";
                    $result = mysqli_query($cnxn, $sql);
                    echo mysqli_fetch_assoc($result)['state'];
                    ?></h6>
                <!--Sub Input 2-->
                <textarea id="slideSub2" class="d-none w-100" name="description" rows="10"><?php
                    $sql = "SELECT state FROM `form` WHERE id=6";
                    $result = mysqli_query($cnxn, $sql);
                    echo mysqli_fetch_assoc($result)['state'];
                    ?></textarea>
            </div>

        </div>
        <!-- Buttons: Edit, Save, Cancel for Slide 2-->
        <div class="col-3 p-5 text-center">
            <button class="btn btn-dark" id="editSlide2">Edit</button>
            <button class="btn btn-dark d-none" id="saveSlide2">Save</button>
            <br><br>
            <button class="btn btn-dark d-none" id="cancelSlide2">Cancel</button>
        </div>
    </div>

    <div class="row bg-light">
        <div class="col-9">
            <!--Slide 3-->
            <h4>Slide 3</h4>
            <div class="container">
                <!-- Slide 3 Header-->
                <h5><label for="slideHeader3">Header</label></h5>
                <h6 id="header3"><?php
                    $sql = "SELECT state FROM `form` WHERE id=7";
                    $result = mysqli_query($cnxn, $sql);
                    echo mysqli_fetch_assoc($result)['state'];
                    ?></h6>
                <!-- Header Input 3 -->
                <textarea id="slideHeader3" class="d-none w-100" name="description" rows="10"><?php
                    $sql = "SELECT state FROM `form` WHERE id=7";
                    $result = mysqli_query($cnxn, $sql);
                    echo mysqli_fetch_assoc($result)['state'];
                    ?></textarea>
                <!-- Slide 3 Sub-->
                <h5><label for="slideSub3">SubHeader</label></h5>
                <h6 id="sub3"><?php
                    $sql = "SELECT state FROM `form` WHERE id=8";
                    $result = mysqli_query($cnxn, $sql);
                    echo mysqli_fetch_assoc($result)['state'];
                    ?></h6>
                <!--Sub Input 3-->
                <textarea id="slideSub3" class="d-none w-100" name="description" rows="10"><?php
                    $sql = "SELECT state FROM `form` WHERE id=8";
                    $result = mysqli_query($cnxn, $sql);
                    echo mysqli_fetch_assoc($result)['state'];
                    ?></textarea>
            </div>
        </div>
        <!-- Buttons: Edit, Save, Cancel for Slide 3-->
        <div class="col-3 p-5 text-center">
            <button class="btn btn-dark" id="editSlide3">Edit</button>
            <button class="btn btn-dark d-none" id="saveSlide3">Save</button>
            <br><br>
            <button class="btn btn-dark d-none" id="cancelSlide3">Cancel</button>
        </div>
    </div>
</div>

<div class="container">
    <br>
    <!-- About Us -->
    <h2>Customize About Us</h2>
    <div class="row">
        <!-- Description -->
        <div class="col-9">
            <h4><label for="description">Description:</label> </h4>
            <h5>Please put < br> for line breaks </h5>
            <h6 id="bio">
                <?php
                    $sql = "SELECT state FROM `form` WHERE id=2";
                    $result = mysqli_query($cnxn, $sql);
                    echo mysqli_fetch_assoc($result)['state'];
                ?>
                <br><br>
            </h6>
            <!--Description Input-->
            <textarea id="description" class="d-none w-100" name="description" rows="10"><?php
                    $sql = "SELECT state FROM `form` WHERE id=2";
                    $result = mysqli_query($cnxn, $sql);
                    echo mysqli_fetch_assoc($result)['state'];
                    ?></textarea>
        </div>
        <!-- Buttons: Edit, Save, Cancel for About Us-->
        <div class="col-3 p-5 text-center">
            <button class="btn btn-dark" id="edit">Edit</button>
            <button class="btn btn-dark d-none" id="save">Save</button>
            <br><br>
            <button class="btn btn-dark d-none" id="cancel">Cancel</button>
        </div>
    </div>
</div>

<!-- Scripts-->
<br><br>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
<script src="//cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="scripts/customize.js"></script>

</body>
</html>

