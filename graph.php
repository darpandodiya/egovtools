<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="View and Compare your DDU result via interactive graphs. This feature of EGov DDIT tools offers semester wise comparison as well as an overall comparison via a line graph.">
    <meta name="keywords" content="egov, ddu, ddit, nadiad, result, ddu result, ddit result, darpan dodiya dashboard, darpan dodiya egov">
    <meta name="author" content="Darpan Dodiya">

    <title>My Graph > EGov Tools > Quick EGov DDIT Result > Enhanced egov.ddit.ac.in Experience</title>  


<link rel="stylesheet" href="css/pure-min.css"> 
<link rel="stylesheet" href="css/customstyle.css">
<link rel="icon" href="css/fevicon.png">
    <!--[if lte IE 8]>
        <link rel="stylesheet" href="css/layouts/side-menu-old-ie.css">
    <![endif]-->
    <!--[if gt IE 8]><!-->
        <link rel="stylesheet" href="css/layouts/side-menu.css">
    <!--<![endif]-->
<script src="js/Chart.min.js"></script>
</head>
<body>

<div id="layout">
    <!-- Menu toggle -->
    <?php require_once('header.php'); ?>

    <?php 
            if(isset($_GET['aid'])) {
                $getaid = $_GET['aid'];
                if(isset($_GET['semester'])) {
                    $semester = $_GET['semester'];
                }
                else {
                    $semester = "overall";
                }
            }
            else {
                $semester = "";
                $getaid = "";
            }   
        ?>

    <div id="main">
        <div class="header">
            <h2><a href="<?php echo basename($_SERVER['PHP_SELF']); ?>">My Graph</a></h2>
            <form class="pure-form" action="" method="GET">
                <div class="">
                <label for="aid">Access ID:</label>
                <input type="text" class="pure-input-1-5 align-center-custom" placeholder="Your Access ID" name="aid" id="aid" value="<?php echo $getaid; ?>">
                    <select id="semester" name="semester" required title='Select the semester' class="align-center-custom">
                        <option value="" selected disabled>Semester</option>
                        <option value="overall" <?php if($semester == "overall") echo "selected"; ?> ><b>Overall</b></option>
                        <?php 

                            for($semesterloop=1; $semesterloop <= 8; $semesterloop++){
                                $selected = "";

                                if($semester == $semesterloop) {
                                    $selected = "selected";
                                }

                                echo "<option value='$semesterloop' $selected>$semesterloop</option>";
                            }
                        ?>
                    </select>
                    <p></p>
                <button type="submit" class="pure-button pure-button-primary"><b>Go!</b></button>
                <br>
                <a href='accessid.php' class="access-id align-center-custom">Access ID</a>
                </div>
            </form>
            <br>
        </div>
        <br><br>

        <?php
            if($semester == "overall") {
                
                echo '<div class="content align-center-custom">
                        <canvas id="canvas2" height="400" width="600" class="align-center-custom"></canvas>
                      </div>';
            } 
        
           elseif($getaid != "") {

                echo '<div class="content align-center-custom">
                        <canvas id="canvas1" height="600" width="800" class="align-center-custom"></canvas>
                      </div>'; 
           } 
        ?>
        
                
    <?php require_once('footer.php'); ?>    
    </div>
