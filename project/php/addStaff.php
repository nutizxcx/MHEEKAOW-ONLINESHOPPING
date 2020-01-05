<!DOCTYPE html>
<html>
<head>
  <title>Add New Staff</title>
</head>
<body>
  <?php
    $con = mysqli_connect("localhost", "root", "", "lab7_staff");
    if (mysqli_connect_errno()) {
      echo "Failed to connect to MySQL:" .mysqli_connect_errno();
    }
    else {
      echo "Welcome";
    }
  ?>
</body>
</html>
