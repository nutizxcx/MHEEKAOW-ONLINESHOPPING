<?php
    include 'db_connection.php';
    $_REQUEST['f']();
    
    function getNameUser() {
        echo getName();
    }

    function add() {
        $connection = openCon();

        $name = $_GET['name'];
        $detail = $_GET['detail'] == '' ? '-' : $_GET['detail'];
        $manuID = $_GET['manuID'];
        $cate = $_GET['cate'];
        $group = $_GET['group'];
        $size = $_GET['size'];
        $color = $_GET['color'];
        $colorID = $_GET['colorID'];
        $cost = $_GET['cost'];
        $price = $_GET['price'];
        $amount = $_GET['amount'];
        $img = $_GET['img'];

        mysqli_query($connection, 
            "INSERT INTO product_infomation (ManufacturerID, Name, Detail, Cost, SellingPrice)
            VALUES ('$manuID', '$name', '$detail', '$cost', '$price')");
        $result = mysqli_query($connection, 
            "SELECT ProductID
            FROM product_infomation
            WHERE ManufacturerID = '$manuID' AND
                Name = '$name'");
        while($row = mysqli_fetch_array($result)) {
            $productID = $row['ProductID'];
        }
        for($j = 0; $j < sizeof($colorID); $j++) {
            for($i = 0; $i < sizeof($size); $i++) {
                $sku = $cate.'-'.$group.'-'.$colorID[$j].'-'.$size[$i];
                $sku_img = $cate.'-'.$group.'-'.$colorID[$j].'-'.'380';
                $cateName = "";
                $groupName = "";
                switch ($cate) {
                    case "FIT":
                        $cateName = "fitness";
                        break;
                    case "BAS":
                        $cateName = "basketball";
                        break;
                    case "RUN":
                        $cateName = "running";
                        break;
                    case "TRV":
                        $cateName = "travel";
                        break;
                    case "BOT":
                        $cateName = "boot";
                        break;
                    case "FAS":
                        $cateName = "fashion";
                        break;
                }
                switch ($group) {
                    case "M":
                        $groupName = "men";
                        break;
                    case "W":
                        $groupName = "women";
                        break;
                    case "U":
                        $groupName = "unisex";
                        break;
                }
                mysqli_query($connection,
                    "INSERT INTO skudetail
                    VALUES ('$sku', '$cateName', '$groupName', '$color[$j]', '$size[$i]')");
                mysqli_query($connection, 
                    "INSERT INTO remain
                    VALUES ('$productID', '$sku', '$amount')");
            }
            for($k = 0; $k < sizeof($img); $k++) {
                echo $img[$k];
                mysqli_query($connection, 
                    "INSERT INTO image
                    VALUES ('$productID','($k+1)','$sku_img[$j]','$img[$k]')");
            }
    }
        closeCon($connection);
    }
?>