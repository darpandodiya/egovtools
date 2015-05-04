<?php

	$examtype = "int";

	require_once('getdbcon.php');
    $connection = getConnection();

    $aidquery = "SELECT * FROM accessid WHERE emailpref=1";
          
    $aidresult = mysqli_query($connection, $aidquery);

    if (mysqli_num_rows($aidresult) > 0) {    
    		
    		while( $row = mysqli_fetch_array($aidresult)) {
    			$aid = $row['aid'];
    			require_once('crawler.php');
    			$callresult = getContentFromAID($aid, $examtype);
                        
                $ret = $callresult->find('div[id=content]');

                if(md5($ret[0]) == $row['currentresult']) {
                	echo "No new updates.";
                }
                else {
                	$updatequery = "UPDATE accessid SET currentresult='".md5($ret[0])."' WHERE aid='".$aid."'";
                    //echo $updatequery;

                    $updateresult = mysqli_query($connection, $updatequery);
                    
                    //if($updateresult == 1) {
                    //   echo "<p><b>Update has been updated.</b></p>";
                    //}
                    //echo "Sending mail".$row['email'].$ret[0];
                    mail($row['email'],'EGov Update', $ret[0]);
                }
    		}
    }

		

?>
