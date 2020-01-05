<?php
    include 'db_connection.php';
    $_REQUEST['f']();

    function getNameUser() {
        echo getName();
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

    function delete() {
        $connection = openCon();
        $id = $_REQUEST['id'];
        mysqli_query($connection, 
            "DELETE FROM product_infomation
            WHERE ProductID = '$id'");
        mysqli_query($connection, 
            "DELETE FROM skudetail
            WHERE ProductID = '$id'");
        closeCon($connection);
    }

?>