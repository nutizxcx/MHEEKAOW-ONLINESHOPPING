<?php include "connectdb.php";?>

 <?php
    $addimage = $_POST["addimage"];

    $check= "SELECT MAX(ImageNO)
            FROM image
            WHERE ProductID = "ProductID"";
    $que=mysqli_query($conn,$check);
    $last=mysqli_fetch_array($que);

    if ($last['MAX(ImageNO)'] == NULL) {
        $maximage = 1;
    }
    else {
        $maximage = $last['MAX(ImageNO)']+1;
    }

    $insert="INSERT INTO image
                    VALUES ('$productid','$maximage','$sku','$addimage')";
            $result=$conn->query($insert);

 ?>

<?php mysqli_close($conn); ?>