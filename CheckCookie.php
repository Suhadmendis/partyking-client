<?php

session_start();
date_default_timezone_set('Asia/Colombo');

function chk_cookie($email) {
    include './DB_connector.php';
    

    $sql = "SELECT * FROM m_registration WHERE email =  '" . $email . "'";
    $result = $conn->query($sql);

    if ($row = $result->fetch()) {

        $sessionId = session_id();
        $_SESSION['sessionId'] = session_id();
        session_regenerate_id();
        $ip = $_SERVER['REMOTE_ADDR'];
        $_SESSION['email'] = $email;
        $_SESSION["CURRENT_USER"] = $row['first_name'] . " " . $row['last_name'];
        $_SESSION["REF"] = $row['REF'];
        $_SESSION["TYPE"] = $row['type'];
        $_SESSION["PRO_ID"] = $row['id'];

        $_SESSION["school1"] = $row['school1'];
        $_SESSION["school2"] = $row['school2'];
        $_SESSION["school3"] = $row['school3'];


        if($row['type'] == "S"){
            $action = "S";
        }else{
            $action = "B";
        }


        /*
          $_SESSION['User_Type'] = $row['dev'];

          if (is_null($row["sal_ex"]) == false) {
          $_SESSION["CURRENT_REP"] = $row["sal_ex"];
          } else {
          $_SESSION["CURRENT_REP"] = "";
          }
         */
//
//        if (is_null($row["dlr_code"]) == false) {
//            $_SESSION["CURRENT_DLR"] = $row["dlr_code"];
//        } else {
//            $_SESSION["CURRENT_DLR"] = "";
//        }

//        $_SESSION["CURRENT_DLR"] = "A111";

//        $cookie_name = "pk_seller";
//        $cookie_value = $email;
//        setcookie($cookie_name, $cookie_value, time() + (43200), "/"); // 86400 = 1 day



        $cookie_name = "pk_seller";
        $cookie_value = $email;

        $token = substr(hash('sha512', mt_rand() . microtime()), 0, 50);
        $extime = time() + 160000000;
        $domain = $_SERVER['HTTP_HOST'];
        setcookie('pk_seller', $cookie_value, $extime, "/", $domain);

        //$ResponseXML .= "<stat><![CDATA[" . $action . "]]></stat>";
        $time = date("H:i:s");
        $today = date('Y-m-d');
//        $sql = "Insert into loging(Name,User_Type,Date,Logon_Time,Sessioan_Id,ip) values ('" . $email . "','" . $_SESSION['User_Type'] . "','" . $today . "','" . $time . "','" . $_SESSION['sessionId'] . "','" . $ip . "')";
//        $conn->exec($sql);
        return $action;
    } else {
        //$ResponseXML .= "<stat><![CDATA[" . $action . "]]></stat>";
        //$ResponseXML .= "</salesdetails>";
        //echo $ResponseXML;
        return "not";
        echo 'not';
    }
}
