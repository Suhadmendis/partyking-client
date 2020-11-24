<?php

session_start();


require_once ("../DB_connector.php");

date_default_timezone_set('Asia/Colombo');

if ($_GET["Command"] == "checkUser") {
   header('Content-Type: application/json');
    
    $objArray = Array();
    $sql = "SELECT * FROM m_registration where fb_id = '" . $_GET['fb_id'] . "'";
    $result = $conn->query($sql);
    $row = $result->fetchAll();

    array_push($objArray,sizeof($row));

    echo json_encode($objArray);
    
}




if ($_GET["Command"] == "register_user_fb") {
    
    try {
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->beginTransaction();

        
        
        
        $names = explode(" ", $_GET['fb_name']);

        if($names[0] != ""){
            $first_name = $names[0];
        }
        if($names[1] != ""){
            $last_name = $names[1];
        }
        
        if (sizeof($names) == 3) {
            if($names[2] != ""){
                $last_name = $names[2];
            }
        }


        $sql = "SELECT * FROM m_registration where fb_id = '" . $_GET['fb_id'] . "'";
        $result = $conn->query($sql);
        $row = $result->fetchAll();

        if (sizeof($row)==0) {
            $sql      = "SELECT registration_ref FROM sys_info";
            $resul    = $conn->query($sql);
            $row      = $resul->fetch();
            $no       = $row["registration_ref"];
            $tmpinvno = "0000000000" . $row["registration_ref"];
            $lenth    = strlen($tmpinvno);
            $no1      = trim("UID/") . substr($tmpinvno, $lenth - 10);

            $sql = "Insert into m_registration(REF, fb_id,first_name,last_name)values
            ('" . $no1 . "' ,'" . $_GET['fb_id'] . "','" . $first_name . "','" . $last_name . "')";
            $result = $conn->query($sql);
            
            $REF = $no1;

            $no2    = $no + 1;
            $sql    = "update sys_info set registration_ref = '" . $no2 . "' where registration_ref = '" . $no . "'";
            $result = $conn->query($sql);



            $sql      = "SELECT store_ref FROM sys_info";
            $resul    = $conn->query($sql);
            $row      = $resul->fetch();
            $no       = $row["store_ref"];
            $tmpinvno = "0000000000" . $row["store_ref"];
            $lenth    = strlen($tmpinvno);
            $no1      = trim("ST/") . substr($tmpinvno, $lenth - 10);

            $sql = "Insert into m_store_registration(REF, seller_ref)values
            ('" . $no1 . "','" . $REF . "')";
            $result = $conn->query($sql);

            $no2    = $no + 1;
            $sql    = "update sys_info set store_ref = '" . $no2 . "' where store_ref = '" . $no . "'";
            $result = $conn->query($sql);
            

            $sql = "Insert into sys_log(REF, entry, operation, user, ip)values
                            ('" . $no1 . "' ,'entry' ,'SAVE Product'  ,'" . $_GET['fb_id'] . "' ,'ip')";
            $result = $conn->query($sql);

            $conn->commit();
            echo "Saved";
        }else{
            echo "Not Done";
        }


        

    } catch (Exception $e) {
        $conn->rollBack();
        echo $e;
    }
}






if ($_GET["Command"] == "login_user_fb") {

    $sql = "SELECT * FROM m_registration WHERE fb_id =  '" . $_GET['fb_id'] . "'";
    $result = $conn->query($sql);

    if ($row = $result->fetch()) {

        $sessionId = session_id();
        $_SESSION['sessionId'] = session_id();
        session_regenerate_id();
        $ip = $_SERVER['REMOTE_ADDR'];
        $_SESSION['email'] = $_GET['fb_id'];
        $_SESSION['REF'] = $row['REF'];
        $_SESSION['CURRENT_USER'] = $row['first_name']. " ".$row['first_name'];
    
        $action = "ok";
        $cookie_name = "pk_seller";
        $cookie_value = $_GET['fb_id'];

        $token = substr(hash('sha512', mt_rand() . microtime()), 0, 50);
        $extime = time() + 43200;

        $domain = $_SERVER['HTTP_HOST'];

        setcookie('pk_seller', $cookie_value, $extime, "/", $domain);
        
        echo $action;

    } else {
        $action = "error";
        echo $action;
    }
}