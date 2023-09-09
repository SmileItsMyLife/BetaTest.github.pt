<?php
    include('ConnectBD.php');
    include('validation.php');

    session_start();

    $user = $_POST['username'];
    $pass = $_POST['password'];

    $sql = "SELECT username, pass FROM utilizadores WHERE username = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $user);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (!$result) {
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        header('location: sign-in.php?1');
        exit;
    
    }else {
        $row = mysqli_fetch_assoc($result);
        if ($row) {
            $bd_pass = $row['pass'];
            if (password_verify($pass, $bd_pass)) {
                $_SESSION['entrada'] = $user;
                $_SESSION['entrada_pass'] = $pass;
                if ($user == 'admin'){
                    $_SESSION['entrada'] = 'admin';
                }
                mysqli_stmt_close($stmt);
                mysqli_close($conn);
                header("location: ../index.php");
                exit;
            } else {
                mysqli_stmt_close($stmt);
                mysqli_close($conn);
                header("location: ../sign-in.php?2");
                exit;
            }
        } else {
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
            header("location: ../sign-in.php?3");
            exit;
        }
    }
?>