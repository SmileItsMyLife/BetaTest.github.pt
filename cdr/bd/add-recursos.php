<?php
include('ConnectBD.php');

// Инициализация сессии
session_start();

// Проверяем, была ли отправлена форма
if (isset($_POST['titlo']) && isset($_POST['coment']) && isset($_POST['disciplina'])) {
    // Получаем значения полей формы
    $titlo = $_POST['titlo'];
    $coment = $_POST['coment']; // Путь к загруженному файлу на сервере
    $disciplinas = $_POST['disciplina']; // Массив выбранных идентификаторов дисциплин

    // Получаем имя пользователя
    $username = $_SESSION['entrada'];

    // Получаем текущую дату и время в формате MySQL
    $data_time_r = date('Y-m-d H:i:s');

    // Подготавливаем SQL-запрос
    $sql1 = "INSERT INTO recursos (username_autor, titlo, coment, data_time_r) VALUES (?, ?, ?, ?)";
    $stmt1 = $conn->prepare($sql1);
    $stmt1->bind_param("ssss", $username, $titlo, $coment, $data_time_r);

    // Выполняем запрос
    if ($stmt1->execute()) {
        // Получаем идентификатор последней вставленной записи
        $id_recursos = $stmt1->insert_id;

        // Регистрируем выбранные идентификаторы дисциплин
        foreach ($disciplinas as $id_disciplina) {
            $sql2 = "INSERT INTO recursos_disciplina (id_recursos, id_disciplina) VALUES (?, ?)";
            $stmt2 = $conn->prepare($sql2);
            $stmt2->bind_param("ii", $id_recursos, $id_disciplina);
            $stmt2->execute();
            $stmt2->close();
        }

        echo "Данные успешно добавлены в базу данных.";
        header('location: ../recursos.php');
    } else {
        echo "Произошла ошибка при добавлении данных в базу данных.";
    }

    // Закрываем соединение с базой данных
    $stmt1->close();
    $conn->close();
} else {
    header("location: ../recursos.php");
}
?>