</div>  

                <?php
                    if($getaid != "") {

                        if($semester != "overall") {
                            $examtype = "int";
                            require_once('crawler.php');

                            $html = getContentFromAID($getaid, $examtype, $semester);

                            $ret = $html->find('div[id=content]');
            
                            if (strpos($ret[0],'Error') !== false) {
                                echo "<p class='error-text'>There's an error. Please check your input.</p>";
                                exit();
                            }
                            
                            
                            $table = $html->find('table.items');
                            //echo $table[0];
                            
                            $theData = array();

                            // loop over rows
                            foreach($table[0]->find('tr') as $row) {

                                // initialize array to store the cell data from each row
                                $rowData = array();
                                foreach($row->find('td') as $cell) {

                                    // push the cell's text to the array
                                    $rowData[] = $cell->innertext;

                                }
                                //print_r($rowData);

                                // push the row's data array to the 'big' array
                                $theData[] = $rowData;
                            }
                        //print_r($theData);                    
                    
                ?>
                

<script>
    var randomScalingFactor = function(){ return Math.round(Math.random()*100)%36};

    var barChartData = {
        labels : [<?php 
                        $arrlength1 = count($theData);
                        $subjectindex = 1;
                        $session1index = 3;
                        $session2index = 9;
                        $session3index = 15;    

                        for($i=1; $i<$arrlength1; $i++) {
                            echo '"'.$theData[$i][$subjectindex];
                            if($i != $arrlength1-1) {
                                echo '",';
                            }
                            else {
                                echo('"');
                            }
                        }
                    ?>],
        datasets : [
            {
                fillColor : "rgba(70,191,189,0.8)",
                strokeColor : "rgba(70,191,189,0.90)",
                highlightFill: "rgba(70,191,189,1)",
                highlightStroke: "rgba(24,255,255,1)",
                data : [<?php 
                        for($i=1; $i<$arrlength1; $i++) {
                            if(is_numeric($theData[$i][$session1index])) {
                                echo $theData[$i][$session1index];
                            }
                            else {
                                echo 0;
                            }
                            if($i != $arrlength1-1) {
                                echo ",";
                            }
                        }
                    ?>]
            },
            {
                fillColor : "rgba(68,68,68,0.8)",
                strokeColor : "rgba(68,68,68,0.9)",
                highlightFill: "rgba(68,68,68,1)",
                highlightStroke: "rgba(24,255,255,1)",
                data : [<?php 
                        for($i=1; $i<$arrlength1; $i++) {
                            if(is_numeric($theData[$i][$session2index])) {
                                echo $theData[$i][$session2index];
                            }
                            else {
                                echo 0;
                            }
                            if($i != $arrlength1-1) {
                                echo ",";
                            }
                        }
                    ?>]   
            },
            {
                fillColor : "rgba(0,200,83,0.8)",
                strokeColor : "rgba(0,200,83,0.9)",
                highlightFill : "rgba(0,200,83,1)",
                highlightStroke : "rgba(24,255,255,1)",
                data : [<?php 
                        for($i=1; $i<$arrlength1; $i++) {
                            if(is_numeric($theData[$i][$session3index])) {
                                echo $theData[$i][$session3index];
                            }
                            else {
                                echo 0;
                            }
                            if($i != $arrlength1-1) {
                                echo ",";
                            }
                        }
                    ?>]
            }
        ]

    }
    window.onload = function(){
        var ctx = document.getElementById("canvas1").getContext("2d");
        window.myBar = new Chart(ctx).Bar(barChartData, {
            responsive : false,
            //Number - Pixel width of the bar stroke
            barStrokeWidth : 2,

            //Number - Spacing between each of the X value sets
            barValueSpacing : 15,

            //Number - Spacing between data sets within X values
            barDatasetSpacing : 1,
        });
    }
</script>

    <?php
        }   //End of "if" of semester != "overall"

        if($semester == "overall") {

            require_once('getdbcon.php');
            $connection = getConnection();

            $aidquery = "SELECT * FROM accessid WHERE aid ='$getaid'";
            $aidresult = mysqli_query($connection, $aidquery);

            if (mysqli_num_rows($aidresult) > 0) {
        
                $row = mysqli_fetch_assoc($aidresult);

                $egovid = $row['egovid'];
                $birthdate = $row['birthdate'];
                $currentsem = $row['currentsem'];
                $examtype = "ext";
                $batchyear = $row['batchyear'];

            }
            else {
                echo "<p class='error-text'>Invalid Access ID. Please try again.</p>";
                exit(0);
            }

            $spi = array();
            require_once('crawler.php');

              
            $spi = getContentForGraph($getaid, $egovid, $birthdate, $examtype, $currentsem, $batchyear);
                
            

        ?>

        <script>
            var SPIData = {
                labels : [<?php 
                            for($i=1; $i<= sizeof($spi); $i++) { 
                                echo '"Sem '.$i;
                                
                                if($i != sizeof($spi)) {
                                    echo '",';            
                                }
                                else {
                                    echo '"';
                                }
                            }
                        ?>],    

                datasets : [
                    {
                        fillColor : "rgba(70,191,189,0.8)",
                        strokeColor : "#444444",
                        pointColor : "#00C853",
                        pointStrokeColor : "#000",
                        data : [<?php
                                    for($i=0; $i< sizeof($spi); $i++) { 
                                        
                                        echo $spi[$i];
                                        
                                        if($i != sizeof($spi)-1) {
                                            echo ',';            
                                        }
                                    }
                                ?>]
                    }
                ]
            }

            window.onload = function(){
                var ctx = document.getElementById("canvas2").getContext("2d");
                window.myBar = new Chart(ctx).Line(SPIData, {
                    bezierCurve : false,
                    //Number - Radius of each point dot in pixels
                    pointDotRadius : 6,

                    //Number - Pixel width of point dot stroke
                    pointDotStrokeWidth : 2,
                    datasetStrokeWidth : 4,
                    responsive : false
                });
            }
        </script>

        <?php
        }
    }
    
    ?>

<script src="js/ui.js"></script>
</body>
</html>
