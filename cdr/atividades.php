
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

  <?php 
  include 'other/navbar.php'; 
  include 'bd/dataatividade.php';
  include 'bd/ConnectBD.php';
  include 'bd/data-recursos.php'; // База Рекурсош только для отоброжение Disciplinas
  $disciplinaData = fetchDisciplinaData($conn); 
  $data = getAllDataFromDB($conn);   
  ?>    
    
    <!-- Custom styles for this template -->
    <link href="css/offcanvas-navbar.css" rel="stylesheet">
  </head>
  <body class="bg-body-tertiary">


<div class="nav-scroller bg-body shadow-sm">
  <nav class="nav" aria-label="Secondary navigation">
    <a class="nav-link active" aria-current="page" href="form.php">Home</a>
    <a class="nav-link" href="#">
      Friends
      <span class="badge text-bg-light rounded-pill align-text-bottom">27</span>
    </a>
    <a class="nav-link" href="atividades.php">Atividades</a>
    <a class="nav-link" href="recursos.php">Recursos</a>
    <a class="nav-link" href="ferramentos.php">Ferramentos</a>
  </nav>
</div>

<main class="container">
  <div class="my-2 p-3 bg-body rounded shadow-sm">
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="form.php">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Atividades</li>
        </ol>
    </nav>
  </div>

  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createCompanyModal">
    Addisionar atividades
  </button>
  
  <?php $username = $_SESSION['entrada']; ?>
  <h6><?=$username?></h6>
  <!-- Atividades -->
  <div class="my-3 p-3 bg-body rounded shadow-sm">
    <h6 class="border-bottom pb-2 mb-0">Atividades</h6>
    <?php
    $itemsPerPage = 10; // Количество элементов на странице
    $currentPage = isset($_GET['page']) ? $_GET['page'] : 1; // Текущая страница
    
    // Разбиваем массив на страницы
    $pagedData = array_chunk($data, $itemsPerPage);
    
    // Выбираем данные для текущей страницы
    $currentPageData = isset($pagedData[$currentPage - 1]) ? $pagedData[$currentPage - 1] : [];

    foreach ($currentPageData as $row): ?>
        <div class="d-flex text-body-secondary pt-3">
            <img src="<?= $row['avatar'] ?>" alt="User Avatar" class="bd-placeholder-img flex-shrink-0 me-2 rounded" width="32" height="32">
            <div class="pb-3 mb-0 small lh-sm border-bottom w-100">
                <div class="d-flex justify-content-between">
                  <a href="profile-view.php?username=<?= $row['username_autor'] ?>" class="text-gray-dark" style="text-decoration: none; color: #696969; font-weight: bold;">Nome: <?= $row['nick'] ?></a>
                  
                  <span class="float-end bookmark-hover" id="bookmarkIcon<?= $row['id'] ?>" onclick="toggleBookmark('<?= $row['id'] ?>')">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bookmark" viewBox="0 0 16 16">
                      <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.777.416L8 13.101l-5.223 2.815A.5.5 0 0 1 2 15.5V2zm2-1a1 1 0 0 0-1 1v12.566l4.723-2.482a.5.5 0 0 1 .554 0L13 14.566V2a1 1 0 0 0-1-1H4z"/>
                    </svg>
                  </span>
                  
                  
                </div>
                <div class="d-flex justify-content-between">
                  <strong class="text-gray-dark"><?= $row['titlo'] ?><br></strong>
                  </div>
                  <div class="d-flex justify-content-between">
                    <span class="text-gray-dark" style="max-width: 100%; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                    <?= $row['descricao'] ?>
                  </span>
                </div>

                      
                    <span class="badge text-bg-primary">
                      <?= $row['list_dis'] ?>
                    </span>
                    <span class="badge text-bg-success">
                      <?= $row['list_nivel'] ?> 
                    </span>     
                    <span class="badge text-bg-danger">
                      <?= $row['list_anos'] ?>
                    </span><br>
                        <!-- Date Time -->
                          <?= $row['date_time'] ?>
                        <!-- View -->
                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                            <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                            <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                          </svg>
                            0
                        <!-- Comments -->
                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chat" viewBox="0 0 16 16">
                            <path d="M2.678 11.894a1 1 0 0 1 .287.801 10.97 10.97 0 0 1-.398 2c1.395-.323 2.247-.697 2.634-.893a1 1 0 0 1 .71-.074A8.06 8.06 0 0 0 8 14c3.996 0 7-2.807 7-6 0-3.192-3.004-6-7-6S1 4.808 1 8c0 1.468.617 2.83 1.678 3.894zm-.493 3.905a21.682 21.682 0 0 1-.713.129c-.2.032-.352-.176-.273-.362a9.68 9.68 0 0 0 .244-.637l.003-.01c.248-.72.45-1.548.524-2.319C.743 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7-3.582 7-8 7a9.06 9.06 0 0 1-2.347-.306c-.52.263-1.639.742-3.468 1.105z"/>
                          </svg>
                            0
                            <br>
                      <div class="d-flex justify-content-between">
                        <a href="topic-view-atividades.php?id=<?= $row['id'] ?>">Mais</a>         
                        <?php if (isset($_SESSION['entrada']) && $_SESSION['entrada'] == 'admin') { ?>
                        <a href="bd/delete-recursos?id=<?= $row['id'] ?>">Delete</a>
                        <?php } ?>
                      </div>
                    </div>      
                  </div>
                  <?php endforeach; ?>
                  
                  <!-- Ваш код HTML для Pagination -->
                  <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center">
                      <?php for ($i = 1; $i <= count($pagedData); $i++): ?>
                        <li class="page-item <?php if ($i == $currentPage) echo 'active'; ?>">
                          <a class="page-link mt-2" href="?page=<?= $i ?>"><?= $i ?></a>
                        </li>
                        <?php endfor; ?>
                      </ul>
                    </nav>
                    
  </div>

