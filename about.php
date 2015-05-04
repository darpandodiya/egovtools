<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="About EGov Tools and Frequently Asked Questions about this DDIT Result Portal. All information related to this result portal.">

    <title>About & FAQs > EGov Tools > DDU > DDIT</title>   


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
            <h2><a href="<?php echo basename($_SERVER['PHP_SELF']); ?>">About & FAQs</a></h2>
        </div>
        <div class="content">
            <p>
                <span class='question'>&rarr; What is EGov Tools?</span><br>
                <span class='answer'>
                EGov Tools was my SDP - Software Development Project during the 6th semester. The originally assigned project was, Result Notification System, in which the system should send an email whenever there's a new update in the result of the users. However, after implementing the notification functionality, I felt that the system should've more useful features.<br><br>
                Thus, I worked on more modules and came up with some, such as One Tap Score, My Graph and Access ID.<br><br>
                The whole web application works on HTTP GET requests, so you can (and should) bookmark any page for a faster access.<br>
                </span>
                <hr>
                <span class='question' id='what-is-access-id'>&rarr; What is Access ID?</span><br>
                <span class='answer'>
                It is a simple 3 character token to access the functionalities on this web application. To use any of the features, you just need to enter the 3 characters, that's all!<br>                      
                </span>
                <hr>
                <span class='question'>&rarr; Is it a hack or what? How it works?</span><br>
                <span class='answer'>
                Nope. It ain't. <br><br>
                Basically, the application works as a proxy browser for you (Using PHP cURL library). <br>
                When you enter your ID > The code goes to egov.ddit.ac.in > Enters the login details on the login page > Goes to your academic history > Opens your result > Extracts the data > And come back here with the extracted data and display it.  
                </span>
                <hr>
                <span class='question'>&rarr; Put all the technical talks aside. Why am I so keen about results?</span><br>
                <span class='answer'>
                It's not about the mere results. It's all about learning experience for me.<br>
                Throughout the development, I learnt <br>
                &bull; Web crawling techniques<br>
                &bull; Dealing with graphs and charts<br>
                &bull; SMTP and outbounding mass mails<br>
                &bull; Cron jobs<br>
                &bull; And some more stuff...
                </span>
                <hr>
                <span class='question' id="why-the-ads">&rarr; Why the ads?</span><br>
                <span class='answer'>
                This application heavily uses server resources for crawling, sending mails and graph generation. A free web host wouldn't allow that. So, the application is hosted on a <i>paid</i> hosting service. <br><br>
                Displaying the advertisements would help me to earn few bucks,  if you click on the ads, then some more.
                </span>
                <hr>
                <span class='question' id='code'>&rarr; Interested in implementation details? Code?</span><br>
                <span class='answer'>
                The application's open source. The source code is available on my GitHub. <br><br>

                You are free to  use - modify - redistribute it. No copyrights claim whatsoever. <a href='https://github.com/darpandodiya/egovtools' target='_blank'>Get It!</a>   
                </span>
                <hr>
                <span class='question' id="about">&rarr; Who am I?</span><br>
                <span class='answer'>
                I'm Darpan. 3rd year, Computer Engineering, DDIT. Just a normal human being, like, you. Nothing extra-ordinary. :) <br><br><a href='http://www.darpandodiya.com/about' title='Darpan Dodiya' target='_blank'><b>Know More</b></a> Or <a href='http://www.darpandodiya.com/link-up' title='Contact Darpan' target='_blank'><b>Say Hello</b></a> 
                </span>

            </p>
            
            
        </div>
        <?php require_once('footer.php'); ?>       
    </div>
</div>

<script src="js/ui.js"></script>
</body>
</html>
