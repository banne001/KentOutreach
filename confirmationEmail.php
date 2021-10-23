<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!--Custom CSS -->
    <link rel="stylesheet" href="styles/confirmation.css">
    <title>Kent Outreach</title>
</head>
<body>
<!-- Navigation bar -->
<nav class="navbar navbar-dark navbar-expand-sm" >
    <div class="container">
        <!-- logo -->
        <a href="http://java-chip.greenriverdev.com/KentOutreach/home.html" class="navbar-brand" id="logo"><strong>Kent Outreach</strong></a>
        <!-- Menu Bar -->
    </div><!-- container -->
</nav>
<br><br><br>

<div class="container" id="main">
    <br><br>
    <h1><strong>Thank you for your request! We'll be in touch soon!</strong></h1><br>
    <h2>Intake Form Summary</h2><br>

    <?php
    ini_set('display_errors', 1);
    error_reporting(E_ALL);

    //Connect to database
    $database = 'javachip_grc';
    $username = 'javachip_javachip';
    $password = 'WootWoot1!';
    $hostname = 'localhost';
    
    
    $cnxn = @mysqli_connect($hostname, $username, $password, $database)
    or die("There was a problem.");
    //var_dump($cnxn);

    // Data validation
    $isValid = true;

    // Check first name
    if(validName($_POST['fname'])){
        $fname = $_POST['fname'];
    }else {
        echo"<p>Invalid first name</p>";
        $isValid = false;
    }

    // Check last name
    if(validName($_POST['lname'])){
        $lname = $_POST['lname'];
    }else {
        echo"<p>Invalid last name</p>";
        $isValid = false;
    }

    // Check needs
    if(validNeeds($_POST['needs'])){
        $meet_how = $_POST['needs'];
    }else {
        echo"<p>Please select how we met</p>";
        $isValid = false;
    }

    // Check email
    if(empty($email)){
        $email = $_POST['email'];
    }elseif (!empty($email) && validEmail(preg_match("/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/", $_POST['email']))){
        $email = $_POST['email'];
    }else{
        echo "<p>Invalid email format</p>";
        $isValid = false;
    }


    //$fname = $_POST['fname'];
    //$lname = $_POST['lname'];
    $zipCode = $_POST['zipCode'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];


    $checkedBox = implode(", ", $_POST['checkedBox']);
    $otherInput = $_POST['otherInput'];
    

    $fromName = $fname." ".$lname;
    $fromEmail = 'hmonatt@mail.greenriver.edu';

    //Prevent sql injection
    $fname = mysqli_real_escape_string($cnxn, $fname);
    $lname = mysqli_real_escape_string($cnxn, $lname);
    $email = mysqli_real_escape_string($cnxn, $email);
    $phone = mysqli_real_escape_string($cnxn, $phone);
    $zipCode = mysqli_real_escape_string($cnxn, $zipCode);
    $checkedBox = mysqli_real_escape_string($cnxn, $checkedBox);
    $otherInput = mysqli_real_escape_string($cnxn, $otherInput);


    // Save request to database
    $sql = "INSERT INTO requests(firstName, lastName, zip, phone, email, need, otherDescription) VALUES ('$fname', '$lname', '$zipCode',
       '$phone', '$email', '$checkedBox', '$otherInput')";


    $success = mysqli_query($cnxn, $sql);
    if(!$success){
        echo"<p>Sorry...something went wrong.</p>";
        return;
    }

    // Print Intake Form Summary
    echo "<p><strong>Name:</strong> $fname $lname</p>";
    echo "<p><strong>Zip Code:</strong> $zipCode</p>";
    echo "<p><strong>Phone:</strong> $phone</p>";
    echo "<p><strong>Email:</strong> $email</p>";
    echo "<p><strong>Assistance With:</strong> $checkedBox</p>";
    echo "<p><strong>Other Description:</strong> $otherInput</p>";

    // Send Emails
    $to = $email;
    $subject = "Kent Outreach Request Form Submitted";
    $message = "Submitted by: $fname $lname\r\n";
    $message .= "Zip Code: $zipCode\r\n";
    $message .= "Phone: $phone\r\n";
    $message .= "Assistance with: $checkedBox\r\n";
    $message .= "Other Description: $otherInput";
    $headers = "Name: $fromName <$fromEmail>";

    $success = mail($to, $subject, $message, $headers);

    $to = $fromEmail;
    $subject = "Kent Outreach Request Form Submitted";
    $message = "Submitted by: $fname $lname\r\n";
    $message .= "Zip Code: $zipCode\r\n";
    $message .= "Phone: $phone\r\n";
    $message .= "Assistance with: $checkedBox\r\n";
    $message .= "Other Description: $otherInput\r\n";
    $message .= "Email: $email";
    $headers = "Name: $fromName <$email>";

    $success = mail($to, $subject, $message, $headers);

    // shortcut to check success
    echo $success ? "<h2>Your request has been submitted.</h2><br>" :
        "<h2>Sorry...there was a problem.</h2><br>";

    ?>

    <hr>

    <h2>If you need immediate assistance in the meantime, please check these other resources:</h2><br>

    <!-- Other Resource Links -->
    <div class="container">
        <a href="http://www.211.org" class="links" target="_blank"><h5><strong>211</strong></h5></a><br>
        <a href="http://kentmethodist.com/assistance" class="links" target="_blank"><h5><strong>Kent United Methodist Church Assistance</strong></h5></a><br><br><br>
    </div>

    <!-- Go back to Home -->
    <div class="container">
        <a href="http://java-chip.greenriverdev.com/KentOutreach/home.html" class="links"><h5><strong>Go Back to Home Page</strong></h5></a><br><br><br>
    </div>



</div>
</body>
</html>