</main>
  <div class="modal fade" id="createCompanyModal" tabindex="-1" aria-labelledby="createCompanyModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="createCompanyModalLabel">Создать новою тему - Atividades</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
                <div class="modal-body">
                    <!-- Форма для заполнения данных новой компании -->
                    <form>
                      <!-- Titulo -->
                        <div class="mb-3">
                            <label for="companyName" class="form-label" style="color: red;">Сдесь ничего не работает я только дал начало!</label><br> <!-- <<<< Удали! -->
                            <label for="companyName" class="form-label">Титул</label>
                            <input type="text" class="form-control" id="companyName" name="companyName" required>
                        </div>
                      <!-- Descricao -->
                        <div class="mb-3">
                            <label for="companyDescription" class="form-label">Описание Темы</label>
                            <textarea class="form-control" id="companyDescription" name="companyDescription" rows="2"
                                required></textarea>
                        </div>
                      <!-- Ciclo -->
                        <label for="companyDescription" class="form-label">Выбор преподавание</label>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                          <label class="form-check-label" for="flexCheckDefault">
                            1 Ciclo
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                          <label class="form-check-label" for="flexCheckDefault">
                            2 Ciclo
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                          <label class="form-check-label" for="flexCheckDefault">
                            3 Ciclo
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                          <label class="form-check-label" for="flexCheckDefault">
                            Secundário Científico-Humanísticos
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                          <label class="form-check-label" for="flexCheckDefault">
                            Secundário Profissionais
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                          <label class="form-check-label" for="flexCheckDefault">
                            PIEF 
                          </label>
                        </div>
                      <!-- Anos -->
                        <label for="companyDescription" class="form-label">Выберите годы</label><br><!-- << << << br -->
                              <?php
                              // Цикл для создания чекбоксов от 1 до 12
                              for ($i = 1; $i <= 12; $i++) {
                                echo '<div class="form-check form-check-inline">';
                                echo '<input class="form-check-input" type="checkbox" id="inlineCheckbox' . $i . '" name="selectedNumbers[]" value="' . $i . '">';
                                echo '<label class="form-check-label" for="inlineCheckbox' . $i . '">' . $i . '</label>';
                                echo '</div>';
                              }

                              // Если нужен дефолтный год при запуске окно
                              // $checked = ($i === 1) ? 'checked' : ''; // Предварительно выбранное число
                              // echo '<div class="form-check form-check-inline">';
                              // echo '<input class="form-check-input" type="checkbox" id="inlineCheckbox' . $i . '" name="selectedNumbers[]" value="' . $i . '" ' . $checked . '>';

                              ?>
                        
                          <br>
                      <!-- Disciplinas -->
                        <label for="companyDescription" class="form-label">Выбор предметов</label>
                        <select class="form-select" id="disciplina" name="disciplina[]" required>
                            <option value="">Choose...</option>
                            <?php
                            foreach ($disciplinaData as $disciplina) {
                                echo "<option name='disciplina' value='" . $disciplina['id_disciplina'] . "'>" . $disciplina['nome_disciplina'] . "</option>";
                            }
                            ?>
                        </select>
                        <div class="mb-3">
                            <label for="link" class="form-label">Планирувание</label>
                            <input type="text" class="form-control" id="link" name="link" required>
                        </div>
                        <div class="mb-3">
                            <label for="link" class="form-label">Презинтация</label>
                            <input type="text" class="form-control" id="link" name="link" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Сохранить</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

<script>
  
// Функция для изменения иконки и отправки данных на сервер
function toggleBookmark(id) {
    var bookmarkIcon = document.getElementById('bookmarkIcon' + id);
    var isBookmarked = bookmarkIcon.classList.contains('bookmarked');
    var userId = <?php echo json_encode($_SESSION['entrada']); ?>; // Получение идентификатора пользователя из PHP-сессии

    // Обновление иконки и класса
    if (isBookmarked) {
        bookmarkIcon.innerHTML = `
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bookmark" viewBox="0 0 16 16">
                <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.777.416L8 13.101l-5.223 2.815A.5.5 0 0 1 2 15.5V2zm2-1a1 1 0 0 0-1 1v12.566l4.723-2.482a.5.5 0 0 1 .554 0L13 14.566V2a1 1 0 0 0-1-1H4z"/>
            </svg>
        `;
        bookmarkIcon.classList.remove('bookmarked');
    } else {
        bookmarkIcon.innerHTML = `
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bookmark-fill" viewBox="0 0 16 16">
                <path d="M2 2v13.5a.5.5 0 0 0 .74.439L8 13.069l5.26 2.87A.5.5 0 0 0 14 15.5V2a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2z"/>
            </svg>
        `;
        bookmarkIcon.classList.add('bookmarked');
    }
    // Отправка данных на сервер
    var xhr = new XMLHttpRequest();
    var url = "bd/marcadores_do_users.php"; // Путь к вашему серверному скрипту
    var params = "user_id=" + userId + "&topic_id=" + id;
    xhr.open("POST", url, true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            // Обработка ответа от сервера, если необходимо
            console.log(xhr.responseText);
        }
    };

    xhr.send(params);
}


</script>
<style>
    /* Стиль при наведении */
    .bookmark-hover:hover {
        cursor: pointer; /* Изменение вида указателя при наведении */
    }

    /* Стиль при нажатии */
    .bookmark-active:active {
        cursor: grab; /* Изменение вида указателя при нажатии */
    }
</style>



<script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
  <script src="offcanvas-navbar.js"></script>
<?php include 'other/footer.php'; ?>  
</body>
</html>
