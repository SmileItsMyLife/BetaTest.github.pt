<?php include 'other/navbar.php';
  include 'bd/ap/user-base.php';
  ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Просмотр профиля</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<?php if (isset($_GET['username']) && !empty($_GET['username'])) {
    $username = $_GET['username'];

    $sql = "SELECT * FROM utilizadores WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username); 
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $user_data = $result->fetch_assoc();
        $imageData = $user_data['image_data'];
        $data_time = $user_data['data_time'];
        $nick = $user_data['nick'];
        $email = $user_data['email'];

        $formatted_data = date('j F Y', strtotime($data_time));

        $sql_info = "SELECT atividades.id, atividades.titlo, atividades.descricao, atividades.date_time, utilizadores.username, 
        (SELECT GROUP_CONCAT(DISTINCT disciplina.nome_disciplina SEPARATOR ', ') 
            FROM atividade_disciplina 
            INNER JOIN disciplina ON atividade_disciplina.id_disciplina = disciplina.id_disciplina 
            WHERE atividade_disciplina.id_atividade = atividades.id) AS disciplinas,
        (SELECT GROUP_CONCAT(DISTINCT nivel_ensino.nome_ensino SEPARATOR ', ') 
            FROM atividade_nivel 
            INNER JOIN nivel_ensino ON atividade_nivel.id_nivel = nivel_ensino.id_ensino 
            WHERE atividade_nivel.id_atividade = atividades.id) AS niveis,
        (SELECT GROUP_CONCAT(DISTINCT atividade_ano.id_ano SEPARATOR ', ') 
            FROM atividade_ano 
            WHERE atividade_ano.id_atividade = atividades.id) AS anos
        FROM atividades
        INNER JOIN utilizadores ON atividades.username_autor = utilizadores.username
        WHERE atividades.username_autor = ?";

        $stmt_info = $conn->prepare($sql_info);
        $stmt_info->bind_param("s", $username);
        $stmt_info->execute();
        $result_info = $stmt_info->get_result();
         ?>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-4">
        <div class="card">
            <img src="data:image/jpeg;base64,<?= base64_encode($imageData) ?>" class="card-img-top" alt="Профиль">
            <div class="card-body">
            <h5 class="card-title">Имя пользователя <?= $username ?></h5>
            <p class="card-text">Описание пользователя и дополнительная информация здесь.</p>
            <div class="d-flex">

                    <button type="button" class="btn btn-secondary me-2" id="friendButton">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-plus" viewBox="0 0 16 16">
                            <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"></path>
                            <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z"></path>
                        </svg>
                    </button>

                <a href="#" class="btn btn-primary me-2">Facebook</a>
                <a href="#" class="btn btn-secondary">Twitter</a>
            </div>
            </div>
        </div>
        <!-- <div class="card mt-4">
            <div class="card-body">
                <h3>Действия для админов</h3>
                <p class="mb-0">Последняя активность: 10.08.2023</p>
                <div class="d-flex">
                    <a href="#" class="btn btn-danger me-2">Удалить</a>
                    <a href="#" class="btn btn-warning me-2">Предупреждение</a>
                    <a href="#" class="btn btn-dark me-2">Забанить</a>
                </div>
            </div>
        </div> -->
        </div>
        
        <div class="col-md-8">
        <h2>Информация о профиле</h2>
        <p>Здесь вы можете увидеть дополнительную информацию о пользователе:</p>
        <ul class="list-group mb-3">
            <li class="list-group-item">Имя: <?= $nick ?></li>
            <li class="list-group-item">Школа: ''</li>
            <li class="list-group-item">Группа: ''</li>
            <li class="list-group-item">Email: <?= $email ?></li>
            <li class="list-group-item">Дата регистрации: <?= $data_time ?></li>
            <li class="list-group-item">Последняя активность: ''</li>
        </ul>
        <h3>Созданные темы</h3>
        <?php 
        if ($result_info->num_rows > 0) {
            while ($row_info = $result_info->fetch_assoc()) {
                $id = $row_info['id'];
                $titlo = $row_info['titlo'];
                $descricao = $row_info['descricao'];
                $disciplinas = $row_info['disciplinas'];
                $date_time = $row_info['date_time'];//Atividades
                $niveis = utf8_encode($row_info['niveis']);
                $anos = $row_info['anos'];
                
                $formatted_date = date('j F Y', strtotime($date_time));//atividade
             ?>
        <ul class="list-group">
            <li class="list-group-item mt-2">
                <div class="d-flex text-body-secondary pt-3">
                    <img src="data:image/jpeg;base64,<?= base64_encode($imageData) ?>" alt="User Avatar" class="bd-placeholder-img flex-shrink-0 me-2 rounded" width="32" height="32">
                    <div class="pb-3 mb-0 small lh-sm border-bottom w-100">
                        <div class="d-flex justify-content-between">
                            <strong class="text-gray-dark"><?= $titlo ?></strong>
                        </div>
                        <div class="d-flex justify-content-between">
                        <span class="text-gray-dark" style="max-width: 100%; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                            <?= $descricao ?>
                        </span>
                        </div><br>

                        <span class="badge text-bg-primary">
                        <?= $disciplinas ?>
                        </span>
                        <span class="badge text-bg-success">
                        <?= $niveis ?>
                        </span>     
                        <span class="badge text-bg-danger">
                        <?= $anos ?>
                        </span><br>
                        <span class="text-gray-dark"><?= $formatted_date ?></span>
                        <!-- View -->
                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                            <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                            <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                          </svg>
                            0
                        <!-- Comments -->
                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chat" viewBox="0 0 16 16">
                            <path d="M2.678 11.894a1 1 0 0 1 .287.801 10.97 10.97 0 0 1-.398 2c1.395-.323 2.247-.697 2.634-.893a1 1 0 0 1 .71-.074A8.06 8.06 0 0 0 8 14c3.996 0 7-2.807 7-6 0-3.192-3.004-6-7-6S1 4.808 1 8c0 1.468.617 2.83 1.678 3.894zm-.493 3.905a21.682 21.682 0 0 1-.713.129c-.2.032-.352-.176-.273-.362a9.68 9.68 0 0 0 .244-.637l.003-.01c.248-.72.45-1.548.524-2.319C.743 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7-3.582 7-8 7a9.06 9.06 0 0 1-2.347-.306c-.52.263-1.639.742-3.468 1.105z"/>
                          </svg>
                            0
                            <br>
                        <a href="topic-view-atividades.php?id=<?= $id ?>">Mais</a> 
                    </div>      
                </div>
            </li>
            <!-- Добавьте здесь дополнительные темы, если нужно -->
        </ul>
        <?php } ?>       
        </div>
    </div>
</div>

<?php  
                   
} else {
    echo "Данные о темах пользователя не найдены...";
    }
}
    }else {
        echo 'Не указан username в URL.';
    }
