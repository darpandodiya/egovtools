<?php 
        //Code for successful registration
            if(isset($_GET['aid'])) {
                $getaid = "?aid=".$_GET['aid'];
            }
            else {
                $getaid = "";
            }
            $pageName = basename($_SERVER['PHP_SELF']);
?>

<a href="#menu" id="menuLink" class="menu-link">
        <!-- Hamburger icon -->
        <span></span>
    </a>

    <div id="menu">
        <div class="pure-menu">
            <a class="pure-menu-heading" href="result.php">EGov Tools</a>

            <ul class="pure-menu-list">
                <li class="pure-menu-item"><a href="result.php<?php echo $getaid; ?>" class="pure-menu-link <?php if($pageName == 'result.php') echo 'pure-menu-selected'; ?>">One Tap Score</a></li>
                <li class="pure-menu-item"><a href="graph.php<?php echo $getaid; ?>" class="pure-menu-link <?php if($pageName == 'graph.php') echo 'pure-menu-selected'; ?>">My Graph</a></li>
                <li class="pure-menu-item"><a href="notify.php<?php echo $getaid; ?>" class="pure-menu-link <?php if($pageName == 'notify.php') echo 'pure-menu-selected'; ?>">Notify Me</a></li>
                <li class="pure-menu-item"><a href="accessid.php" class="pure-menu-link <?php if($pageName == 'accessid.php') echo 'pure-menu-selected'; ?>">Access ID</a></li>
                <li class="pure-menu-item menu-item-divided"><br><a href="about.php" class="pure-menu-link <?php if($pageName == 'about.php') echo 'pure-menu-selected'; ?>">About & FAQs</a></li>
                <li class="pure-menu-item"><a href="spi-info.php" class="pure-menu-link <?php if($pageName == 'spi-info.php') echo 'pure-menu-selected'; ?>">SPI Info</a></li>
                <li class="pure-menu-item"><a href="ddu-web.php" class="pure-menu-link <?php if($pageName == 'ddu-web.php') echo 'pure-menu-selected'; ?>">DDU On Web</a></li>
                <li class="pure-menu-item "><a href="" class="pure-menu-link">Source Code</a></li>
                <li class="pure-menu-item"><a href="http://www.darpandodiya.com/link-up/" target="_blank" title="Contact Me" class="pure-menu-link">Contact</a></li>
            </ul>
        </div>
    </div>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-48559809-2', 'auto');
  ga('send', 'pageview');

</script>