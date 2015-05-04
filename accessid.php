<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Create/ Update/ Delete your EGov Access ID. Access ID is a token to use the features provided by EGov Tools, a web application for DDU, Nadiad students.">
    <meta name="keywords" content="egov, ddu, ddit, nadiad, result, ddu result, ddit result, darpan dodiya dashboard, darpan dodiya egov">
    <meta name="author" content="Darpan Dodiya">

    <title>Access ID > EGov Tools > Quick EGov DDIT Result > Enhanced egov.ddit.ac.in Experience</title>   


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
            <h2><a href="<?php echo basename($_SERVER['PHP_SELF']); ?>">Access ID</a></h2>                     
        </div>
        
        <!-- Mode Assignment -->

        <?php

            if(isset($_GET['mode'])) {
                $mode = $_GET['mode'];
            
                if($_GET['mode'] == "error") {

                    if(isset($_GET['errorid'])) {
                        echo "<p class='error-text'>An account with ID: ".$_GET['errorid']." is already present. Click <a href='accessid.php?mode=forgot'>here</a> to recover your existing ID.</p>";
                        exit;
                    }
                    echo "<p class='error-text'>There was an error with your inputs. Please <a href='accessid.php'>try again</a>.</p>";
                    exit;
                }
            }

            else {
                 $mode = "default";       
        ?>

        <!-- New Access ID Form Starts-->

        <div class="content" style="text-align:center;">
            <center><a href="accessid.php?mode=edit" class="edit-aid"><b>Edit / Delete</b> Existing ID</a> | <a href="accessid.php?mode=forgot" class="edit-aid"><b>Forgot</b> ID</a><br><br><p>Create A New Access ID | <a href="about.php#what-is-access-id" target="_blank" class="access-id"><b>What Is This?</b></a><br></p></center>
            <form class="pure-form align-center-custom" method="post" action="register.php">

                    <label for="egovid"><b>EGov ID:</b></label>
                    <input type="text" class="pure-input-1-5 align-center-custom" placeholder="e.g. 12CEUOS908" pattern="[0-9][0-9][A-Za-z][A-Za-z][A-Za-z][A-Za-z][A-Za-z][0-9][0-9][0-9]" name="egovid" required autofocus title='Enter your EGov student ID.'>
                    <p></p>
                    <label for="birthdate"><b>Birthdate:</b></label>
                    
                    <select id="date" name="date" required title='Enter your EGov birthdate as your password.'>
                        <option value="" selected disabled>Day</option>
                        <?php 
                            for($day=1;$day <= 31;$day++){
                                echo "<option value='".$day."'>".$day."</option>";
                            }
                        ?>
                    </select>

                    <select id="month" name="month" required title='Enter your EGov birthdate as your password.'>
                        <option value="" selected disabled>Month</option>
                        <?php 
                            for($month=1;$month <= 12;$month++){
                                echo "<option value='".$month."'>".$month."</option>";
                            }
                        ?>
                    </select>

                     <select id="year" name="year" required title='Enter your EGov birthdate as your password.'>
                        <option value="" selected disabled>Year</option>
                        <?php 
                            for($year=1990;$year <= 2000;$year++){
                                echo "<option value='".$year."'>".$year."</option>";
                            }
                        ?>
                    </select>
                    <br><br>
                    <label for="currentseminput"><b>Current Semester:</b></label>
                    <select id="currentsem" name="currentsem" required title='Select the semester which is of your interest.'>
                        <option value="" selected disabled>Semester</option>
                        <?php 
                            for($sem=1;$sem <= 8;$sem++){
                                echo "<option value='".$sem."'>".$sem."</option>";
                            }
                        ?>
                    </select>

                    <br><br>

                    <label for="batchyearinput"><b>Batch Year:</b></label>
                    <select id="batchyear" name="batchyear" required title='Select the year in which you started your graduation program in DDIT.'>
                        <option value="" selected disabled>Batch</option>
                        <?php 
                            for($batchyear=2011;$batchyear <= 2015;$batchyear++){
                                echo "<option value='".$batchyear."'>".$batchyear."</option>";
                            }
                        ?>
                    </select>

                    <br><br>
                <button type="submit" class="pure-button pure-button-primary" name="newaid" value="newaid"><b>Get ID</b></button>
            </form>
        </div>    
        <!-- New Access ID Form Ends-->

        <?php
            }

            if(isset($_GET['aid'])) {
                $getaid = $_GET['aid'];
                $urlaid = "aid=".$getaid;
                //echo $urlaid;
            }
            else {
                $getaid = "";
                $urlaid = "";
            }

            //Delete AID starts
            if($mode == "delete") {
                require('getdbcon.php');
                $connection = getConnection();

                if(isset($_POST['aid'])) {
                    $getaid = $_POST['aid'];
                }

                $deleteaidquery = "DELETE FROM accessid WHERE aid ='".$getaid."'";


                $deleteaidresult = mysqli_query($connection, $deleteaidquery);

                if (mysql_affected_rows() != -1) {
                    echo "<p class='success-text'>Your account has been successfully deleted.</p>";
                }
                else {
                    echo "<p class='error-text'>There was some error. Please <a href='accessid.php'>try again.</a></p>";
                }
            }
            //Delete AID ends

            if($mode == "forgot") {

                if(isset($_POST['recover'])) {
                    require('getdbcon.php');
                    $connection = getConnection();

                    $recover_birthdate = $_POST['date']."/".$_POST['month']."/".$_POST['year'];
                    $recover_egovid = $_POST['egovid'];

                    $recover_query = "SELECT aid FROM accessid WHERE birthdate='$recover_birthdate' AND egovid='$recover_egovid'";

                    $recover_aid_result = mysqli_query($connection, $recover_query);

                    if (mysqli_num_rows($recover_aid_result) > 0) {
                        $row_recover = mysqli_fetch_assoc($recover_aid_result);

                        $recovered_id =  $row_recover['aid'];
                        echo "<p class='success-text'>Your Access ID is: <i>$recovered_id .</i><br>Note it safely for future use. Or just take a screenshot. Have fun!</p>";  
                    }
                    else {
                        echo "<p class='error-text'>No matching records found. Please try again.</p>";
                    }


                } 
        ?>

                <div class="content" style="text-align:center;">
                <p> Recover your existing Access ID. </p>
                <form class="pure-form align-center-custom" method="post" action="accessid.php?mode=forgot">

                    <div class="align-center-custom">
                            <label for="egovid">EGov ID: </label>
                            <input type="text" class="pure-input align-center-custom" placeholder="e.g. 13CEPQR012" pattern="[0-9][0-9][A-Za-z][A-Za-z][A-Za-z][A-Za-z][A-Za-z][0-9][0-9][0-9]" name="egovid" required autofocus title='Enter your EGov student ID.'>
                    </div>
                    <br>

                    <label for="birthdate">Birthdate:</label>
                    
                    <select id="date" name="date" required title='Enter your EGov birthdate as your password.'>
                        <option value="" selected disabled>Day</option>
                        <?php 
                            for($day=1;$day <= 31;$day++){
                                echo "<option value='".$day."'>".$day."</option>";
                            }
                        ?>
                    </select>

                    <select id="month" name="month" required title='Enter your EGov birthdate as your password.'>
                        <option value="" selected disabled>Month</option>
                        <?php 
                            for($month=1;$month <= 12;$month++){
                                echo "<option value='".$month."'>".$month."</option>";
                            }
                        ?>
                    </select>

                    <select id="year" name="year" required title='Enter your EGov birthdate as your password.'>
                        <option value="" selected disabled>Year</option>
                        <?php 
                            for($year=1990;$year <= 2000;$year++){
                                echo "<option value='".$year."'>".$year."</option>";
                            }
                        ?>
                    </select>
                    <br><br>
                    <button type="submit" class="pure-button pure-button-primary button" name="recover" value="true"><b>Recover</b></button>
            </form>
        </div>

        <?php
            }

            if($mode == "edit" || $mode == "editdata") {
        ?>
        <!-- Edit Access ID Form Starts-->
        <div class="content" style="text-align:center;">
        <p> Edit your existing Access ID. </p>
        <form class="pure-form align-center-custom" action="accessid.php?<?php echo $urlaid; ?>" method="GET">
                <input type="text" class="pure-input align-center-custom" placeholder="Your Access ID" name="aid" id="aid" value="<?php echo $getaid; ?>" required pattern="[0-9A-Z][0-9A-Z][0-9A-Z]">
                <p></p>
                <button type="submit" class="pure-button pure-button-primary" name="mode" value="editdata">Edit</button>
        </form>
        </div>    
        <!-- Edit Access ID Form Ends-->          

        <!-- Edit Data Starts -->
        <?php
            }
            if(($mode == "editdata")) {
                require('getdbcon.php');
                $connection = getConnection();

                $aid = $_GET['aid'];

                if(isset($_GET['data']) && ($_GET['data'] == 'update')) {

                    $update_birthdate = $_POST['date']."/".$_POST['month']."/".$_POST['year'];
                    $update_batchyear = $_POST['batchyear'];
                    $update_currentsem = $_POST['currentsem'];
                    $update_egovid = strtoupper($_POST['egovid']);
                    $update_emailpref = $_POST['emailpref'];
                    $update_email = $_POST['email'];

                    $update_aid_query = "UPDATE accessid SET egovid='$update_egovid', birthdate='$update_birthdate', currentsem='$update_currentsem', batchyear='$update_batchyear', email='$update_email', emailpref='$update_emailpref' WHERE aid='$aid'";

                    $update_aid_result = mysqli_query($connection, $update_aid_query);

                    if (mysql_affected_rows() != -1) {
                        echo "<p class='success-text'>Your details have been successfully updated.</p>";
                    }
                    else {
                        echo "<p class='error-text'>There was some error. Please <a href='accessid.php?aid=".$aid."mode=edit'>try again.</a></p>";
                    }

                }

                $aidquery = "SELECT * FROM accessid WHERE aid ='".$aid."'";

                $aidresult = mysqli_query($connection, $aidquery);

                if (mysqli_num_rows($aidresult) == 0) {
                    echo "<p class='error-text'> Invalid Access ID. Click <b><a href='accessid.php?mode=edit'>here</a></b> to try again or click <b><a href='accessid.php'>here</a></b> to create a new Access ID. </p>";
                    exit(0);
                }

                $row = mysqli_fetch_assoc($aidresult);
                $egovid = strtoupper($row['egovid']);
                $tempbirthdate = $row['birthdate'];
                $currentsem = $row['currentsem'];
                $batchyeardb = $row['batchyear'];
                $emailpref = $row['emailpref'];
                $email = $row['email'];
                
                $birthdate_explode = explode('/', $tempbirthdate);
                
        ?>
        <!-- Edit Form Starts -->
        <form class="pure-form align-center-custom" method="post" action="accessid.php?aid=<?php echo $aid;?>&mode=editdata&data=update">

            <div class="align-center-custom">
                    <label for="birthdate"><b>EGov ID:</b></label>
                    <input type="text" class="pure-input align-center-custom" placeholder="EGov ID" pattern="[0-9][0-9][A-Za-z][A-Za-z][A-Za-z][A-Za-z][A-Za-z][0-9][0-9][0-9]" name="egovid" required autofocus title='Enter your EGov student ID.' value="<?php echo $egovid; ?>">
            
            <br><br>

            <label for="birthdate"><b>Birthdate:</b></label>
            
            <select id="date" name="date" required title='Enter your EGov birthdate as your password.'>
                <option value="" selected disabled>Day</option>
                <?php 
                    for($day=1;$day <= 31;$day++){
                        $selected = "";
                        if($day == $birthdate_explode[0]) {
                            $selected = "selected";
                        }
                        echo "<option value='".$day."' ".$selected.">".$day."</option>";
                    }
                ?>
            </select>

            <select id="month" name="month" required title='Enter your EGov birthdate as your password.'>
                <option value="" selected disabled>Month</option>
                <?php 
                    for($month=1;$month <= 12;$month++){
                        $selected = "";
                        if($month == $birthdate_explode[1]) {
                            $selected = "selected";
                        }
                        echo "<option value='".$month."' ".$selected.">".$month."</option>";
                    }
                ?>
            </select>

             <select id="year" name="year" required title='Enter your EGov birthdate as your password.'>
                <option value="" selected disabled>Year</option>
                <?php 
                    for($year=1990;$year <= 2000;$year++){
                        $selected = "";
                        if($year == $birthdate_explode[2]) {
                            $selected = "selected";
                        }
                        echo "<option value='".$year."' ".$selected.">".$year."</option>";
                    }
                ?>
            </select>
            <br><br>
            <label for="currentseminput"><b>Current Semester:</b></label>
            <select id="currentsem" name="currentsem" required title='Select the semester which is of your interest.'>
                <option value="" selected disabled>Sem</option>
                <?php 
                    for($sem=1;$sem <= 8;$sem++){
                        $selected = "";
                        if($sem == $currentsem) {
                            $selected = "selected";
                        }
                        echo "<option value='".$sem."' ".$selected.">".$sem."</option>";
                    }
                ?>
            </select>

            <br><br>

            <label for="batchyearinput"><b>Batch Year:</b></label>
            <select id="batchyear" name="batchyear" required title='Select the year in which you started your graduation program in DDIT.'>
                <option value="" selected disabled>Batch</option>
                <?php 
                    for($batchyear=2011;$batchyear <= 2015;$batchyear++){
                        $selected = "";
                        if($batchyear == $batchyeardb) {
                            $selected = "selected";
                        }
                        echo "<option value='".$batchyear."' ".$selected.">".$batchyear."</option>";
                    }
                ?>
            </select>

            <br><br>

            <label for="emailedit"><b>Email ID:</b></label>
            <input type="email" class="pure-input align-center-custom" name="email" id="email" value="<?php echo $email; ?>">

            <br><br>

            <label for="emailpref"><b>Email Notifications:</b></label>
            <select id="emailpref" name="emailpref" title='Email notifications.'>
                <?php if($emailpref == 1) { 
                            echo '<option value="1" selected>Yes</option><option value="0">No</option>';
                       } 
                      else {
                            echo '<option value="0" selected>No</option><option value="1">Yes</option>'; 
                      }
                ?>
            </select>
            <br><p></p>
            <button type="submit" class="pure-button pure-button-primary" name="data" value="update"><b>Edit ID</b></button>
        </div>
        </form>
        <!-- Edit Form Ends -->

        <form action="accessid.php?mode=delete" method="post">
            <br><br>
            <center><button type="submit" class="pure-button pure-button-delete" name="aid" value="<?php echo $aid ?>">Delete ID</button></center>
        </form>

        <!-- Edit Data Ends -->
        <?php

        }

        ?>

    <?php require_once('footer.php'); ?>
    </div>
</div>

<script src="js/ui.js"></script>
</body>
</html>
