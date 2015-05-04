<?php
$cookie_file_path = "cookie.txt";	
if(file_exists($cookie_file_path))
    unlink($cookie_file_path);
    
require("../class/simplehtmldom/simple_html_dom.php");

function getResult($id, $pass, $session, $year, $type) {
    $cookie_file_path = "cookie.txt";	
    	
    $ch = curl_init();		
    curl_setopt ($ch, CURLOPT_POST, TRUE);
    curl_setopt ($ch, CURLOPT_POSTFIELDS, "LoginForm[username]=$id&LoginForm[password]=$pass");
    curl_setopt ($ch, CURLOPT_RETURNTRANSFER, TRUE);		
    curl_setopt ($ch, CURLOPT_HEADER, 0);		
//    curl_setopt ($ch, CURLOPT_FOLLOWLOCATION, 1);		
    curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);		
    curl_setopt ($ch, CURLOPT_COOKIEJAR, $cookie_file_path);		
    curl_setopt ($ch, CURLOPT_COOKIEFILE, $cookie_file_path);
    curl_setopt($ch, CURLOPT_URL,'http://egov.ddit.ac.in/index.php?r=site/login');			
    $output1 = curl_exec($ch);		
    curl_setopt($ch, CURLOPT_URL,'http://egov.ddit.ac.in/index.php?r=tblstudentmst/academicHistory');		
    $output2 = curl_exec($ch);
    curl_setopt ($ch, CURLOPT_POST, TRUE);		
    curl_setopt ($ch, CURLOPT_POSTFIELDS, "sessionno=$session&batchyear=$year");		
    curl_setopt($ch, CURLOPT_URL,"http://egov.ddit.ac.in/index.php?r=tblstudentmst/$type");		
    $output3 = curl_exec($ch);    	
    curl_close($ch);
    $html = str_get_html($output3);
    
    //remove additional spaces
    $pat[0] = "/^\s+/";
    $pat[1] = "/\s{2,}/";
    $pat[2] = "/\s+\$/";
    $rep[0] = "";
    $rep[1] = " ";
    $rep[2] = "";
    
    $ret = $html->find('div[id=content]');
    $checknew = $ret[0];
    
    if(file_exists($cookie_file_path))
        unlink($cookie_file_path);
    
    return $checknew;	
    
}



?>