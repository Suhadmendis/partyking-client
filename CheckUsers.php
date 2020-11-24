<?php

session_start();
date_default_timezone_set('Asia/Colombo');
$Command = "";

if (isset($_GET['Command'])) {

    $Command = $_GET["Command"];
    include './DB_connector.php';
}


if ($Command == "CheckUsers") {

    $ResponseXML = "";
    $ResponseXML .= "<salesdetails>";
    $email = $_GET["email"];
    $Password = $_GET["Password"];
//    $ResponseXML .= "<action><![CDATA[" . $_GET['action'] . "]]></action>";
//    $ResponseXML .= "<form><![CDATA[" . $_GET['form'] . "]]></form>";
    $sql = "SELECT * FROM m_registration WHERE email =  '" . $email . "' and password =  '" . $Password . "' ";
    $result = $conn->query($sql);

    if ($row = $result->fetch()) {

        $sessionId = session_id();
        $_SESSION['sessionId'] = session_id();
        session_regenerate_id();
        $ip = $_SERVER['REMOTE_ADDR'];
        $_SESSION['email'] = $email;
        $_SESSION['CURRENT_USER'] = $email;
    
        $action = "ok";
        $cookie_name = "pk_seller";
        $cookie_value = $email;

        $token = substr(hash('sha512', mt_rand() . microtime()), 0, 50);
        $extime = time() + 43200;


        $domain = $_SERVER['HTTP_HOST'];

// set cookie

        setcookie('pk_seller', $cookie_value, $extime, "/", $domain);


        $ResponseXML .= "<stat><![CDATA[" . $action . "]]></stat>";
        echo $action;


        $time = mktime(date('h'), date('i'), date('s'));
        $time = date("g.i a");
        $today = date('Y-m-d');
    } else {
        $action = "not";
        $ResponseXML .= "<stat><![CDATA[" . $action . "]]></stat>";
        $ResponseXML .= "</salesdetails>";
        echo $ResponseXML;
    }
}



if ($_GET["Command"] == "save_inv") {


    $sql = "select * from m_registration where email='" . $_GET["email"] . "'";
    $result = $conn->query($sql);
    if ($row1 = $result->fetch()) {
        echo "Already Registered";
    } else {
        
        $sql = "SELECT registration_ref FROM sys_info";
        $result = $conn->query($sql);
        $row = $result->fetch();
        $no = $row['registration_ref'];

        $tmpinvno = "000000" . $row["registration_ref"];
        $lenth = strlen($tmpinvno);
        $no1 = trim("REG/") . substr($tmpinvno, $lenth - 7);

        $sql = "insert into m_registration(REF, first_name, middle_name, last_name, tel_1, address_1, city, email, password, first_name1, second_name1, school1, std_id1, first_name2, second_name2, school2, std_id2, first_name3, second_name3, school3, std_id3) values
        ('" . $no1 . "', '" . $_GET["first_name"] . "', '" . $_GET["middle_name"] . "', '" . $_GET["last_name"] . "', '" . $_GET["phone_number"] . "', '" . $_GET["address_home"] . "', '" . $_GET["city"] . "', '" . $_GET["email"] . "', '" . $_GET["txtPassword"] . "', '" . $_GET["first_name1"] . "', '" . $_GET["second_name1"] . "', '" . $_GET["school1"] . "', '" . $_GET["std_id1"] . "', '" . $_GET["first_name2"] . "', '" . $_GET["second_name2"] . "', '" . $_GET["school2"] . "', '" . $_GET["std_id2"] . "', '" . $_GET["first_name3"] . "', '" . $_GET["second_name3"] . "', '" . $_GET["school3"] . "', '" . $_GET["std_id3"] . "')";
        $result = $conn->query($sql);

        $sql = "update m_cart set user_ref = '" . $no1 . "' where user_ref = '" . $_SERVER['REMOTE_ADDR'] . "'";
        $result = $conn->query($sql);

        $no2 = $no + 1;
        $sql = "update sys_info set registration_ref = $no2 where registration_ref = $no";
        $result = $conn->query($sql);
//        echo $sql;
//        echo "Saved";


        date_default_timezone_set('Asia/Colombo');

        // require 'email/PHPMailerAutoload.php';
        // $mail = new PHPMailer;
        // $mail->isSMTP();

        // $mail->Host = 'mail.infodatasl.com';
        // $mail->Port = 587;
        // $mail->SMTPSecure = 'tls';
        // $mail->SMTPAuth = true;
        // $mail->email = "autoemail@infodatasl.com";
        // $mail->Password = "autoemail@123";


        $sql = "select * from m_registration where email='" . $_GET["email"] . "'";
        $result = $conn->query($sql);
//        echo $sql;
        if ($row = $result->fetch()) {

            // $uemail = $row["U_email"];
            // $remail = $row["R_email"];

            // $mail->setFrom('autoemail@infodatasl.com', 'Kot System');
            // $mail->addAddress($uemail, 'hhh');
        }

        // $table = "";
        // $table .= "<table style = 'width: 660px;' class = 'table1'>
        //             <tr>
        //             <th class = 'bottom head' colspan = '3'><center>Unichela Biyagama</center></th>
        //             </tr>

        //             <tr>
        //             <th class = 'bottom head' colspan = '3'><center>Kot System Login Details</center></th>
        //             </tr>
        //             <tr>
        //             <th class = 'bottom head' colspan = '3'><center></center></th>
        //             </tr>
        //             <tr>
        //             <th class = 'bottom head' colspan = '3'><center></center></th>
        //             </tr>
        //             <tr>
        //             <th class = 'bottom head' colspan = '3'><center></center></th>
        //             </tr>
        //             </table>";

        // $table .= "<table style = 'width: 660px;' class = 'table1'><tr>
        //             <th style = 'width: 40px;' class = 'left'>User Name :</th>
        //             <th style = 'width: 200px;' class = 'left'>" . $_GET['user_name'] . "</th>

        //             </tr></table>";

        // $table .= "<table style = 'width: 660px;' class = 'table1'><tr>
        //             <th style = 'width: 40px;' class = 'left'>Password :</th>
        //             <th style = 'width: 200px;' class = 'left'>" . $_GET['password'] . "</th>

        //             </tr></table>";

        // $table .= "<table style = 'width: 660px;' class = 'table1'><tr>
        //             <th style = 'width: 20px;' class = 'left'></th>
        //             <th style = 'width: 200px;' class = 'left'>Login Url :</th>
        //             <a href = 'http://infodatasl.com/UnichelaBiyagama/index.php'>Login Here</a>

        //             </tr></table>";


        // $mail->Body = '"' . $table . '"';
        // $mail->Subject = 'Kot Order';
        // $mail->isHTML(true);

        // if (!$mail->send()) {
            // echo "Mailer Error: " . $mail->ErrorInfo;
        // } else {
            echo "LOG";
        // }
    }
}


