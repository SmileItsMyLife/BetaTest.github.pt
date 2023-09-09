<?php
include 'ConnectBD.php';

function updateAtividade($id, $newTitle, $newComment) {
    global $conn;

    // Подготовьте SQL-запрос на обновление данных с использованием параметров
    $sql = "UPDATE atividades SET titlo=?, descricao=? WHERE id=?";

    // Подготовка выражения запроса
    $stmt = $conn->prepare($sql);

    // Привязка параметров к выражению запроса
    $stmt->bind_param("ssi", $newTitle, $newComment, $id);

    // Выполнение запроса
    if ($stmt->execute()) {
        echo "Данные успешно сохранены в базе данных";
        header("Location: ../topic-view-atividades.php?id=" . $id);
        echo $id;
    } else {
        echo "Ошибка при сохранении данных: " . $stmt->error;
        header("location:../atividades.php");
    }

    // Закрытие выражения запроса
    $stmt->close();
    $conn->close();
}

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];
    $newTitle = $_POST['newTitle'];
    $newComment = $_POST['newComment'];
    updateAtividade($id, $newTitle, $newComment);


} else {
    echo 'Failed.';
}
?>
