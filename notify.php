<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Get timely email notifications of your DDIT results. EGov Tools provides a smooth solution to check your DDU results. Register here and never miss an update.">
    <meta name="keywords" content="egov, ddu, ddit, nadiad, result, ddu result, ddit result, darpan dodiya dashboard, darpan dodiya egov">
    <meta name="author" content="Darpan Dodiya">   

    <title>Notify Me > EGov Tools > Quick EGov DDIT Result > Enhanced egov.ddit.ac.in Experience</title>  


<link rel="stylesheet" href="css/pure-min.css">
<link rel="stylesheet" href="css/customstyle.css"> 
<link rel="icon" href="css/fevicon.png">
    <!--[if lte IE 8]>
        <link rel="stylesheet" href="css/layouts/side-menu-old-ie.css">
    <![endif]-->
    <!--[if gt IE 8]><!-->
        <link rel="stylesheet" href="css/layouts/side-menu.css">
    <!--<![endif]-->
</head>
<body>

<div id="layout">
    <!-- Menu toggle -->
    <?php require_once('header.php'); ?>

    <div id="main">
        <div class="header">
            <h2><a href="<?php echo basename($_SERVER['PHP_SELF']); ?>">Notify Me</a></h2>
        </div>
        <div class="content">
            <?php
                require('getdbcon.php');
                $connection = getConnection();

                if(isset($_POST['submit'])) {
                    $aid = $_POST['aid'];
                    $email = $_POST['email'];

                    $aidquery = "SELECT * FROM accessid WHERE aid ='".$aid."'";
                            //echo $aidquery;

                    $aidresult = mysqli_query($connection, $aidquery);

                    if (mysqli_num_rows($aidresult) == 0) {
                        echo "<p class='error-text'>Invalid Access ID. Please try again. </p>";
                    }

                    else {
                        $notifyquery = "UPDATE accessid SET email='".$email."', emailpref=1 WHERE aid='".$aid."'";
                        //echo $notifyquery;

                        $notifyresult = mysqli_query($connection, $notifyquery);
                        
                        if($notifyresult == 1) {
                            echo "<p class='success-text'>Registration Successful! <br>Now you can sit back and relax. You'll get notifications whenever there's a new update.<br><br>Remember to edit your current semester in your <a href='accessid.php?mode=edit'>Access ID </a>after each semester.</p>";
                        }
                    }                     
                }    
            ?>
            <p class="align-center-custom">Register here to get notifications of your result and attendance directly in your inbox via email. <br>Enter your details once, you'd never ever have to open the EGov site again.</p>
            <br>     
            <form class="pure-form align-center-custom" action="" method="POST">
                <input type="text" class="pure-input-1-5 align-center-custom" placeholder="Enter Your Acess ID" name="aid" id="aid" required pattern="[0-9A-Z][0-9A-Z][0-9A-Z]"><p></p>
                <input type="email" class="pure-input-1-5 align-center-custom" placeholder="Your Email" name="email" id="email" required>
                    <!--<input type="number" class="pure-input-1" placeholder="Your Phone" pattern="[0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9]" name="phone" id="phone">-->
                <p></p>
                <button type="submit" class="pure-button pure-button-primary" name="submit" value="Register"><b>Register</b></button>
                <br>
                <a href='accessid.php' class="access-id">Access ID </a>
            </form>                       
            <br> 
        </div>
        <?php require_once('footer.php'); ?>       
    </div>
</div>

<script src="js/ui.js"></script>
</body>
</html>
