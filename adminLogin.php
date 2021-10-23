<?php

$err = false;
$username = '';

session_start();

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = strtolower(trim($_POST['username']));
    $password = trim($_POST['password']);

    if ($username == 'peter' && $password == 'outreach') {

        $_SESSION['loggedin'] = true;

        header("location: requests.php");
    }

    if (!($username = "" || $password = "")) {

        $err = true;

    }
}

if (isset($_SESSION['loggedin'])) {
    header("location: requests.php");
}















?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="styles/home.css">

    <title>Admin Login</title>
</head>
<body style="background-color: #f0ad4e;">

<!-- Navigation bar -->
<nav class="navbar navbar-dark navbar-expand-sm" >
    <div class="container">
        <!-- logo -->
        <a href="http://java-chip.greenriverdev.com/KentOutreach/home.html" class="navbar-brand" id="logo"><strong>Kent Outreach</strong></a>


    </div><!-- container -->
</nav>

<br><br><br><br><br>

<form action="#" method="post" class="validations" id="interestForm" name="interestForm" onsubmit="">

<div class="container">
    <div class="centered" style="background: white; border: 20px solid white; background-color: white; border-radius: 30px;">

    <label for="username" >Username</label><br>
    <input type="text" name="username" class="form-control" id="username" placeholder="Enter your username" <?php echo "value='$username'"; ?> >

    <br>

    <label for="password">Password</label><br>
    <input type="password" name="password" class="form-control" id="password" placeholder="Enter your username">

    <input type="button" id="forgotPassword" name="forgotPassword[]" value="Forgot Password" class="btn btn-link"><br>

        <?php

        if ($err) {


            echo '<span class="text-danger" id = "err-login"> Invalid Login<br></span>';

        }

        ?>

    <input type="submit" value="Submit" class="btn" id="submit">

    </div>
</div>

</form>

</body>
</html>