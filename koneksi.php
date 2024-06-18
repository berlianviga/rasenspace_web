<?php
    $con = mysqli_connect("localhost:3367","root","","rasenspace");

    if(mysqli_connect_errno()){
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        exit();
    }
?>