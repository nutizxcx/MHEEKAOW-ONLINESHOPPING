<?php 
    session_start();
    if(isset($_SESSION['id'])){
   $con = mysqli_connect('localhost','root','','db_project');
    
   $sql = " SELECT AddressDescribe
            FROM `address` a JOIN customer c ON a.CustomerID = c.CustomerID
            WHERE a.CustomerID = '".$_SESSION['id']."'
        ";

   $result = mysqli_query($con,$sql);
    while($row = mysqli_fetch_array($result)){
        $arr[] = $row['AddressDescribe'];
    }
    echo json_encode($arr);
    mysqli_close($con);
}
?>



