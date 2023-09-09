<?php
    $conn = mysqli_connect("localhost", "root", "");
    if ($conn->connect_error){
        die("Connection failed!" . $conn->connect_error);
    } else {
        $escolherBD = mysqli_select_db($conn, "bd");
        if (!$escolherBD){
            echo "<br> Erro: Erro ao escolher a BD"; exit;
        }
    }
?>

