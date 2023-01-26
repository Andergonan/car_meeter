<?php
    $conn = mysqli_connect("localhost", "root", "", "car_meeter");
    if (mysqli_connect_errno()) {
        exit('Failed to connect to MySQL: ' . mysqli_connect_error());
    }
?>