<?php
include '../ConnectBD.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Получаем идентификатор (ID) записи, которую нужно удалить
    $id_dis = $_POST['id_dis'];

    // Выполняем SQL-запрос для удаления записи по указанному ID
    $sql = "DELETE FROM disciplina WHERE id_disciplina = $id_dis";

    if (mysqli_query($conn, $sql)) {
        // Успешно удалили запись
        echo "Запись удалена";
        var_dump($id_dis);
        header('location: ../../admin-page.php?succes-del-dis');
    } else {
        // Произошла ошибка при выполнении запроса
        echo "Ошибка: " . mysqli_error($conn);
    }

    // Закрываем подключение к БД
    mysqli_close($conn);
}

?>