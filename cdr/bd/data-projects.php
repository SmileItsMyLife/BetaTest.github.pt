<?php
function getRecursosByUser($conn, $username) {
    $recursosData = array();

    $sql = "SELECT * FROM recursos LEFT OUTER JOIN utilizadores ON recursos.username_autor = utilizadores.username WHERE recursos.username_autor = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $recursos = array(
                'id' => $row['id'],
                'titulo' => $row['titlo'],
                'comentario' => $row['coment'],
                // Добавьте другие поля, которые вам нужны
            );

            // Добавление данных по дисциплинам
            $list_dis = "";
            $sql3 = "SELECT nome_disciplina FROM recursos_disciplina RIGHT JOIN disciplina ON recursos_disciplina.id_disciplina = disciplina.id_disciplina WHERE recursos_disciplina.id_recursos = ?";
            $stmt3 = $conn->prepare($sql3);
            $stmt3->bind_param("s", $recursos['id']);
            $stmt3->execute();
            $result3 = $stmt3->get_result();

            if ($result3->num_rows > 0) {
                while ($row3 = $result3->fetch_assoc()) {
                    $list_dis .= $row3['nome_disciplina'] . " ";
                }
            } else {
                $list_dis = "Os dados de disciplinas desta atividade não foram encontrados...";
            }

            $recursos['disciplinas'] = $list_dis;

            $recursosData[] = $recursos;
        }
    } else {
        return false;
    }

    return $recursosData;
}


function getAtividadesByUser($conn, $username) {
    $atividadesData = array();

    $sql = "SELECT * FROM atividades LEFT JOIN utilizadores ON atividades.username_autor = utilizadores.username WHERE atividades.username_autor = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $atividades = array(
                'id' => $row['id'],
                'titulo' => $row['titlo'], // Исправлено "titlo" на "titulo"
                'descricao' => $row['descricao'],
                // Добавьте другие поля, которые вам нужны
            );

            // Добавление данных по дисциплинам
            $list_dis = "";
            $sql3 = "SELECT nome_disciplina FROM atividade_disciplina RIGHT JOIN disciplina ON atividade_disciplina.id_disciplina = disciplina.id_disciplina WHERE atividade_disciplina.id_atividade = ?";
            $stmt3 = $conn->prepare($sql3);
            $stmt3->bind_param("s", $atividades['id']);
            $stmt3->execute();
            $result3 = $stmt3->get_result();

            if ($result3->num_rows > 0) {
                while ($row3 = $result3->fetch_assoc()) {
                    $list_dis .= $row3['nome_disciplina'] . " ";
                }
            } else {
                $list_dis = "Os dados de disciplinas desta atividade não foram encontrados...";
            }

            $list_anos = "Anos: ";
            $sql2 = "SELECT id_ano FROM atividade_ano WHERE atividade_ano.id_atividade = ?";
            $stmt2 = $conn->prepare($sql2);
            $stmt2->bind_param("s", $atividades['id']);
            $stmt2->execute();
            $result2 = $stmt2->get_result();

            if ($result2->num_rows > 0) {
                while ($row2 = $result2->fetch_assoc()) {
                    $list_anos .= $row2['id_ano'] . "º ";
                }
            } else {
                $list_anos = "Sem dados [Ano]";
            }

            $list_nivel = "Níveis de ensino: ";
            $sql1 = "SELECT nome_ensino FROM atividade_nivel RIGHT JOIN nivel_ensino ON atividade_nivel.id_nivel = nivel_ensino.id_ensino WHERE atividade_nivel.id_atividade = ?";
            $stmt1 = $conn->prepare($sql1);
            $stmt1->bind_param("s", $atividades['id']);
            $stmt1->execute();
            $result1 = $stmt1->get_result();

            if ($result1->num_rows > 0) {
                while ($row1 = $result1->fetch_assoc()) {
                    $list_nivel .= utf8_encode($row1['nome_ensino']) . " ";
                }
            } else {
                $list_nivel = "Sem dados [Niveis]";
            }

            $atividades['nome_ensino'] = $list_nivel;

            $atividades['id_ano'] = $list_anos;

            $atividades['disciplinas'] = $list_dis;

            $atividadesData[] = $atividades;
        }
    } else {
        return false;
    }

    return $atividadesData;
}

?>
