<?php
	require('getdbcon.php');
	
	if(isset($_POST['newaid']) && $_POST['newaid'] == "newaid") {

        function generate_password( $length = 3 ) {
            $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
            $password = substr( str_shuffle( $chars ), 0, $length );
            return $password;
        }

        function is_aid_present($aid_in) {
            $connection = getConnection();
            $aidquery = "SELECT * FROM accessid WHERE aid ='".$aid_in."'";
            $aidresult = mysqli_query($connection, $aidquery);
            if (mysqli_num_rows($aidresult) > 0)
                return false;
            else
                return true;
        }

        function is_egovid_present($egovid_in) {
            $connection = getConnection();
            $egov_id_query = "SELECT * FROM accessid WHERE egovid ='".$egovid_in."'";
            $egov_id_result = mysqli_query($connection, $egov_id_query);
            
            if (mysqli_num_rows($egov_id_result) > 0)
                return true;
            else
                return false;
        }

        while(1) {
            $aid = generate_password();
            if(is_aid_present($aid) == true) {
                break;
            }
        }

        $connection = getConnection();

        $egovid = isset($_POST['egovid']) ? $_POST['egovid'] : 'Fatal error.';

        $egovid = strtoupper($egovid);

        if(is_egovid_present($egovid) == true) {
            header("Location:accessid.php?mode=error&errorid=$egovid");
            exit;
        } 

        $birthdate = $_POST['date']."/".$_POST['month']."/".$_POST['year'];

        require('crawler.php');
        
        if(isLoginSuccessful($egovid, $birthdate) == false) {
            header("Location:accessid.php?mode=error");
            exit;
        } 

        $batchyear = isset($_POST['batchyear']) ? $_POST['batchyear'] : 'Fatal error.';
        $currentsem = isset($_POST['currentsem']) ? $_POST['currentsem'] : 'Fatal error.';

        $insertquery = "INSERT INTO accessid (aid, egovid, birthdate, currentsem, batchyear) VALUES ('".$aid."', '".$egovid."', '".$birthdate."', '".$currentsem."', '".$batchyear."')";
        
        mysqli_query($connection, $insertquery);

        if (!(mysql_affected_rows() != -1)) {
       
            header("Location:accessid.php?mode=error&errorid=$egovid");
            exit;
        }

        session_start();
        $_SESSION['registration'] = 1;

        $_COOKIE['registration'] = "successful";

        header("Location:result.php?aid=".$aid);

        exit;
    }
    
?>
