<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="About EGov Tools and Frequently Asked Questions about thos DDIT Result Portal.">

    <title>SPI Info > EGov Tools > DDU > DDIT</title>   


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
            <h2><a href="<?php echo basename($_SERVER['PHP_SELF']); ?>">SPI Info</a></h2>
        </div>
        <div class="content">
            <p class="align-center-custom">
                <span><b> Marks to Grade Conversion </b></span>
                <table class="pure-table align-center-custom pure-table-bordered">
                    <thead>
                        <tr>
                            <th>Grade Code</th><th>Grade Point</th><th>Out Of 100</th><th>Out of 150</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr><td>AA</td><td>10</td><td>> 84.5</td><td>> 126.75</td></tr>
                        <tr><td>AB</td><td>9</td><td>74.5</td><td>111.75</td></tr>
                        <tr><td>BB</td><td>8</td><td>64.5</td><td>96.75</td></tr>
                        <tr><td>BC</td><td>7</td><td>54.5</td><td>81.75</td></tr>
                        <tr><td>CC</td><td>6</td><td>44.5</td><td>66.75</td></tr>
                    </tbody>
                    
                </table>
                <br>
                <span style="font-size:0.9em;text-align:center;">This grading system inherently implies that wheather you get 97 marks or 111 or anything in between that, you'll get straight 8 points - BB grade.</span>

            </p>
            <hr>
            <p>
            <span class="align-center-custom "><center><b>How to Calculate SPI?</b></center></span><br>
            <span class="question">1. Find an aggregate total for each subject. (Internal + Attendance + Termwork/Viva + External)</span> <br>
            <span style="font-size:0.95em">For a subject PQR, 26 + 4 + 40 + 42 = 112</span> <br><br>
            <span class="question">2. Find out grade point from the table above.</span> <br>
            <span style="font-size:0.95em">Here, the total is 112, so grade point = 9</span> <br><br>
            <span class="question">3. Multiply the grade point with subject credit.</span> <br>
            <span style="font-size:0.95em">Every subject has a credit associated with it. Generally 4 or 5. Consider credit 5 for PQR, then 5 * 9 = 45</span><br><br>
            <span class="question">4. Repeat step 1, 2, 3 for each subject and find out the multiplication. Sum up the multiplied figures.</span><br>
            <span style="font-size:0.95em">For subject ABC: 4 * 8 = 32, PQR: 5 * 9 = 45, XYZ: 5 * 8 = 40<br> 
            Summation: ABC + PQR + XYZ = 117</span><br><br>
            <span class="question">5. Divide this summation by the sum of total subject credits. The answer is your SPI.</span><br>
            <span style="font-size:0.95em">Summation: 117. Total subject credits: 4 (ABC) + 5 (PQR) + 5 (XYZ) = 14.<br>
            SPI: 117 / 14 = 8.35</span>
            </p>
            
            
        </div>
        <?php require_once('footer.php'); ?>       
    </div>
</div>

<script src="js/ui.js"></script>
</body>
</html>
