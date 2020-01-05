<?php
    include 'db_connection.php';
    $_REQUEST['f']();

    function getNameUser() {
        echo getName();
    }

    function callID() {
        $key = $_REQUEST['q'];
        $connection = openCon();
        $i = 0;
        $a = array('', '', '', '', '', '');
        $result = mysqli_query($connection, 
            "SELECT StaffID
            FROM staff
            WHERE StaffID LIKE "."'%$key%'"."AND staff.Role != 'FIRED'"
            ."LIMIT 6");
        closeCon($connection);
        while($row = mysqli_fetch_array($result)) {
            $a[$i] = (string)$row['StaffID'];
            $i++;
        }
        echo json_encode($a);
    }

    function existData() {
        $connection = openCon();
        $result = mysqli_query($connection,
            "SELECT *
            FROM staff
            WHERE StaffID = ".$_GET['id']);
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
            "UPDATE staff
            SET staff.Role = 'FIRED'
            WHERE StaffID = '$id'");
        closeCon($connection);
    }

?>