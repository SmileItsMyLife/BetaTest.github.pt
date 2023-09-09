<?php include 'other/navbar.php';
include 'bd/data-projects.php';
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
  <title>112</title>
</head>
<body>
  <div class="container mt-4">
    <h2>Список тем пользователя</h2>
    <div class="row">
      <div class="col-md-9">


        <!-- Atividades -->
        <h4>Atividades</h4>
        <ul class="list-group">
          <li class="list-group-item mt-2">
          <?php
          $username = $_SESSION['entrada'];

          $atividadesUsuario = getAtividadesByUser($conn, $username);

          if (empty($atividadesUsuario)) {
              echo  $username ." У вас пока нету тем, хотите их <a href='recursos.php'> создать? </a>";
          } else {
              foreach ($atividadesUsuario as $atividade) { ?>
                  <div class="d-flex text-body-secondary pt-3">
                      <div class="pb-3 mb-0 small lh-sm border-bottom w-100">
                          <div class="d-flex justify-content-between">
                              <strong class="text-gray-dark"><?= $atividade['titulo'] ?></strong>
                          </div>
                          <div class="d-flex justify-content-between">
                          <span class="text-gray-dark" style="max-width: 100%; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                              <?= $atividade['descricao'] ?>
                          </span>
                          </div><br>

                          <span class="text-gray-dark">* <?= $atividade['disciplinas'] ?> * <?= $atividade['id_ano'] ?> * <?= $atividade['nome_ensino'] ?> </span><br>
                          <a href="topic-view-atividades.php?id=<?= $atividade['id'] ?>">Mais</a> 
                      </div>      
                  </div>
              <?php
                  }
              }
            ?>
          </li>
        </ul>





         <!-- Recursos -->
        <h4>Recursos</h4>
        <ul class="list-group">
          <li class="list-group-item mt-2">
          <?php

          $recursosUsuario = getRecursosByUser($conn, $username);

          if (empty($recursosUsuario)) {
              echo  $username ." У вас пока нету тем, хотите их <a href='recursos.php'> создать? </a>";
          } else {
              foreach ($recursosUsuario as $recurso) { ?>
                  <div class="d-flex text-body-secondary pt-3">
                      <div class="pb-3 mb-0 small lh-sm border-bottom w-100">
                          <div class="d-flex justify-content-between">
                              <strong class="text-gray-dark"><?= $recurso['titulo'] ?></strong>
                          </div>
                          <div class="d-flex justify-content-between">
                          <span class="text-gray-dark" style="max-width: 100%; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                              <?= $recurso['comentario'] ?>
                          </span>
                          </div><br>

                          <span class="text-gray-dark">* <?= $recurso['disciplinas'] ?> * </span><br>
                          <a href="topic-view-recursos.php?id=<?= $recurso['id'] ?>">Mais</a> 
                      </div>      
                  </div>
              <?php
                  }
              }
            ?>
          </li>
        </ul>
      </div>
      
      <div class="col-md-3">
        <h4>Избранные темы  
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-award" viewBox="0 0 16 16">
                <path d="M9.669.864 8 0 6.331.864l-1.858.282-.842 1.68-1.337 1.32L2.6 6l-.306 1.854 1.337 1.32.842 1.68 1.858.282L8 12l1.669-.864 1.858-.282.842-1.68 1.337-1.32L13.4 6l.306-1.854-1.337-1.32-.842-1.68L9.669.864zm1.196 1.193.684 1.365 1.086 1.072L12.387 6l.248 1.506-1.086 1.072-.684 1.365-1.51.229L8 10.874l-1.355-.702-1.51-.229-.684-1.365-1.086-1.072L3.614 6l-.25-1.506 1.087-1.072.684-1.365 1.51-.229L8 1.126l1.356.702 1.509.229z"/>
                <path d="M4 11.794V16l4-1 4 1v-4.206l-2.018.306L8 13.126 6.018 12.1 4 11.794z"/>
            </svg>
        </h4>
        <ul class="list-group">
          <li class="list-group-item">Избранная тема</li>
        </ul>
      </div>
    </div>
  </div>
  <div class="container mt-5">
        <button class="btn btn-primary" data-toggle="modal" data-target="#cookieModal">Подтвердить использование cookie</button>
    </div>

    <!-- Модальное окно для подтверждения использования cookie -->
    <div class="modal fade" id="cookieModal" tabindex="-1" role="dialog" aria-labelledby="cookieModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cookieModalLabel">Подтверждение использования cookie</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Этот веб-сайт использует файлы cookie для улучшения вашего опыта.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                    <button type="button" class="btn btn-primary" id="confirmCookieBtn">Подтвердить</button>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        // Обработка нажатия на кнопку "Подтвердить"
        document.getElementById('confirmCookieBtn').addEventListener('click', function () {
            // Здесь вы можете добавить код для установки cookie или выполнения других действий при подтверждении.
            // Например, установка cookie может выглядеть так:
            // document.cookie = "cookieConsent=1; expires=Fri, 31 Dec 9999 23:59:59 GMT; path=/";
            alert('Спасибо за подтверждение использования файлов cookie!');
            // Закрываем модальное окно после подтверждения
            $('#cookieModal').modal('hide');
        });
    </script>
</body>
</html>


