<?php
function getRecursosDataById($conn, $id) {
    $recursosData = array();

    $sql = "SELECT recursos.id, recursos.titlo, recursos.coment, recursos.file, recursos.data_time_r, utilizadores.username, utilizadores.nick, utilizadores.image_data, utilizadores.email, 
                (SELECT GROUP_CONCAT(DISTINCT disciplina.nome_disciplina SEPARATOR ', ') 
                FROM recursos_disciplina 
                INNER JOIN disciplina ON recursos_disciplina.id_disciplina = disciplina.id_disciplina 
                WHERE recursos_disciplina.id_recursos = recursos.id) AS disciplinas
                FROM recursos
                INNER JOIN utilizadores ON recursos.username_autor = utilizadores.username
                WHERE recursos.id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $recursosData['titlo'] = $row['titlo'];
        $recursosData['coment'] = $row['coment'];
        $recursosData['data_time_r'] = $row['data_time_r']; // recursos data
        $recursosData['username'] = $row['username'];
        $recursosData['nick'] = $row['nick'];
        $recursosData['file'] = $row['file'];
        $recursosData['email'] = $row['email'];
        $recursosData['disciplinas'] = $row['disciplinas'];
        $recursosData['image_data'] = $row['image_data'];
        $recursosData['formatted_data_r'] = date('j F Y', strtotime($recursosData['data_time_r'])); // recursos

        return $recursosData;
    } else {
        return null; // Если тема с заданным id не найдена, вернуть null
    }
}




// Использование функции для получения информации о записи по id
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];
    $recursosData = getRecursosDataById($conn, $id);   



    } else {
        echo 'Failed.';
}
?>
