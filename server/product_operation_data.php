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

if ($_GET["Command"] == "getProduct") {
   header('Content-Type: application/json');
    
    $objArray = Array();
    $sql = "SELECT * FROM m_product where REF = '" . $_GET['REF'] . "'";
    $result = $conn->query($sql);
    $row1 = $result->fetch();

    array_push($objArray,$row1);

    $sql = "SELECT * FROM m_category where REF = '" . $row1['category_ref'] . "'";
    $result = $conn->query($sql);
    $row2 = $result->fetch();

    array_push($objArray,$row2);

    $sql = "SELECT * FROM m_sub_category where REF = '" . $row1['sub_category_ref'] . "'";
    $result = $conn->query($sql);
    $row = $result->fetch();

    array_push($objArray,$row);

    echo json_encode($objArray);
    
}


if ($_GET["Command"] == "user_get_products") {
   header('Content-Type: application/json');
    
    $objArray = Array();
    $sql = "SELECT * FROM m_product";
    $result = $conn->query($sql);
    $row = $result->fetchAll();

    array_push($objArray,$row);

    echo json_encode($objArray);
    
}

if ($_GET["Command"] == "user_get_product") {
   header('Content-Type: application/json');
    
    $objArray = Array();
    $sql = "SELECT * FROM m_product where REF = '" . $_GET['REF'] . "'";
    $result = $conn->query($sql);
    $row = $result->fetch();

    array_push($objArray,$row);

    $sql = "SELECT * FROM m_store_registration where REF = '" . $row['store_ref'] . "'";
    $result = $conn->query($sql);
    $row = $result->fetch();

    array_push($objArray,$row);

    echo json_encode($objArray);
    
}



