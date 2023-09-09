<?php
// Подключение к базе данных
session_start();
include 'ConnectBD.php';

$username = $_SESSION['entrada'];

// Обработка формы редактирования профиля
if ($_SERVER["REQUEST_METHOD"] === "POST") {

 $imageName = $_FILES['image']['name'];
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        // Получаем данные изображения
        $imageTmpName = $_FILES['image']['tmp_name'];
        $imageData = file_get_contents($imageTmpName);

        // Проверяем, удалось ли прочитать данные изображения
        if ($imageData !== false) {

            if (is_uploaded_file($imageTmpName)) {
            
                // Данные изображения доступны и могут быть сохранены в базу данных
                $sql = "SELECT * FROM utilizadores WHERE username = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("s", $username);
                $stmt->execute();
                $result = $stmt->get_result();
            
                if ($result->num_rows > 0) {
                    // Обновляем изображение для указанного пользователя
                    $sql = "UPDATE utilizadores SET image_name = ?, image_data = ? WHERE username = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("sss", $imageName, $imageData, $username);
                    $stmt->execute();
            
                    if ($stmt->affected_rows > 0) {
                        echo "Изображение успешно сохранено для пользователя: " . $username;
                        header('location: ../profile.php');
                    } else {
                        echo "Ошибка при сохранении изображения.";
                        header('location: ../profile.php');
                    }
                } else {
                    echo "Пользователь с именем " . $username . " не найден.";
                }
            
                // Закрываем подготовленное выражение
                $stmt->close();

            }else{
                echo "Ошибка при загрузке изображения.";
            }

        } else {
            echo "Ошибка при чтении данных изображения.";
        }
    } else {
        header("location: error.php");
    }


    $stmt->close();
}
$conn->close();
?>
