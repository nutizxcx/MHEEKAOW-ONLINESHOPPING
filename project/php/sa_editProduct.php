<?php
    include 'db_connection.php';
    $_REQUEST['f']();
    
    function selPic(){
        $connection = openCon();
        $prodColor = $_REQUEST['prodColor'];
        $prodGroup = $_REQUEST['prodGroup'];
        $prodID = (int)$_REQUEST['prodID'];
        $sql = "SELECT i.ImagePath ,i.ImageNO
                FROM `image` i 
                JOIN skudetail s
                ON s.SKU = i.SKU
                WHERE s.Group = '$prodGroup'
                AND s.Color = '$prodColor'
                AND i.ProductID = $prodID
               ";
        $result = mysqli_query($connection,$sql);
        $arr = [];
        while($row = mysqli_fetch_array($result)){
            array_push($arr,$row);
        }
        echo json_encode($arr);
        mysqli_close($connection);
    }


    function selGroup( ){
        $prodID = $_REQUEST['prodID'];
        $connection = openCon();
        $sql = "SELECT DISTINCT s.Group FROM remain r
                JOIN skudetail s ON s.SKU = r.SKU
                WHERE r.ProductID = $prodID";
        $result = mysqli_query($connection,$sql);
        $arr = [];
        while($row = mysqli_fetch_array($result)){
            array_push($arr,$row);
        }
        echo json_encode($arr);
        mysqli_close($connection);
    }


    function selColor( ){
        $prodID = $_REQUEST['prodID'];
        $connection = openCon();
        $sql = "SELECT DISTINCT s.Color FROM remain r
                JOIN skudetail s ON s.SKU = r.SKU
                WHERE r.ProductID = $prodID";
        $result = mysqli_query($connection,$sql);
        $arr = [];
        while($row = mysqli_fetch_array($result)){
            array_push($arr,$row);
        }
        echo json_encode($arr);
        mysqli_close($connection);
    }

    function getNameUser() {
        echo getName();
    }

    function edit() {
        $connection = openCon();
        $id = $_GET['id'];
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

        mysqli_query($connection, 
            "UPDATE product_infomation
            SET ManufacturerID = '$manuID', Name = '$name', Detail = '$detail', Cost = '$cost', SellingPrice = '$price'
            WHERE ProductID = '$id'");
        for($i = 0; $i < sizeof($size); $i++) {
            $sku = $cate.'-'.$group.'-'.$colorID.'-'.$size[$i];
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
        $result = mysqli_query($connection, 
            "SELECT *
            FROM skudetail
            WHERE SKU = '$sku'");
        if(mysqli_num_rows($result) == 0) {
                mysqli_query($connection,
                "INSERT INTO skudetail
                VALUES ('$sku', '$cateName', '$groupName', '$color', '$size[$i]')");
        }
        mysqli_query($connection, 
            "UPDATE remain
            SET SKU = '$sku', Remain = '$amount'
            WHERE ProductID = '$id'");
        }
        closeCon($connection);
        echo TRUE;    
    }

    function callProductID() {
        $key = $_REQUEST['q'];
        $connection = openCon();
        $i = 0;
        $a = array('', '', '', '', '', '');
        $result = mysqli_query($connection, 
            "SELECT ProductID
            FROM product_infomation
            WHERE ProductID LIKE "."'%$key%'"
            . "LIMIT 6");
        closeCon($connection);
        while($row = mysqli_fetch_array($result)) {
            $a[$i] = (string)$row['ProductID'];
            $i++;
        }
        echo json_encode($a);
    }

    function existData() {
        $connection = openCon();
        $result = mysqli_query($connection,
            "SELECT *
            FROM product_infomation
            WHERE ProductID = ".$_GET['id']);
        closeCon($connection);
        if(mysqli_num_rows($result) == 0) {
            echo FALSE;
        }
        else {
            echo TRUE;
        }
    }

    function showQuery() {
        $id = $_REQUEST['id'];
        $i = 0;
        $temp1 = '';
        $temp2 = '';
        $connection = openCon();
        $result = mysqli_query($connection, 
            "SELECT DISTINCT p.Name, p.Detail, s.Category, s.Group, p.Cost, p.ManufacturerID, p.SellingPrice, s.Color, s.Size, r.Remain, s.SKU, i.ImagePath
            FROM product_infomation p
                JOIN remain r ON p.ProductID = r.ProductID AND p.ProductID = '$id'
                JOIN skudetail s ON r.SKU = s.SKU
                JOIN image i ON i.ProductID = p.ProductID AND i.SKU = s.SKU");
        closeCon($connection);
        $size = array_fill(0, (mysqli_num_rows($result)), 0);
        while($row = mysqli_fetch_array($result)) {
            $size[$i] = ($row['SKU'][10]).($row['SKU'][11]).($row['SKU'][12]);
            $img[$i] = $row['ImagePath'];
            $temp2 = $row['Color'];
            if($i != 0) {
                if($temp1!=$temp2) {
                    $color[$i] = $row['Color'];
                    $colorID[$i] = ($row['SKU'][6]).($row['SKU'][7]).($row['SKU'][8]);
                }
            } else{
                $color[$i] = $row['Color'];
                $colorID[$i] = ($row['SKU'][6]).($row['SKU'][7]).($row['SKU'][8]);
            } 
            $i++;
            $temp1 = $row['Color'];
            $cate = ($row['SKU'][0]).($row['SKU'][1]).($row['SKU'][2]);
            $group = ($row['SKU'][4]);
            $name = $row['Name'];
            $detail = $row['Detail'];
            $manuID = $row['ManufacturerID'];
            $cost = $row['Cost'];
            $price = $row['SellingPrice'];
            $amount = $row['Remain'];
        }
        $obj = array(
                'name' => $name,
                'detail' => $detail,
                'manuID' => $manuID,
                'cate' => $cate,
                'group' => $group,
                'color' => $color,
                'colorID' => $colorID,
                'cost' => $cost,
                'price' => $price,
                'size' => $size,
                'amount' => $amount,
                'img' => $img
        );
        $json = json_encode($obj);
        echo $json;
    }
?>