<?php
function getUsersData($conn) {
    $query = "SELECT * FROM utilizadores";
    $usersData = array();

    $result = mysqli_query($conn, $query);
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $user = array(
                'id' => $row['id_user'],
                'username' => utf8_encode(mb_convert_encoding($row['username'], 'ISO-8859-1', 'UTF-8')),
                'nick' => utf8_encode(mb_convert_encoding($row['nick'], 'ISO-8859-1', 'UTF-8')),
                'email' => $row['email'],
                'pass' => $row['pass'],
            );

            $usersData[] = $user;
        }
        mysqli_free_result($result);
    }

    return $usersData;
}

// Использование функции
$users = getUsersData($conn);
foreach ($users as $user) {
    $id = $user['id'];
    $username = $user['username'];
    $nick = $user['nick'];
    $email = $user['email'];
    $pass = $user['pass'];

    // Здесь можно производить дополнительные действия с данными пользователя, если необходимо
    // ...
}

//Показывает все уроки
function getDisciplinas($conn) {
    $query = "SELECT id_disciplina, nome_disciplina FROM disciplina";
    $disciplinasData = array();

    $result = mysqli_query($conn, $query);
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $disciplina = array(
                'id_dis' => $row['id_disciplina'],
                'nome_dis' => $row['nome_disciplina'],
            );

            $disciplinasData[] = $disciplina;
        }
        mysqli_free_result($result);
    }

    return $disciplinasData;
}

//Показывает все группы
function getGrupos($conn) {
    $sql = "SELECT id_grupo, cod_grupo, nome_grupo FROM grupo";
    $query = mysqli_query($conn, $sql);

    $grupos = array();

    if (mysqli_num_rows($query) > 0) {
        while ($row = mysqli_fetch_assoc($query)) {
            $grupo = array(
                'id_grupo' => $row['id_grupo'],
                'cod_grupo' => $row['cod_grupo'],
                'nome_grupo' => $row['nome_grupo']
            );
            $grupos[] = $grupo;
        }
    }

    return $grupos;
}

function getGruposUP($conn) {
    // ... другие части функции ...

    $sql = "SELECT id_disciplina, id_ano, id_ensino FROM disciplina_ano";
    $query = mysqli_query($conn, $sql);

    if (mysqli_num_rows($query) > 0) {
        while ($row = mysqli_fetch_assoc($query)) {
            $grupoup = array(
                'id_disciplina' => $row['id_disciplina'],
                'id_ano' => $row['id_ano'],
                'id_ensino' => $row['id_ensino']
            );
            $gruposup[] = $grupoup;
        }
    }
    return $gruposup;
}

function getEscolas($conn) {
    // ... другие части функции ...

    $sql = "SELECT id_escola, nome_escola FROM escola";
    $query = mysqli_query($conn, $sql);

    if (mysqli_num_rows($query) > 0) {
        while ($row = mysqli_fetch_assoc($query)) {
            $escola = array(
                'id_escola' => $row['id_escola'],
                'nome_escola' => $row['nome_escola']
            );
            $escolas[] = $escola;
        }
    }
    return $escolas;
}

// Использование функции
$disciplinas = getDisciplinas($conn);
foreach ($disciplinas as $disciplina) {
    $id_dis = $disciplina['id_dis'];
    $nome_dis = $disciplina['nome_dis'];
}




?>