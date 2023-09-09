<?php
include('ConnectBD.php');

function getAllDataFromDB($conn) {
    $data = array();

    $sql = "SELECT * FROM atividades LEFT OUTER JOIN utilizadores ON atividades.username_autor = utilizadores.username";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            // Получение данных из базы данных
            $nick = utf8_encode(mb_convert_encoding($row['nick'], 'ISO-8859-1', 'UTF-8'));
            $username_autor = utf8_encode(mb_convert_encoding($row['username'], 'ISO-8859-1', 'UTF-8'));
            $id = $row['id'];
            $plan = $row['planificacao'];
            $present = $row['presentacao'];
            $titlo = $row['titlo'];
            $descricao = $row['descricao'];
            $date_time = $row['date_time'];//atividades datE

            $userAvatar = 'img/defolt-avatar.jpg'; // Путь к дефолтной аватарке

            if ($row['image_data']) {
                // Если есть изображение, используем его
                $userAvatar = 'data:image/jpeg;base64,' . base64_encode($row['image_data']);
            }
            


            // Показывает всё из Disciplina
            $list_dis = " ";
            $sql3 = "SELECT nome_disciplina FROM atividade_disciplina RIGHT JOIN disciplina ON atividade_disciplina.id_disciplina = disciplina.id_disciplina WHERE atividade_disciplina.id_atividade = ?";
            $stmt3 = $conn->prepare($sql3);
            $stmt3->bind_param("s", $id);
            $stmt3->execute();
            $result3 = $stmt3->get_result();

            if ($result3->num_rows > 0) {
                while ($row3 = $result3->fetch_assoc()) {
                    $list_dis .= $row3['nome_disciplina'] . " ";
                }
            } else {
                $list_dis = "Sem dados [Disciplina]";
            }

            // Показывает всё из Ano
            $list_anos = "Anos: ";
            $sql2 = "SELECT id_ano FROM atividade_ano WHERE atividade_ano.id_atividade = ?";
            $stmt2 = $conn->prepare($sql2);
            $stmt2->bind_param("s", $row['id']);
            $stmt2->execute();
            $result2 = $stmt2->get_result();

            if ($result2->num_rows > 0) {
                while ($row2 = $result2->fetch_assoc()) {
                    $list_anos .= $row2['id_ano'] . "º ";
                }
            } else {
                $list_anos = "Sem dados [Ano]";
            }

            // Показывает всё из Niveis	
            $list_nivel = " ";
            $sql1 = "SELECT nome_ensino FROM atividade_nivel RIGHT JOIN nivel_ensino ON atividade_nivel.id_nivel = nivel_ensino.id_ensino WHERE atividade_nivel.id_atividade = ?";
            $stmt1 = $conn->prepare($sql1);
            $stmt1->bind_param("s", $row['id']);
            $stmt1->execute();
            $result1 = $stmt1->get_result();

            if ($result1->num_rows > 0) {
                while ($row1 = $result1->fetch_assoc()) {
                    $list_nivel .= utf8_encode($row1['nome_ensino']) . " ";
                }
            } else {
                $list_nivel = "Sem dados [Niveis]";
            }

            // Показывает Дата регистраций Пользувателя [Не работает!]
            $data_time = "Sem dados [Data]";

            if ($row['data_time']) {
                $data_time = utf8_encode($row['data_time']);
            }


            $formatted_data_a = date('j F Y', strtotime($date_time));//atividade
            $formatted_data_u = date('j F Y', strtotime($data_time));//user

            $data[] = array(
                'nick' => $nick,
                'username_autor' => $username_autor,
                'id' => $id,
                'plan' => $plan,
                'present' => $present,
                'titlo' => $titlo,
                'descricao' => $descricao,
                'date_time' => $formatted_data_a,
                'list_dis' => $list_dis,
                'list_anos' => $list_anos,
                'list_nivel' => $list_nivel,
                'data_time' => $formatted_data_u,
                'avatar' => $userAvatar, // Добавляем изображение пользователя в массив
            );
        }
    }

    

    return $data;
}




?>