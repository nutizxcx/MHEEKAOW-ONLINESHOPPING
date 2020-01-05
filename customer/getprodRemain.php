<?php 

    $id = $_GET['reqID'];
    $color = $_GET['reqColor'];

    $con = mysqli_connect('localhost','root','','db_project');
    
    $sql = "SELECT Remain FROM remain WHERE "

?>