if ($_GET["Command"] == "generateProducts") {
   header('Content-Type: application/json');
    

    $sql_store      = "SELECT REF FROM m_store_registration where seller_ref = '" . $_SESSION['REF'] . "'";
    $resul    = $conn->query($sql_store);
    $row_store      = $resul->fetch();


    $objArray = Array();
    $sql = "SELECT * FROM m_product where store_ref = '" . $row_store['REF'] . "' and cancel = '0'";
    $result = $conn->query($sql);
    $row = $result->fetchAll();
    
    
    array_push($objArray,$row);


    $sql = "SELECT * FROM m_registration where REF = '" . $_SESSION['REF'] . "'";
    $result = $conn->query($sql);
    $row = $result->fetchAll();

    array_push($objArray,$row);

    $sql = "SELECT * FROM m_store_registration where seller_ref = '" . $_SESSION['REF'] . "'";
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
        

        $sql_store      = "SELECT REF FROM m_store_registration where seller_ref = '" . $_SESSION['REF'] . "'";
        $resul    = $conn->query($sql_store);
        $row_store      = $resul->fetch();

        $sql    = "Insert into m_product(REF, name, category_ref, sub_category_ref, pro_condition, brand, model, theme, description, type, day_price, sell_price, user,image_1,store_ref)values
        ('" . $no1 . "' ,'" . $_GET['name'] . "','" . $_GET['category_ref'] . "','" . $_GET['sub_category_ref'] . "','" . $_GET['condition'] . "','" . $_GET['brand'] . "','" . $_GET['model'] . "','" . $_GET['theme'] . "','" . $_GET['description'] . "','" . $_GET['type'] . "','" . $_GET['day_price'] . "','" . $_GET['sell_price'] . "','" . $CURRENT_USER . "','" . $_GET['image'] . "','" . $row_store['REF'] . "')";
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





if ($_GET["Command"] == "update_product") {
    
    try {
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->beginTransaction();

        $CURRENT_USER = "User Name";
        
        
        $sql = "update m_product set name = '" . $_GET['name'] . "' where REF = '" . $_GET['REF'] . "'";
        $result = $conn->query($sql);
        
        $sql = "update m_product set category_ref = '" . $_GET['category_ref'] . "' where REF = '" . $_GET['REF'] . "'";
        $result = $conn->query($sql);
        
        $sql = "update m_product set sub_category_ref = '" . $_GET['sub_category_ref'] . "' where REF = '" . $_GET['REF'] . "'";
        $result = $conn->query($sql);
        
        $sql = "update m_product set pro_condition = '" . $_GET['condition'] . "' where REF = '" . $_GET['REF'] . "'";
        $result = $conn->query($sql);
        
        $sql = "update m_product set brand = '" . $_GET['brand'] . "' where REF = '" . $_GET['REF'] . "'";
        $result = $conn->query($sql);
        
        $sql = "update m_product set model = '" . $_GET['model'] . "' where REF = '" . $_GET['REF'] . "'";
        $result = $conn->query($sql);
        
        $sql = "update m_product set theme = '" . $_GET['theme'] . "' where REF = '" . $_GET['REF'] . "'";
        $result = $conn->query($sql);
        
        $sql = "update m_product set description = '" . $_GET['description'] . "' where REF = '" . $_GET['REF'] . "'";
        $result = $conn->query($sql);
        
        $sql = "update m_product set type = '" . $_GET['type'] . "' where REF = '" . $_GET['REF'] . "'";
        $result = $conn->query($sql);
        
        $sql = "update m_product set day_price = '" . $_GET['day_price'] . "' where REF = '" . $_GET['REF'] . "'";
        $result = $conn->query($sql);
        
        $sql = "update m_product set sell_price = '" . $_GET['sell_price'] . "' where REF = '" . $_GET['REF'] . "'";
        $result = $conn->query($sql);
        
        $sql = "update m_product set user = '" . $CURRENT_USER . "' where REF = '" . $_GET['REF'] . "'";
        $result = $conn->query($sql);

        $sql = "update m_product set image_1 = '" . $_GET['image'] . "' where REF = '" . $_GET['REF'] . "'";
        $result = $conn->query($sql);


       
        $sql = "Insert into sys_log(REF, entry, operation, user, ip)values
                        ('" . $_GET['REF'] . "' ,'entry' ,'Update Product'  ,'" . $CURRENT_USER . "' ,'ip')";
        $result = $conn->query($sql);

        $conn->commit();
        echo "Updated";

    } catch (Exception $e) {
        $conn->rollBack();
        echo $e;
    }
}



if ($_GET["Command"] == "delete_product") {
    
    try {
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->beginTransaction();

        $CURRENT_USER = "User Name";
        
        
        $sql = "update m_product set cancel = '1' where REF = '" . $_GET['REF'] . "'";
        $result = $conn->query($sql);
        
        $sql = "Insert into sys_log(REF, entry, operation, user, ip)values
                        ('" . $_GET['REF'] . "' ,'entry' ,'Delete Product'  ,'" . $CURRENT_USER . "' ,'ip')";
        $result = $conn->query($sql);

        $conn->commit();
        echo "Deleted";

    } catch (Exception $e) {
        $conn->rollBack();
        echo $e;
    }
}








if ($_GET["Command"] == "edit_update") {
   header('Content-Type: application/json');
    
    try {
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->beginTransaction();


        $value = str_replace("'","\'",$_GET['value']);

        if ($_GET['flag'] == "user_number") {
            $sql = "update m_registration set tel_1 = '" . $value . "' where REF = '" . $_GET['REF'] . "'";
            $result = $conn->query($sql);
        }

        if ($_GET['flag'] == "store_name") {
            $sql = "update m_store_registration set name = '" . $value . "' where seller_ref = '" . $_GET['REF'] . "'";
            $result = $conn->query($sql);
        }

        if ($_GET['flag'] == "tagline") {
            $sql = "update m_store_registration set tagline = '" . $value . "' where seller_ref = '" . $_GET['REF'] . "'";
            $result = $conn->query($sql);
        }

        if ($_GET['flag'] == "store_email") {
            $sql = "update m_store_registration set email = '" . $value . "' where seller_ref = '" . $_GET['REF'] . "'";
            $result = $conn->query($sql);
        }

        if ($_GET['flag'] == "store_number") {
            $sql = "update m_store_registration set tel_1 = '" . $value . "' where seller_ref = '" . $_GET['REF'] . "'";
            $result = $conn->query($sql);
        }

        if ($_GET['flag'] == "store_address") {
            $sql = "update m_store_registration set address_1 = '" . $value . "' where seller_ref = '" . $_GET['REF'] . "'";
            $result = $conn->query($sql);
        }

        if ($_GET['flag'] == "store_city") {
            $sql = "update m_store_registration set city_name = '" . $value . "' where seller_ref = '" . $_GET['REF'] . "'";
            $result = $conn->query($sql);
        }

        if ($_GET['flag'] == "store_postal") {
            $sql = "update m_store_registration set postal = '" . $value . "' where seller_ref = '" . $_GET['REF'] . "'";
            $result = $conn->query($sql);
        }

      

        $conn->commit();
        echo "Saved";

    } catch (Exception $e) {
        $conn->rollBack();
        echo $e;
    }
    
}


if ($_GET["Command"] == "debug") {
   header('Content-Type: application/json');
    
        
        echo "fdsfg";
    // print_r($_SESSION);
    
}




if ($_GET["Command"] == "user_category") {
   header('Content-Type: application/json');
    
    $objArray = Array();
    $sql = "SELECT * FROM m_category";
    $result = $conn->query($sql);
    $row = $result->fetchAll();

    $flag = 1;
    for ($i=0; $i < sizeof($row); $i++) { 
        $sql = "SELECT * FROM m_sub_category where category_ref = '" . $row[$i]['REF'] . "'";
        $result = $conn->query($sql);
        $row[$i]['sub_categories'] = $result->fetchAll();

        $row[$i]['active_pill'] = $flag;
        $flag = 0;
    }
    array_push($objArray,$row);

    echo json_encode($objArray);
    
}


