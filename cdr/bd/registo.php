<?php
    include('ConnectBD.php');
if (isset($_POST['username']) && isset($_POST['nick']) && isset($_POST['password']) && isset($_POST['password2']) && isset($_POST['email']) && isset($_POST['escola']) && isset($_POST['group'])){  
    $user = $_POST['username'];
    $nick = $_POST['nick'];
    $pass = $_POST['password'];
    $pass2 = $_POST['password2'];
    $email = $_POST['email'];
    $escola = $_POST['escola'];
    $group = $_POST['group'];
    // Verificar se as senhas fornecidas correspondem
    if (($pass === $pass2) && (strlen($pass) >= 8)) {
        // Verificar se o nome de usuário já existe no banco de dados
        $existe = "SELECT * FROM utilizadores WHERE username = ?";
        $stmt = mysqli_prepare($conn, $existe);
        mysqli_stmt_bind_param($stmt, "s", $user);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_num_rows($result);

        if ($row > 0) {
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
            header('Location: sing-up.php?1');
            exit;
        } else {
            $existe = "SELECT * FROM utilizadores WHERE email = ?";
            $stmt = mysqli_prepare($conn, $existe);
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $row2 = mysqli_num_rows($result);
            if ($row2 > 0){
                mysqli_stmt_close($stmt);
                mysqli_close($conn);
                header('Location: sing-up.php?2');
                exit;
            } else {
                // Criar o hash da senha
                $hashedPass = password_hash($pass, PASSWORD_DEFAULT);
                echo ($hashedPass);
                
                // Inserir o novo usuário no banco de dados
                $insere_utilizador = "INSERT INTO `utilizadores` (`username`, `nick`, `pass`, `email`, `id_escola`, `id_grupo`) VALUES (?, ?, ?, ?, ?, ?)";

                $stmt = mysqli_prepare($conn, $insere_utilizador);
                if ($stmt){
                    mysqli_stmt_bind_param($stmt, "ssssii", $user, $nick, $hashedPass, $email, $escola, $group);
                    $addicionamento = mysqli_stmt_execute($stmt);
                    echo($hashedPass);

                    if ($addicionamento) {
                        mysqli_stmt_close($stmt);
                        mysqli_close($conn);
                        header('Location: ../sing-in.php');
                        exit;
                    } else {
                        mysqli_stmt_close($stmt);
                        mysqli_close($conn);
                        header('Location: error.php');
                        exit;
                    }
                } else {
                    echo"Erro de statement. ERRO003";
                }
            }
        }
    } else {
        if (!strlen($pass) >= 8){
            header('Location: sing-up.php?3');
        } 
        if ($pass2 != $pass) {
            header('Location: sing-up.php?4');
        }    
        exit;
    }
} else {
    echo"Perde de dados! Erro#004";
}
?>