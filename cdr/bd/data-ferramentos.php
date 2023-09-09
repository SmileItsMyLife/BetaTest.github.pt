<?php
function fetchFerramentosData($conn) {
    $result2 = mysqli_query($conn, "SELECT * FROM ferramentos");
    $ferramentosData = array();

    if ($result2) {
        while ($row = mysqli_fetch_assoc($result2)) {
            $id = $row['id'];
            $nome = $row['nome'];
            $licenca = $row['licenca'];
            $coment = $row['coment'];
            $link = $row['link'];
            $fp_1 = $row['fp_1'];
            $fp_2 = $row['fp_2'];
            $fp_3 = $row['fp_3'];
            $imageData = $row['logo'];

            $ferramento = array(
                'id' => $id,
                'nome' => $nome,
                'licenca' => $licenca,
                'coment' => $coment,
                'link' => $link,
                'fp_1' => $fp_1,
                'fp_2' => $fp_2,
                'fp_3' => $fp_3,
                'logo' => $imageData,
            );

            $ferramentosData[] = $ferramento;
        }
    }

    return $ferramentosData;
}

?>
