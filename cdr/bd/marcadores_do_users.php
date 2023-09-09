<?php
include('ConnectBD.php');

$username = $_POST['user_id'];
$topicId = $_POST['topic_id'];

// Проверьте, избрана ли уже эта тема пользователем
$sql = "SELECT * FROM marcadores_do_utilizadores WHERE user_id = '$username' AND topic_id = '$topicId'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Тема уже избрана, удалите ее из избранных
    $sql = "DELETE FROM marcadores_do_utilizadores WHERE user_id = '$username' AND topic_id = '$topicId'";
} else {
    // Тема еще не избрана, добавьте ее в избранные
    $sql = "INSERT INTO marcadores_do_utilizadores (user_id, topic_id) VALUES ('$username', '$topicId')";
}

if ($conn->query($sql) === TRUE) {
    echo "Запись успешно добавлена/удалена";
} else {
    echo "Ошибка: " . $conn->error;
}

$conn->close();
?>