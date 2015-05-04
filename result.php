<?php
    $registration = "";
    session_start();
    if(isset($_SESSION['registration'])) {
        $registration = "Successful";
    } 
    session_destroy();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Time is valuable in DDIT. Don't waste it on writing your ID and Password on egov.ddit.ac.in. Get your DDIT result from EGov instantly via One Tap Score. A web application for DDU students.">
    <meta name="keywords" content="egov, ddu, ddit, nadiad, result, ddu result, ddit result, darpan dodiya dashboard, darpan dodiya egov">
    <meta name="author" content="Darpan Dodiya">

    <title>One Tap Score > EGov Tools > Quick EGov DDIT Result > Enhanced egov.ddit.ac.in Experience</title>   

<link rel="stylesheet" href="css/pure-min.css">
<link rel="stylesheet" href="css/customstyle.css">
<link rel="stylesheet" href="css/result.css"> 
<link rel="icon" href="css/fevicon.png">
    <!--[if lte IE 8]>
        <link rel="stylesheet" href="css/layouts/side-menu-old-ie.css">
    <![endif]-->
    <!--[if gt IE 8]><!-->
        <link rel="stylesheet" href="css/layouts/side-menu.css">
    <!--<![endif]-->
    <script>
    function close_window() {
      close();
  
    }
</script>
</head>
<body>

<div id="layout">
    <!-- Menu toggle -->
    <?php require_once('header.php'); ?>

    <div id="main">

        <?php 
            
            $currentsem = "";
            $examtype = "";

            if(isset($_GET['aid'])) {

                if($registration == "Successful") {

                    echo '<p class="success-text">Registration Successful! <br>Your Access ID is: <b><i><u>'.$_GET['aid'].'</u></i></b><br>Note it down now for future use. <br>-Or-<br>Take a screenshot <br>-Or-<br>Bookmark this page now.</p>';
                }

                $getaid = $_GET['aid'];

                require_once('getdbcon.php');
                $connection = getConnection();

                $aidquery = "SELECT * FROM accessid WHERE aid ='$getaid'";
                $aidresult = mysqli_query($connection, $aidquery);
                
                if (mysqli_num_rows($aidresult) > 0) {
            
                    $row = mysqli_fetch_assoc($aidresult);

                    $egovid = $row['egovid'];
                    $birthdate = $row['birthdate'];

                    if(isset( $_GET['currentsem'] )) {
                        $currentsem = $_GET['currentsem'];
                    }
                    else {
                        $currentsem = $row['currentsem'];
                    }

                    if(isset( $_GET['examtype'] )) {
                        $examtype = $_GET['examtype'];
                    }
                    else {
                        $examtype = "int";
                    }

                    $batchyear = $row['batchyear'];

                }
                else {
                    echo "<p class='error-text'>Invalid Access ID. Please try again.</p>";
                }
            }

            else {
                $getaid = "";
            }   
        ?>
        <div class="header">
            <h2><a href="<?php echo basename($_SERVER['PHP_SELF']); ?>">One Tap Score</a></h2>  
            <form class="pure-form" action="" method="GET">
                <div class="">
                    <label for="aid">Access ID:</label>
                    <input type="text" class="pure-input-1-5 align-center-custom" placeholder="Your Access ID" name="aid" id="aid" value="<?php echo $getaid; ?>">
                    <select id="currentsem" name="currentsem" title='Select the semester'>
                        <option value="" selected disabled>Semester</option>
                        <?php 
                            for($currentsemloop=1;$currentsemloop <= 8;$currentsemloop++){
                                $selected = "";

                                if($currentsem == $currentsemloop)
                                    $selected = "selected";

                                echo "<option value='$currentsemloop' $selected>$currentsemloop</option>";
                            }
                        ?>
                    </select>

                    <select id="examtype" name="examtype" title='Select the exam type'>

                        <option value="" selected disabled>Exam Type</option>
                        <?php 
                            
                            $selected = "";

                            if($examtype == "int") {
                                echo "<option value='int' selected>Internal</option>";
                                echo "<option value='ext'>External</option>";
                            }

                            elseif($examtype == "ext") {
                                echo "<option value='ext' selected>External</option>";
                                echo "<option value='int'>Internal</option>";
                            }

                            else {
                                echo "<option value='ext'>External</option>";
                                echo "<option value='int'>Internal</option>";
                            }
                            
                        ?>
                    </select>
                    <br><br>
                    <button type="submit" class="pure-button pure-button-primary"><b>Go!</b></button>
                    <br>
                    <a href='accessid.php' class="access-id">Access ID</a>
                </div> <!-- End of pure-g -->
            </form>
            <br>                
        </div>
        <br><br>
        <div id="content">
            <div class="pure-g">
                <div class="pure-u-1">
                    <?php 

                        if($getaid != "") {

                            require_once('crawler.php');

                            $callresult = getContentForOneTapScore($getaid, $egovid, $birthdate, $examtype, $currentsem, $batchyear);
                            
                            $html = str_get_html($callresult);

                            $scraped_data = $html->find('div[id=content]');
                            
                            if (strpos($scraped_data[0],'Error') !== false) {
                                echo "<p class='error-text'>There's an error. Please check your input.</p>";
                                exit();
                            }
                            echo $scraped_data[0];
                            echo '<p class="align-center-custom"><i>Bookmark this page now to get direct/faster access next time.</i></p>';

                                                
                        }
                    ?>
                </div>
            </div>
        </div>
        <?php require_once('footer.php'); ?>
    </div>
</div>

<script src="js/ui.js"></script>
</body>
</html>