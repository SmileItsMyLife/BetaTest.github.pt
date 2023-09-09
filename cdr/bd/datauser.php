<?php
include('ConnectBD.php');

function getUserData($conn, $username) {
    $userData = array();

    // Проверка, что переданное имя пользователя не пустое
    if (isset($username) && !empty($username)) {
        // Запрос информации о пользователе из таблицы utilizadores
        $sql = "SELECT id_user, username, nick, email, image_data, image_name, data_time FROM utilizadores WHERE username = ?";
        $stmt = $conn->prepare($sql);
        if ($stmt) {
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $result = $stmt->get_result();
            
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $userData['id_user'] = $row['id_user'];
                $userData['username'] = $row['username'];
                $userData['nick'] = $row['nick'];
                $userData['email'] = $row['email'];

                // Получение аватарки пользователя или дефолтной аватарки
                if ($row['image_data']) {
                    // Если есть изображение, используем его
                    $userData['avatar'] = 'data:image/jpeg;base64,' . base64_encode($row['image_data']);
                } else {
                    // Если у пользователя нет аватарки, используем дефолтную аватарку
                    $userData['avatar'] = 'img/defolt-avatar.jpg';
                }

                $userData['data_time'] = $row['data_time'];
            } else {
                $userData['error_message'] = "Usuário não encontrado!";
            }
            $stmt->close();
        } else {
            $userData['error_message'] = "Ocorreu um erro ao processar a consulta!";
        }
    } else {
        $userData['error_message'] = "Nome de usuário não fornecido!";
    }

    // Запрос информации о группе пользователя
    $userData = getGroupData($conn, $userData, $username);

    $userData = getEscolaData($conn, $userData, $username);

    // Запрос информации об уровне образования пользователя
    $userData = getNivelData($conn, $userData, $username);

    // Запрос информации об активностях пользователя
    $userData = getActivityData($conn, $userData);

    return $userData;
}

function getGroupData($conn, $userData, $username) {
    $sql = "SELECT grupo.nome_grupo, grupo.cod_grupo FROM grupo LEFT JOIN utilizadores ON grupo.id_grupo = utilizadores.id_grupo WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $userData['nome_grupo'] = $row['nome_grupo'];
        $userData['cod_grupo'] = $row['cod_grupo'];
    } else {
        $userData['error_message'] = "Ocorreu um erro ao obter informações sobre a grupo!";
    }
    
    $stmt->close();

    return $userData;
}

function getEscolaData($conn, $userData, $username){
    $sql = "SELECT escola.nome_escola FROM escola LEFT JOIN utilizadores ON escola.id_escola = utilizadores.id_escola WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $userData['nome_escola'] = $row['nome_escola'];
    } else {
        $userData['nome_escola'] = "Ocorreu um erro!";
    }

    $stmt->close();

    return $userData;
}

function getNivelData($conn, $userData, $username) {
    $userData['nome_ensino'] = "Níveis de ensino: ";
    $sql = "SELECT atividade_nivel.id_atividade, nivel_ensino.nome_ensino FROM atividade_nivel RIGHT JOIN nivel_ensino ON atividade_nivel.id_nivel = nivel_ensino.id_ensino WHERE atividade_nivel.id_atividade = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $userData['id_user']);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $userData['nome_ensino'] .= utf8_encode($row['nome_ensino']) . " ";
        }
    } else {
        $userData['nome_ensino'] = "Os dados de ensino desta atividade não foram encontrados...";
    }

    $stmt->close();

    return $userData;
}

function getActivityData($conn, $userData) {
    $sql = "SELECT * FROM atividades";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $userData['presentacao'] = $row['presentacao'];
            $userData['planificacao'] = $row['planificacao'];
            $userData['titlo'] = $row['titlo'];
            $userData['descricao'] = $row['descricao'];
            // Здесь можно получить доступ к другим полям активности, например, $row['id'], $row['username'], $row['presentacao'], $row['planificacao']
        }
    }
    
    $stmt->close();

    return $userData;
}


//Registro
function getSchoolDataForSignUp($conn) {
    $schools = array();

    $result = mysqli_query($conn, "SELECT id_escola,  nome_escola FROM escola");
    while ($row = mysqli_fetch_assoc($result)){
        $schools[] = $row;
    }

    return $schools;
}

function getGroupDataForSignUp($conn) {
    $groups = array();

    $result = mysqli_query($conn, "SELECT nome_grupo, id_grupo, cod_grupo FROM grupo");
    while ($row = mysqli_fetch_assoc($result)){
        $groups[] = $row;
    }

    return $groups;
}

//Atividades


?>

