<?php

session_start();


require_once ("../DB_connector.php");

date_default_timezone_set('Asia/Colombo');

if ($_GET["Command"] == "generate") {
   header('Content-Type: application/json');
    
    $objArray = Array();
    $sql = "SELECT * FROM m_category";
    $result = $conn->query($sql);
    $row = $result->fetchAll();

    array_push($objArray,$row);

    echo json_encode($objArray);
    
}


if ($_GET["Command"] == "generateProducts") {
   header('Content-Type: application/json');
    
    $objArray = Array();
    $sql = "SELECT * FROM m_product";
    $result = $conn->query($sql);
    $row = $result->fetchAll();
    
    
    array_push($objArray,$row);

    echo json_encode($objArray);
    
}

if ($_GET["Command"] == "getSubCategories") {
   header('Content-Type: application/json');
    
    $objArray = Array();
    $sql = "SELECT * FROM m_sub_category where category_ref = '" . $_GET['REF'] . "'";
    $result = $conn->query($sql);
    $row = $result->fetchAll();
    
    array_push($objArray,$row);
    echo json_encode($objArray);    
}



if ($_GET["Command"] == "save_product") {
    
    try {
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->beginTransaction();

        $CURRENT_USER = "User Name";
        
        $sql      = "SELECT product_ref FROM sys_info";
        $resul    = $conn->query($sql);
        $row      = $resul->fetch();
        $no       = $row["product_ref"];
        $tmpinvno = "0000000000" . $row["product_ref"];
        $lenth    = strlen($tmpinvno);
        $no1      = trim("PRO/") . substr($tmpinvno, $lenth - 10);

        // $sql    = "Insert into m_product(REF, name, category_ref, sub_category_ref, condition, brand, model, theme, description, day_price, sell_price, user)values
        // ('" . $no1 . "' ,'" . $_GET['name'] . "','" . $_GET['category_ref'] . "','" . $_GET['sub_category_ref'] . "','" . $_GET['condition'] . "','" . $_GET['brand'] . "','" . $_GET['model'] . "','" . $_GET['theme'] . "','" . $_GET['description'] . "','" . $_GET['day_price'] . "','" . $_GET['sell_price'] . "','" . $CURRENT_USER . "')";
        // $result = $conn->query($sql);

        $sql    = "Insert into m_product(REF, name, category_ref, sub_category_ref, pro_condition, brand, model, theme, description, type, day_price, sell_price, user)values
        ('" . $no1 . "' ,'" . $_GET['name'] . "','" . $_GET['category_ref'] . "','" . $_GET['sub_category_ref'] . "','" . $_GET['condition'] . "','" . $_GET['brand'] . "','" . $_GET['model'] . "','" . $_GET['theme'] . "','" . $_GET['description'] . "','" . $_GET['type'] . "','" . $_GET['day_price'] . "','" . $_GET['sell_price'] . "','" . $CURRENT_USER . "')";
        $result = $conn->query($sql);

        // $sql    = "Insert into m_product(REF, name, category_ref,sub_category_ref,condition)values
        // ('" . $no1 . "' ,'" . $_GET['name'] . "','" . $_GET['category_ref'] . "','" . $_GET['sub_category_ref'] . "','" . $_GET['condition'] . "')";
        // $result = $conn->query($sql);

        $no2    = $no + 1;
        $sql    = "update sys_info set product_ref = '" . $no2 . "' where product_ref = '" . $no . "'";
        $result = $conn->query($sql);

        $sql = "Insert into sys_log(REF, entry, operation, user, ip)values
                        ('" . $no1 . "' ,'entry' ,'SAVE Product'  ,'" . $CURRENT_USER . "' ,'ip')";
        $result = $conn->query($sql);

        $conn->commit();
        echo "Saved";

    } catch (Exception $e) {
        $conn->rollBack();
        echo $e;
    }
}



