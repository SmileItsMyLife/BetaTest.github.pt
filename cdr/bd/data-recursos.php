<?php
include('ConnectBD.php');

function getRecursosData($conn) {
    $recursosData = array();

    // Запрос к базе данных для получения данных о ресурсах и их авторах
    $sql = "SELECT * FROM recursos LEFT OUTER JOIN utilizadores ON recursos.username_autor = utilizadores.username";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            // Получение данных из базы данных
            $id = $row['id'];
            $titlo = utf8_encode(mb_convert_encoding($row['titlo'], 'ISO-8859-1', 'UTF-8'));
            $coment = utf8_encode(mb_convert_encoding($row['coment'], 'ISO-8859-1', 'UTF-8'));
            $file = $row['file'];
            $data_time_r = $row['data_time_r'];

            $nick = utf8_encode(mb_convert_encoding($row['nick'], 'ISO-8859-1', 'UTF-8'));
            $username_autor = utf8_encode(mb_convert_encoding($row['username'], 'ISO-8859-1', 'UTF-8'));

            $list_dis = " ";
            $sql3 = "SELECT nome_disciplina FROM recursos_disciplina RIGHT JOIN disciplina ON recursos_disciplina.id_disciplina = disciplina.id_disciplina WHERE recursos_disciplina.id_recursos = ?";
            $stmt3 = $conn->prepare($sql3);
            $stmt3->bind_param("s", $id);
            $stmt3->execute();
            $result3 = $stmt3->get_result();

            if ($result3->num_rows > 0) {
                while ($row3 = $result3->fetch_assoc()) {
                    $list_dis .= $row3['nome_disciplina'] . " ";
                }
            } else {
                $list_dis = "Os dados de disciplinas desta recursos não foram encontrados...";
            }

            $formatted_data_r = date('j F Y', strtotime($data_time_r));//atividade    

            // Показ аватарки пользователя
            $userAvatar = 'img/defolt-avatar.jpg'; // Путь к дефолтной аватарке

            if ($row['image_data']) {
                // Если есть изображение, используем его
                $userAvatar = 'data:image/jpeg;base64,' . base64_encode($row['image_data']);
            }

            // Добавление данных в массив
            $recursosData[] = array(
                'id' => $id,
                'titlo' => $titlo,
                'coment' => $coment,
                'file' => $file,
                'nick' => $nick,
                'data_time' => $formatted_data_r,
                'username_autor' => $username_autor,
                'list_dis' => $list_dis,
                'avatar' => $userAvatar, // Добавляем изображение пользователя в массив
            );
        }

        mysqli_free_result($result);
    }

    return $recursosData;
}

function fetchDisciplinaData($conn) {
    $result = mysqli_query($conn, "SELECT id_disciplina, nome_disciplina FROM disciplina ORDER BY `disciplina`.`id_disciplina` ASC");
    $disciplinaData = array();

    if ($result) {
        foreach ($result as $row) {
            $id_disciplina = $row['id_disciplina'];
            $nome_disciplina = utf8_encode(mb_convert_encoding($row['nome_disciplina'], 'ISO-8859-1', 'UTF-8'));

            $disciplina = array(
                'id_disciplina' => $id_disciplina,
                'nome_disciplina' => $nome_disciplina,
            );

            $disciplinaData[] = $disciplina;
        }
    }

    return $disciplinaData;
}


?>