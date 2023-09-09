<!doctype html>
<html lang="en" data-bs-theme="auto">
  <head><script src="../assets/js/color-modes.js"></script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <title>CDR - Form</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/offcanvas-navbar/">
    <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">

    
    <!-- Custom styles for this template -->
    <link href="css/offcanvas-navbar.css" rel="stylesheet">
  </head>
  <body class="bg-body-tertiary">

  <?php 
  include 'other/navbar.php'; 
  include 'bd/data-topic-view-a.php';
  include 'bd/ConnectBD.php';
  $recordData = getRecordInfoById($conn, $id);   
  $comentariosData = fetchAtividadeComentarios($conn, $id);
  ?>   

<div class="nav-scroller bg-body shadow-sm">
  <nav class="nav" aria-label="Secondary navigation">
    <a class="nav-link active" aria-current="page" href="form.php">Home</a>
    <a class="nav-link" href="#">
      Friends
      <span class="badge text-bg-light rounded-pill align-text-bottom">27</span>
    </a>
    <a class="nav-link" href="atividades.php">Atividades</a>
    <a class="nav-link" href="recursos.php">Recursos</a>
    <a class="nav-link" href="#">Ferramentos</a>
  </nav>
</div>

<main class="container">
  <div class="my-2 p-3 bg-body rounded shadow-sm">
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="form.php">Home</a></li>
            <li class="breadcrumb-item"><a href="atividades.php">Atividades</a></li>
            <li class="breadcrumb-item active" aria-current="page">Topic-<?=$id = $_GET['id'];?></li>
        </ol>
    </nav>
  </div>
  <!-- Topics-View-ID<Atividades -->


  
  <div class="my-3 p-3 bg-body rounded shadow-sm">
    <h6 class="border-bottom pb-2 mb-0">Atividades - Ver topico</h6>
        <div class="d-flex text-body-secondary pt-3">
          <?php
          if ($recordInfo['image_data']) {
            echo '<img src="data:image/jpeg;base64,' . base64_encode($recordInfo['image_data']) . '" alt="User Avatar" class="bd-placeholder-img flex-shrink-0 me-2 rounded" width="32" height="32">';
          } else {
              echo '<img src="default-avatar.jpg" alt="Default Avatar" class="bd-placeholder-img flex-shrink-0 me-2 rounded" width="32" height="32">';
          }
          ?>
            <div class="pb-3 mb-0 small lh-sm border-bottom w-100">
                <div class="d-flex justify-content-between">
                    <h6 class="text-gray-dark">Nome: <?= $recordData['nick'] ?></h6>
                </div>
                <div class="d-flex justify-content-between">
                    <strong class="text-gray-dark"><?= $recordData['titlo'] ?></strong>
                </div>
                <div class="d-flex justify-content-between">
                  <span class="text-gray-dark" >
                        <?= $recordData['descricao'] ?>
                  </span>
                </div><br>

                <span class="text-gray-dark">* <?= $recordData['formatted_data_a'] ?> * <?= $recordData['disciplinas'] ?> * <?=  $recordData['niveis'] ?> * <?= $recordData['anos'] ?></span><br>        
            </div>      
        </div>
        <small class="d-block text-end mt-3">
      <!-- Код, открывающий модальное окно -->
      <?php

      // Вывод кнопки "Редактировать" только если текущий пользователь является автором темы
      if ($recordData['username'] === $username) {
          echo '<a href="#" data-bs-toggle="modal" data-bs-target="#editModal" data-id="'.$id.'">Редактировать</a>';
      }?>
      <a href="<?= $recordData['presentacao'] ?>">Presentacao</a>
      <a href="<?= $recordData['planificacao'] ?>">Planificacao</a>
    </small>
  </div>
  
  <div class="my-3 p-3 bg-body rounded shadow-sm">
    <div class="container">
      <h2>Добавить комментарий</h2>
        <form method="POST" action="bd/save-comment.php">
            <div class="mb-3">
              <input type="hidden" name="id_atividade" value="<?= $id ?>">
                <label for="comment" class="form-label">Комментарий</label>
                <textarea class="form-control" id="comment" name="comment" rows="4" placeholder="Введите ваш комментарий" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Отправить</button>
        </form>
    </div>
  </div>
  
  <div class="my-3 p-3 bg-body rounded shadow-sm">
    <h6 class="border-bottom pb-2 mb-0">Commentarios</h6>
    <?php
    // Сортировка массива $comentariosData по дате комментария (по убыванию)
    usort($comentariosData, function($a, $b) {
        return strtotime($b['user_date']) - strtotime($a['user_date']);
    });

    if (count($comentariosData) > 0) {
        foreach ($comentariosData as $comentario):
        ?>
        <div class="d-flex text-body-secondary pt-3">
            <?php
            if ($comentario['image_data']) {
                echo '<img src="data:image/jpeg;base64,' . base64_encode($comentario['image_data']) . '" alt="User Avatar" class="bd-placeholder-img flex-shrink-0 me-2 rounded" width="32" height="32">';
            } else {
                echo '<img src="default-avatar.jpg" alt="Default Avatar" class="bd-placeholder-img flex-shrink-0 me-2 rounded" width="32" height="32">';
            }
            ?>
            <div class="pb-3 mb-0 small lh-sm border-bottom w-100">
                <div class="d-flex justify-content-between">
                    <h6 class="text-gray-dark">Nome: <?= $comentario['user_nome'] ?></h6>
                </div>
                <div class="d-flex justify-content-between">
                    <strong class="text-gray-dark"><?= $comentario['user_com'] ?></strong>
                </div>
                <div class="d-flex justify-content-between">
                    <span class="text-gray-dark">
                        <!-- Здесь может быть дополнительная информация, если необходимо -->
                    </span>
                </div><br>
                <span class="text-gray-dark">* <?= $comentario['user_date'] ?> *</span><br>
            </div>
        </div>
        <?php endforeach;
    } else {
        echo '<p>Комментарий пока нет, но вы можете быть первым.</p>';
    }
    ?>
    <small class="d-block text-end mt-3">
        <a href="#"></a>
    </small>
</div>

  <!-- Модальное окно редактирования -->
  <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Редактирование темы</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
            </div>
            <div class="modal-body">
                <!-- Форма для редактирования темы -->
                <form action="bd/save-row-a.php?id=<?=$id = $_GET['id'];?>" method="post" enctype="multipart/form-data">
                    <input type="hidden" id="recordId" name="id" value="">
                    <!-- Поля формы для редактирования данных -->
                    <div class="mb-3">
                        <label for="newTitle" class="form-label">Заголовок</label>
                        <!-- Заполняем значение заголовка из PHP -->
                        <input type="text" class="form-control" id="newTitle" name="newTitle" required value="<?= $recordData['titlo'] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="newComment" class="form-label">Описание темы</label>
                        <!-- Заполняем значение описания из PHP -->
                        <textarea class="form-control" id="newComment" name="newComment" rows="10" required><?= $recordData['descricao'] ?></textarea>
                    </div>
                    <!-- Добавьте другие поля для редактирования -->
                        
                    <!-- Кнопка для сохранения изменений -->
                    <button type="submit" class="btn btn-primary">Сохранить</button>
                </form>
            </div>
        </div>
    </div>
</div>


</main>
<script src="../assets/dist/js/bootstrap.bundle.min.js"></script>

    <script src="offcanvas-navbar.js"></script></body>
</html>
