<?php

    $servername = "sql6.freemysqlhosting.net";
    $username = "sql6445708";
    $password = "yePLAjVn4n";
    $dbname = "sql6445708";

    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    mysqli_set_charset($conn, 'UTF8');
    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

?>