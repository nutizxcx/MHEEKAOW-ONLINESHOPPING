<?php
    
    function openCon(){
        $dbhost = "localhost";
        $dbuser = "root";
        $dbpass = "";
        $dbname = "db_project";
        $connection = new mysqli($dbhost, $dbuser, $dbpass, $dbname)
            or die("Connect failed: %s\n". $connection -> error);
        return $connection;
    }

    function closeCon($connection){
        $connection -> close();
    }

    function getName(){
        session_start();
        $connection = openCon();
        $result = mysqli_query($connection, 
            "SELECT FirstName, LastName 
            FROM staff 
            WHERE staffID = ".$_SESSION["staffID"]);
        while($row = mysqli_fetch_array($result)) {
            $name = $row['FirstName']." ".$row['LastName'];
        }
        closeCon($connection);
        echo $name;
    }
  
  ?>