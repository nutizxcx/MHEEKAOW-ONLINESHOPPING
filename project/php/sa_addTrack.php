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
            "SELECT OrderID
            FROM order_history
            WHERE TrackingNumber = "."none".
                "AND OrderID LIKE "."'%$key%'"
            . "LIMIT 6");
        closeCon($connection);
        while($row = mysqli_fetch_array($result)) {
            $a[$i] = (string)$row['OrderID'];
            $i++;
        }
        echo json_encode($a);
    }

    function existData() {
        $connection = openCon();
        $result = mysqli_query($connection,
            "SELECT *
            FROM order_history
            WHERE OrderID = ".$_GET['id']);
        closeCon($connection);
        if(mysqli_num_rows($result) == 0) {
            echo FALSE;
        }
        else {
            echo TRUE;
        }
    }

    function showQuery() {
        $id = $_GET['id'];
        $i = 0;
        $html = '';
        $connection = openCon();
        $html = '<table border="1">';
        $html = $html.'<tr>';
        $html = $html.'<td height="30" style="font-weight:bold; text-align:center;">Order ID</td>';
        $html = $html.'<td height="30" style="font-weight:bold; text-align:center;">First Name</td>';
        $html = $html.'<td height="30" style="font-weight:bold; text-align:center;">Last Name</td>';
        $html = $html.'<td height="30" style="font-weight:bold; text-align:center;">Date And Time</td>';
        $html = $html.'<td height="30" style="font-weight:bold; text-align:center;">Status</td>';
        $html = $html.'<td height="30" style="font-weight:bold; text-align:center;">Tracking no.</td>';
        $html = $html.'</tr>';
        $sql="SELECT DISTINCT o.OrderID,h.FirstName,h.LastName,h.DateAndTime,h.Status, h.TrackingNumber
            FROM order_product o, order_history h
            WHERE o.OrderID = h.OrderID
                AND h.OrderID = '$id'
            ORDER BY h.DateAndTime";
        $query = mysqli_query($connection, $sql);
        while($data = mysqli_fetch_array($query)) {
            $html = $html.'<tr>';
            $html = $html.'<td height="30" style="text-align:center;">'.$data['OrderID'].'</td>';
            $html = $html.'<td height="30" style="text-align:center;">'.$data['FirstName'].'</td>';
            $html = $html.'<td height="30" style="text-align:center;">'.$data['LastName'].'</td>';
            $html = $html.'<td height="30" style="text-align:center;">'.$data['DateAndTime'].'</td>';
            $html = $html.'<td height="30" style="text-align:center;">'.$data['Status'].'</td>';
            $html = $html.'<td height="30" style="text-align:center;">'.$data['TrackingNumber'].'</td>';
            $html = $html.'</tr>';
        }
        $html = $html.'</table>';
        $html = $html.'</center>';
        mysqli_close($connection);
        echo $html;
        }

        function add() {
            $connection = openCon();
            $id = $_GET['id'];
            $trcking = $_GET['tracking'];
    
            mysqli_query($connection, 
                "UPDATE order_history 
                SET TrackingNumber = '$tracking'
                WHERE OrderID = '$id'");
            closeCon($connection);
        }

?>