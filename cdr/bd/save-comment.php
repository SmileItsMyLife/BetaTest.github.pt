<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include 'ConnectBD.php';

    // Получаем комментарий из формы
    $id_atividade = $_POST['id_atividade'];
    $comment = $_POST['comment'];

    // Проверяем, зашел ли пользователь
    if (isset($_SESSION['entrada']) && !empty($_SESSION['entrada'])) {
        // Если пользователь авторизован, используем его имя из сессии
        $username = $_SESSION['entrada'];
    } else {
        // Если пользователь не авторизован, используем введенное им самим имя
        $username = $_POST['username'];
    }

    // Получаем текущую дату и время
    $currentDateTime = date('Y-m-d H:i:s');

    // Подготавливаем запрос с подготовленным оператором
    $sql = "INSERT INTO atividade_comentarios (id_atividade, username, comment, date_time) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    // Привязываем параметры к подготовленному оператору
    $stmt->bind_param("isss", $id_atividade, $username, $comment, $currentDateTime);

    // Выполняем запрос
    if ($stmt->execute()) {
        echo 'Комментарий успешно добавлен.';
    } else {
        echo 'Ошибка: ' . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
