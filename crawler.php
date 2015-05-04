<?php

	include_once 'simplehtmldom/simple_html_dom.php';

    function getContentFromAID($getaid, $examtype, $currentsemin) {

    	$cookie_file_path = "cookie.txt";	
		if(file_exists($cookie_file_path))
		    unlink($cookie_file_path);

	    require_once('getdbcon.php');
	    $connection = getConnection();

	    $aidquery = "SELECT * FROM accessid WHERE aid ='".$getaid."'";
	    $aidresult = mysqli_query($connection, $aidquery);

	    if (mysqli_num_rows($aidresult) > 0) {
    
    		$row = mysqli_fetch_assoc($aidresult);
    		$egovid = $row['egovid'];
    		$birthdate = $row['birthdate'];
    		if($currentsemin == "") {
    			$currentsem = $row['currentsem'];
    		}
    		else {
    			$currentsem = $currentsemin;
    		}
    		$batchyear = $row['batchyear'];

    	}
    	else {
    		echo "<p class='error-text'>Invalid Access ID. Go to <a href='accessid.php'>here</a> to create a new ID.</p>";
    		exit;
    	}

	    
		$ch = curl_init();
		
		curl_setopt ($ch, CURLOPT_POST, TRUE);
		curl_setopt ($ch, CURLOPT_POSTFIELDS, "LoginForm[username]=".$egovid."&LoginForm[password]=".$birthdate."");
		curl_setopt ($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt ($ch, CURLOPT_HEADER, 0);
		curl_setopt ($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);
		curl_setopt ($ch, CURLOPT_COOKIEJAR, $cookie_file_path);
		curl_setopt ($ch, CURLOPT_COOKIEFILE, $cookie_file_path);
			
		curl_setopt($ch, CURLOPT_URL,'http://egov.ddit.ac.in/index.php?r=site/login');	
		$output1 = curl_exec($ch);
		 
		curl_setopt($ch, CURLOPT_URL,'http://egov.ddit.ac.in/index.php?r=tblstudentmst/academicHistory');
		$output2 = curl_exec($ch);
		
		curl_setopt ($ch, CURLOPT_POST, TRUE);
		curl_setopt ($ch, CURLOPT_POSTFIELDS, "sessionno=".$currentsem."&batchyear=".$batchyear."");
		curl_setopt($ch, CURLOPT_URL,'http://egov.ddit.ac.in/index.php?r=tblstudentmst/'.$examtype.'Relational');
		$output3 = curl_exec($ch);

		$html = str_get_html($output3);

	
		if(file_exists($cookie_file_path))
        	unlink($cookie_file_path);


		return $html;

		exit();
	}

	function getContentForOneTapScore($aid, $egovid, $birthdate, $examtype, $currentsem, $batchyear) {

    	$cookie_file_path = "cookie.txt";	
		if(file_exists($cookie_file_path))
		    unlink($cookie_file_path);
	   
		$ch = curl_init();
		
		curl_setopt ($ch, CURLOPT_POST, TRUE);
		curl_setopt ($ch, CURLOPT_POSTFIELDS, "LoginForm[username]=".$egovid."&LoginForm[password]=".$birthdate."");
		curl_setopt ($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt ($ch, CURLOPT_HEADER, 0);
		curl_setopt ($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);
		curl_setopt ($ch, CURLOPT_COOKIEJAR, $cookie_file_path);
		curl_setopt ($ch, CURLOPT_COOKIEFILE, $cookie_file_path);
			
		curl_setopt($ch, CURLOPT_URL,'http://egov.ddit.ac.in/index.php?r=site/login');	
		$output1 = curl_exec($ch);
		 
		curl_setopt($ch, CURLOPT_URL,'http://egov.ddit.ac.in/index.php?r=tblstudentmst/academicHistory');
		$output2 = curl_exec($ch);
		
		curl_setopt ($ch, CURLOPT_POST, TRUE);
		curl_setopt ($ch, CURLOPT_POSTFIELDS, "sessionno=".$currentsem."&batchyear=".$batchyear."");
		curl_setopt($ch, CURLOPT_URL,'http://egov.ddit.ac.in/index.php?r=tblstudentmst/'.$examtype.'Relational');
		$output3 = curl_exec($ch);
	
		if(file_exists($cookie_file_path))
        	unlink($cookie_file_path);


		return $output3;
	}

	function getContentForGraph($aid, $egovid, $birthdate, $examtype, $currentsem, $batchyear) {

		$spiout = array();

    	$cookie_file_path = "cookie.txt";	
		if(file_exists($cookie_file_path))
		    unlink($cookie_file_path);
	   
		$ch = curl_init();


		
		curl_setopt ($ch, CURLOPT_POST, TRUE);
		curl_setopt ($ch, CURLOPT_POSTFIELDS, "LoginForm[username]=".$egovid."&LoginForm[password]=".$birthdate."");
		curl_setopt ($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt ($ch, CURLOPT_HEADER, 0);
		curl_setopt ($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);
		curl_setopt ($ch, CURLOPT_COOKIEJAR, $cookie_file_path);
		curl_setopt ($ch, CURLOPT_COOKIEFILE, $cookie_file_path);
			
		curl_setopt($ch, CURLOPT_URL,'http://egov.ddit.ac.in/index.php?r=site/login');	
		$output1 = curl_exec($ch);
		 
		curl_setopt($ch, CURLOPT_URL,'http://egov.ddit.ac.in/index.php?r=tblstudentmst/academicHistory');
		$output2 = curl_exec($ch);
		
		for($semesterloop=1; $semesterloop <= $currentsem; $semesterloop++) {
			curl_setopt ($ch, CURLOPT_POST, TRUE);
			curl_setopt ($ch, CURLOPT_POSTFIELDS, "sessionno=".$semesterloop."&batchyear=".$batchyear."");
			curl_setopt($ch, CURLOPT_URL,'http://egov.ddit.ac.in/index.php?r=tblstudentmst/'.$examtype.'Relational');
			$output3 = curl_exec($ch);

			if (strpos($output3,'Error') !== false) {
				//echo("There was an error.");
                break;
            }

            $pos = strpos($output3, 'SPI:');
            if($pos !== false) {

                $spiout[] = substr($output3, $pos+4, 3); 
            }
        }
	
		if(file_exists($cookie_file_path))
        	unlink($cookie_file_path);


		return $spiout;
	}

	function isLoginSuccessful($egovid, $birthdate) {

		$cookie_file_path = "cookie.txt";	
		if(file_exists($cookie_file_path))
		    unlink($cookie_file_path);
   
		$ch = curl_init();
		
		curl_setopt ($ch, CURLOPT_POST, TRUE);
		curl_setopt ($ch, CURLOPT_POSTFIELDS, "LoginForm[username]=".$egovid."&LoginForm[password]=".$birthdate."");
		curl_setopt ($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt ($ch, CURLOPT_HEADER, 0);
		curl_setopt ($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);
		curl_setopt ($ch, CURLOPT_COOKIEJAR, $cookie_file_path);
		curl_setopt ($ch, CURLOPT_COOKIEFILE, $cookie_file_path);		
			
		curl_setopt($ch, CURLOPT_URL,'http://egov.ddit.ac.in/index.php?r=site/login');	
		$output1 = curl_exec($ch);

		curl_setopt($ch, CURLOPT_URL,'http://egov.ddit.ac.in/index.php?r=tblstudentmst/academicHistory');
		$output2 = curl_exec($ch);
		
		//echo $output2;

		if(file_exists($cookie_file_path))
        	unlink($cookie_file_path);

		if (strpos($output2,'Username') !== false) {
            return false;
            //return true;
        }
        else {
        	return true;	
        }
	}

?>
