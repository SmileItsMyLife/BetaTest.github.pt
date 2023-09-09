<?php
include '../ConnectBD.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Получаем данные из формы
    $newTitle = $_POST['newTitle'];
    $id_dis = $_POST['id_dis'];

    // Выполняем SQL-запрос для обновления названия дисциплины по указанному ID
    $sql = "UPDATE disciplina SET nome_disciplina = '$newTitle' WHERE id_disciplina = $id_dis";

    if (mysqli_query($conn, $sql)) {
        // Успешно обновили запись
        echo "Изменения сохранены";
        var_dump($newTitle, $id_dis);
        header('location: ../../admin-page.php?loh');
    } else {
        // Произошла ошибка при выполнении запроса
        echo "Ошибка: " . mysqli_error($conn);
    }

    // Закрываем подключение к БД
    mysqli_close($conn);
}
?>
