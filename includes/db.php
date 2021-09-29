<?php

    $servername = "sql6.freemysqlhosting.net";
    $username = "sql6441134";
    $password = "kEdKPvNGTY";
    $dbname = "sql6441134";

    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    mysqli_set_charset($conn, 'UTF8');
    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

?>