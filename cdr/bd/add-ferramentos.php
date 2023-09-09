<?php
include 'ConnectBD.php';

// Получение данных из запроса POST
$link = $_POST['link'];
$nome = $_POST['nome'];
$licencia = $_POST['licencia'];
$coment = $_POST['coment'];
$fp_1 = $_POST['fp_1'];
$fp_2 = $_POST['fp_2'];
$fp_3 = $_POST['fp_3'];

// Обработка логотипа (изображения)
$logo = file_get_contents($_FILES['logo']['tmp_name']);  // Путь к временному файлу

// Подготовьте SQL-запрос на добавление данных
$sql = "INSERT INTO ferramentos (logo, link, nome, licenca, coment, fp_1, fp_2, fp_3) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

// Подготовка выражения запроса
$stmt = $conn->prepare($sql);
$stmt->bind_param("bsssssss", $logo, $link, $nome, $licencia, $coment, $fp_1, $fp_2, $fp_3);

if ($stmt->execute()) {
    echo "Данные успешно сохранены в базе данных";
    header('location: ../ferramentos.php');
    exit();  // Остановка выполнения скрипта после успешного сохранения
} else {
    echo "Ошибка при сохранении данных: " . $stmt->error;
    exit();  // Остановка выполнения скрипта после ошибки
}

$stmt->close();
$conn->close();
?>