if ($_GET["Command"] == "become_a_seller") {


    
    try {
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->beginTransaction();

      

        $sql = "update m_registration set type = 'S' where REF = '" . $_SESSION['REF'] . "'";
        $result = $conn->query($sql);

        $sql = "Insert into sys_log(REF, entry, operation, user, ip)values
                        ('" . $_SESSION['REF'] . "' ,'entry' ,'Become a seller'  ,'" . $_SESSION['CURRENT_USER'] . "' ,'ip')";
        $result = $conn->query($sql);



        $conn->commit();
        echo "SELLER";
    } catch (Exception $e) {
        $conn->rollBack();
        echo $e;
    }
}

if ($Command == "logout") {

    $today = date('Y-m-d');
    $domain = $_SERVER['HTTP_HOST'];
    setcookie('pk_seller', "", 1, "/", $domain);



    session_unset();
    session_destroy();
}


if ($_GET["Command"] == "getdt") {

    $tb = "";
    $tb .= "<table class='table table-hover'>";


    $sql = "select * from user_mast order by user_name desc";




    $tb .= "<tr>";
    $tb .= "<th style=\"width: 100px;\" class=\"success\">Name</th>";
    $tb .= "<th style=\"width: 200px;\" class=\"success\">User Type</th>";
    $tb .= "<th style=\"width: 100px;\" class=\"success\">User Department</th>";
    $tb .= "<th style=\"width: 100px;\" class=\"success\">User Email</th>";
    $tb .= "<th style=\"width: 200px;\" class=\"success\">Department Head Mail</th>";

    $tb .= "</tr>";

    foreach ($conn->query($sql) as $row) {
        $tb .= "<tr>";
        $tb .= "<td onclick=\"getcode('" . $row['user_name'] . "','" . $row['user_type'] . "','" . $row['user_depart'] . "','" . $row['U_email'] . "','" . $row['R_email'] . "')\">" . $row['user_name'] . "</td>";
        $tb .= "<td onclick=\"getcode('" . $row['user_name'] . "','" . $row['user_type'] . "','" . $row['user_depart'] . "','" . $row['U_email'] . "','" . $row['R_email'] . "')\">" . $row['user_type'] . "</td>";
        $tb .= "<td onclick=\"getcode('" . $row['user_name'] . "','" . $row['user_type'] . "','" . $row['user_depart'] . "','" . $row['U_email'] . "','" . $row['R_email'] . "')\">" . $row['user_depart'] . "</td>";
        $tb .= "<td onclick=\"getcode('" . $row['user_name'] . "','" . $row['user_type'] . "','" . $row['user_depart'] . "','" . $row['U_email'] . "','" . $row['R_email'] . "')\">" . $row['U_email'] . "</td>";
        $tb .= "<td onclick=\"getcode('" . $row['user_name'] . "','" . $row['user_type'] . "','" . $row['user_depart'] . "','" . $row['U_email'] . "','" . $row['R_email'] . "')\">" . $row['R_email'] . "</td>";
        $tb .= "</tr>";
    }
    $tb .= "</table>";

    echo $tb;
}


if ($_GET["Command"] == "edit") {
    try {
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->beginTransaction();

        $sql2 = "update user_mast set user_type = '" . $_GET['user_type'] . "',user_depart = '" . $_GET['user_depart'] . "',U_email = '" . $_GET['U_email'] . "',R_email = '" . $_GET['R_email'] . "' where user_name = '" . $_GET['user_name'] . "'";

        $result = $conn->query($sql2);

        $conn->commit();
        echo "EDIT";
    } catch (Exception $e) {
        $conn->rollBack();
        echo $e;
    }
}

if ($_GET["Command"] == "delete") {

    $sql = "delete from user_mast where user_name = '" . $_GET['user_name'] . "'";
    $result = $conn->query($sql);

//    $conn->commit();
    echo "Delete";
}

?>