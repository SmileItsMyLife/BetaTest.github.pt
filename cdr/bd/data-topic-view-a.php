<?php
function getRecordInfoById($conn, $id) {
    $recordData = array();

    $sql_info = "SELECT atividades.id, atividades.titlo, atividades.planificacao, atividades.presentacao, atividades.descricao, utilizadores.username, utilizadores.data_time, atividades.date_time, utilizadores.nick, utilizadores.image_data, utilizadores.email, 
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
                WHERE atividades.id = ?";

    $stmt_info = $conn->prepare($sql_info);
    $stmt_info->bind_param("i", $id);
    $stmt_info->execute();
    $result_info = $stmt_info->get_result();

    if ($result_info && $result_info->num_rows > 0) {
        $row_info = $result_info->fetch_assoc();
        $recordData['id'] = $row_info['id'];
        $recordData['titlo'] = $row_info['titlo'];
        $recordData['descricao'] = $row_info['descricao'];
        $recordData['date_time'] = $row_info['date_time'];//atividades data
        $recordData['data_time'] = $row_info['data_time'];//utilizador data
        $recordData['username'] = $row_info['username'];
        $recordData['nick'] = $row_info['nick'];
        $recordData['presentacao'] = $row_info['presentacao'];
        $recordData['planificacao'] = $row_info['planificacao'];
        $recordData['email'] = $row_info['email'];
        $recordData['disciplinas'] = $row_info['disciplinas'];
        $recordData['niveis'] = utf8_encode($row_info['niveis']);
        $recordData['anos'] = $row_info['anos'];
        $recordData['image_data'] = $row_info['image_data'];
        $recordData['formatted_data_a'] = date('j F Y', strtotime($recordData['date_time']));//atividade
        $recordData['formatted_data_u'] = date('j F Y', strtotime($recordData['data_time']));//user

        return $recordData;
    } else {
        return null; // Если запись с заданным id не найдена, вернуть null
    }
}

function fetchAtividadeComentarios($conn, $id) {
    $sql4 = "SELECT * FROM atividade_comentarios WHERE id_atividade = ?";
    $stmt4 = mysqli_prepare($conn, $sql4);
    mysqli_stmt_bind_param($stmt4, 'i', $id);
    mysqli_stmt_execute($stmt4);
    $result4 = mysqli_stmt_get_result($stmt4);
    $comentariosData = array();

    if ($result4) {
        if (mysqli_num_rows($result4) > 0) {
            while ($row4 = mysqli_fetch_assoc($result4)) {
                $user_nome = $row4['username'];
                $user_com = $row4['comment'];
                $user_date = $row4['date_time'];

                // Теперь выполним запрос для получения картинки пользователя
                $sql_user = "SELECT image_data FROM utilizadores WHERE username = ?";
                $stmt_user = mysqli_prepare($conn, $sql_user);
                mysqli_stmt_bind_param($stmt_user, 's', $user_nome);
                mysqli_stmt_execute($stmt_user);
                $result_user = mysqli_stmt_get_result($stmt_user);
                $user_row = mysqli_fetch_assoc($result_user);
                $image_data = $user_row['image_data'];

                if ($row4['id_atividade'] == $id) {
                    $comentario = array(
                        'user_nome' => $user_nome,
                        'user_com' => $user_com,
                        'user_date' => $user_date,
                        'image_data' => $image_data // Добавляем картинку пользователя в массив комментария
                    );

                    $comentariosData[] = $comentario;
                }
            }
        }
    }

    return $comentariosData;
}


// Использование функции для получения информации о записи по id
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];
    $recordInfo = getRecordInfoById($conn, $id);


} else {
    echo 'Failed.';
}
?>
