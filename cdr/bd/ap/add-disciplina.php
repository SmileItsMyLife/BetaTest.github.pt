<?php
include '../ConnectBD.php';

if (isset($_POST['disciplina'])){  
    $dis = $_POST['disciplina'];
    $sql = "INSERT INTO `disciplina` (`nome_disciplina`) VALUES (?)";

        $stmt = mysqli_prepare($conn, $sql);
        if ($stmt){
            mysqli_stmt_bind_param($stmt, "s", $dis);
            $addicionamento = mysqli_stmt_execute($stmt);
            echo($hashedPass);

            if ($addicionamento) {
                mysqli_stmt_close($stmt);
                mysqli_close($conn);
                header('Location: ../../admin-page.php');
                exit;
            } else {
                mysqli_stmt_close($stmt);
                mysqli_close($conn);
                header('Location: ../../admin-page.php');
                exit;
            }
        } else {
            echo"Erro de statement. ERRO003";
        }
}
?>