?>

<script>
    // Находим кнопку по ее id
const friendButton = document.getElementById('friendButton');
// Устанавливаем флаг для отслеживания состояния
let isIconChanged = false;

// Добавляем обработчик события клика на кнопку
friendButton.addEventListener('click', function() {
    // Проверяем состояние флага и меняем иконку
    if (isIconChanged) {
        friendButton.innerHTML = `
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-plus" viewBox="0 0 16 16">
                <path d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z"/>
            </svg>
        `;
    } else {
        friendButton.innerHTML = `
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-plus-fill" viewBox="0 0 16 16">
                <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7Zm1.679-4.493-1.335 2.226a.75.75 0 0 1-1.174.144l-.774-.773a.5.5 0 0 1 .708-.708l.547.548 1.17-1.951a.5.5 0 1 1 .858.514ZM11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                <path d="M2 13c0 1 1 1 1 1h5.256A4.493 4.493 0 0 1 8 12.5a4.49 4.49 0 0 1 1.544-3.393C9.077 9.038 8.564 9 8 9c-5 0-6 3-6 4Z"/>
            </svg>
        `;
    }
    // Инвертируем флаг
    isIconChanged = !isIconChanged;
});

</script>

<div class="b-example-divider mt-5" ></div>
<?php include 'other/footer.php'; ?>  
</body>
</html>


