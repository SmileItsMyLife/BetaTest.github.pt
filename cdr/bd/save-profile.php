<?php
// Подключение к базе данных
session_start();
include 'ConnectBD.php';
include 'datauser.php';

$username = $_SESSION['entrada'];
$userData = getUserData($conn, $username);

// Обработка формы редактирования профиля
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $nick = $_POST["nick"];
    $escola = $_POST["escola"];
    $group = $_POST["group"];


    // Проверка корректности введенных данных, например, что поля не пустые
    if (empty($username) || empty($email) || empty($nick)) {
        $updateError = "Пожалуйста, заполните все обязательные поля.";
    }

    if (empty($escola)) {
      $escola = $currentEscolaId;
    }

    if (empty($group)) {
        $group = $currentGroupId;
    }

    // Запрос на обновление данных профиля в таблице utilizadores
    $stmt = $conn->prepare("UPDATE utilizadores SET username = ?, email = ?, nick = ?, id_escola = ?, id_grupo = ? WHERE id_user = ?");

    
    $stmt->bind_param("sssiii", $username, $email, $nick, $escola, $group, $userData['id_user']);



    if ($stmt->execute()) {
        // Данные успешно обновлены, перезагружаем страницу, чтобы увидеть обновленную информацию
        header("Location: ../profile.php");
        exit();
    } else {
        $updateError = "Ошибка при обновлении профиля: " . $stmt->error;
        // Добавьте отладочный вывод для отслеживания ошибки
        // var_dump($stmt->error);
    }

    $stmt->close();
}
$conn->close();
?>
