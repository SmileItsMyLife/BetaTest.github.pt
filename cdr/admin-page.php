<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
  <title>Centro de Recursos</title>
</head>
<body>
  <!-- NavBar -->
  <?php include 'other/navbar.php';
  include 'bd/ap/user-base.php';
  ?>
  
<main class="container">   
  <h2>База пользувателей</h2>
  <div class="table-responsive small" style="max-height: 400px; overflow-y: auto;">
    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Username</th>
                <th scope="col">Nome de login</th>
                <th scope="col">Password</th>
                <th scope="col">Email</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Получение данных пользователей из функции getUsersData
            $users = getUsersData($conn);

            // Перебор массива с данными пользователей и вывод каждого пользователя в таблицу
            foreach ($users as $user) {
                echo "<tr>";
                echo "<td>" . $user['id'] . "</td>";
                echo "<td>" . $user['username'] . "</td>";
                echo "<td>" . $user['nick'] . "</td>";
                echo "<td>" . $user['pass'] . "</td>";
                echo "<td>" . $user['email'] . "</td>";
                echo "</tr>";
            }
            ?>
          </tbody>
      </table>
  </div>
</main>

<div class="container mt-5" >
    <div class="row">     
    <!-- Таблица 1 Дисцыплина-->       
        <div class="col-md-6" style="max-height: 400px; overflow-y: auto;">
            <table class="table" >
                <form action="bd/ap/add-disciplina.php" method="post" enctype="multipart/form-data">
                    <label for="add-disciplina" class="form-label">Disciplinas</label>
                    <div class="row g-3">
                        <div class="col">
                            <input type="text" class="form-control" name="disciplina" placeholder="Disciplina" aria-label="Disciplina">
                        </div>
                        <button type="submit" class="btn btn-primary">Добавить</button>
                    </div>
                </form>
              <thead>
                  <tr>
                      <th>ID</th>
                      <th>Название</th>
                      <th>Удалить</th>
                      <th>Изменить</th>
                  </tr>
              </thead>
            <tbody>
                <?php
                    $disciplinas = getDisciplinas($conn);
                    foreach ($disciplinas as $disciplina) {
                        $id_dis = $disciplina['id_dis'];
                        $nome_dis = $disciplina['nome_dis'];

                        echo "<tr>
                                <td>$id_dis</td>
                                <td>$nome_dis</td>
                                <td><button type='button' class='btn btn-primary btn-sm deleteBtn' name='delete' data-id='$id_dis'>Delete*</button></td>
                                <td><a href='#editModal' class='editLink' data-bs-toggle='modal' data-bs-target='#editModal' data-id='$id_dis' data-nome='$nome_dis'>Editar*</a></td>
                            </tr>";
                    }
                ?>
            </tbody>
          </table>
        </div> 
    <!-- Таблица 2 Группы-->   
        <div class="col-md-6" style="max-height: 400px; overflow-y: auto;">
            <!-- Таблица 2 -->
            <form action="bd/add-disciplina.php" method="post" enctype="multipart/form-data">
                <label for="add-disciplina" class="form-label">Grupos</label>
                <div class="row g-3">
                    <div class="col">
                        <input type="text" class="form-control" placeholder="Cod" aria-label="Cod">
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" placeholder="Grupo" aria-label="Grupo">
                    </div>
                    <button type="submit" class="btn btn-primary">Добавить</button>
                </div>
          </form>
            <table class="table" >
              <thead>
                  <tr>
                      <th>ID</th>
                      <th>Cod</th>
                      <th>Название</th>
                      <th>Удалить</th>
                      <th>Изменить</th>
                  </tr>
              </thead>
            <tbody >
                <?php
                    $grupos = getGrupos($conn);
                    foreach ($grupos as $grupo) {
                        $id_grupo = $grupo['id_grupo'];
                        $cod_grupo = $grupo['cod_grupo'];
                        $nome_grupo = $grupo['nome_grupo'];
                        echo "<tr>
                            <td>$id_grupo</td>
                            <td>$cod_grupo</td>
                            <td>$nome_grupo</td>
                            <td><button type='button' class='btn btn-primary btn-sm deleteBtn' data-id='$id_grupo'>Delete</button></td>
                            <td><a href='#' class='editLink1' data-bs-toggle='modal' data-bs-target='#editModal' data-id='$id_grupo' data-nome='$nome_grupo'>Editar</a></td>
                        </tr>";
                    }
                ?>
            </tbody>
          </table>
        </div>  
    <!-- Таблица 3 Дисцыплина Год Преподование-->    
        <div class="col-md-6 mt-3" style="max-height: 400px; overflow-y: auto;">
            <form action="bd/add-disciplina.php" method="post" enctype="multipart/form-data">
                <label for="add-disciplina" class="form-label">Disciplina & Ano & Ensino</label>
                <div class="row g-3">
                    <div class="col">
                        <input type="text" class="form-control" placeholder="ID" aria-label="ID">
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" placeholder="Ano" aria-label="Ano">
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" placeholder="Ensino" aria-label="Ensino">
                    </div>
                    <button type="submit" class="btn btn-primary">Добавить</button>
                </div>
          </form>
            <table class="table" >
              <thead>
                  <tr>
                      <th>ID</th>
                      <th>Ano</th>
                      <th>Название</th>
                      <th>Удалить</th>
                      <th>Изменить</th>
                  </tr>
              </thead>
            <tbody >
                <?php
                    $gruposup = getGruposUP($conn);
                    foreach ($gruposup as $grupoup) {
                        $id_disup = $grupoup['id_disciplina'];
                        $id_ano = $grupoup['id_ano'];
                        $id_ensino = $grupoup['id_ensino'];
                        echo "<tr>
                            <td>$id_disup</td>
                            <td>$id_ano</td>
                            <td>$id_ensino</td>
                            <td><button type='button' class='btn btn-primary btn-sm deleteBtn' data-id='   $   '>Delete</button></td>
                            <td><a href='#' class='editLink1' data-bs-toggle='modal' data-bs-target='#editModal' data-id='   $   ' data-nome='   $   '>Editar</a></td>
                        </tr>";
                    }
                ?>
            </tbody>
          </table>
        </div>
    <!-- Таблица 4 Школы-->    
        <div class="col-md-6 mt-3 " style="max-height: 400px; overflow-y: auto; ">
            <form action="bd/add-disciplina.php" method="post" enctype="multipart/form-data">
                <label for="add-disciplina" class="form-label">Escola</label>
                <div class="row g-3">
                    <div class="col">
                        <input type="text" class="form-control" placeholder="Escola" aria-label="Escola">
                    </div>
                    <button type="submit" class="btn btn-primary">Добавить</button>
                </div>
          </form>
            <table class="table" >
              <thead>
                  <tr>
                      <th>ID</th>
                      <th>Название</th>
                      <th>Удалить</th>
                      <th>Изменить</th>
                  </tr>
              </thead>
            <tbody >
                <?php
                    $escolas = getEscolas($conn);
                    foreach ($escolas as $escola) {
                        $id_escola = $escola['id_escola'];
                        $nome_escola = $escola['nome_escola'];
                        echo "<tr>
                            <td>$id_escola</td>
                            <td>$nome_escola</td>
                            <td><button type='button' class='btn btn-primary btn-sm deleteBtn' data-id='   $   '>Delete</button></td>
                            <td><a href='#' class='editLink1' data-bs-toggle='modal' data-bs-target='#editModal' data-id='   $   ' data-nome='   $   '>Editar</a></td>
                        </tr>";
                    }
                ?>
            </tbody>
          </table>
        </div>    
                
    </div>
    
</div>
<!-- #Disciplinas Окно для изминение-->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <!-- ... остальной код модального окна ... -->
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Редактирование дисциплины</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
                </div>
                <div class="modal-body">
                    <!-- Форма для редактирования дисциплины -->
                    <form action="bd/ap/save-dis.php" method="post">
                        <input type="hidden" id="idDisInput" value="">
                        <div class="mb-3">
                            <label for="newTitle" class="form-label">Название дисциплины</label>
                            <input type="text" class="form-control" id="newTitle" name="newTitle" required>
                        </div>
                        <button type="submit" name="save" class="btn btn-primary">Сохранить</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

<!-- #Disciplinas Изменить нужный урок -->
    <script>
        const editLinks = document.querySelectorAll('.editLink');
        const idDisInput = document.getElementById('idDisInput');
        const newTitleInput = document.getElementById('newTitle');

        editLinks.forEach(link => {
            link.addEventListener('click', (event) => {
                const targetLink = event.target;
                const nome = targetLink.getAttribute('data-nome');
                const id = targetLink.getAttribute('data-id');

                idDisInput.value = id;
                newTitleInput.value = nome;
            });
        });
    </script>

<!-- #Disciplinas Удалить нужный урок -->
    <script>
        const deleteButtons = document.querySelectorAll('.deleteBtn');
        deleteButtons.forEach(button => {
            button.addEventListener('click', (event) => {
                const targetButton = event.target;
                const id = targetButton.getAttribute('data-id');

                // Отправляем AJAX-запрос для удаления записи
                const xhr = new XMLHttpRequest();
                xhr.open('POST', 'bd/ap/delete-dis.php', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.onload = function() {
                    if (xhr.status === 200) {
                        console.log(xhr.responseText); // Ответ от сервера
                        // Можно выполнить дополнительные действия, например, обновить страницу
                    } else {
                        console.error('Произошла ошибка при отправке запроса');
                    }
                };
                xhr.send('id_dis=' + id);
            });
        });
    </script>

<!-- #Grupos Окно для изминение НЕ РАБОТАЕТ -->
    <div class="modal fade" id="editModal1" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <!-- ... остальной код модального окна ... -->
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Редактирование дисциплины</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
                </div>
                <div class="modal-body">
                    <!-- Форма для редактирования дисциплины -->
                    <form action="bd/ap/save-dis.php" method="post">
                        <input type="hidden" id="idDisInput" name="idDisInput" value="">
                        <div class="mb-3">
                            <label for="newTitle" class="form-label">Название дисциплины</label>
                            <input type="text" class="form-control" id="newTitle" name="newTitle" required>
                        </div>
                        <div class="row">
                        <div class="col">
                            <input type="text" class="form-control" placeholder="First name" aria-label="First name">
                        </div>
                        <div class="col">
                            <input type="text" class="form-control" placeholder="Last name" aria-label="Last name">
                        </div>
                        </div>
                        <button type="submit" name="save" class="btn btn-primary">Сохранить</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

<!-- #Grupos Изменить нужный урок НЕ РАБОТАЕТ -->
    <script>
        const editLinks = document.querySelectorAll('.editLink1');
        const idDisInput = document.getElementById('idDisInput');
        const newTitleInput = document.getElementById('newTitle');

        editLinks.forEach(link => {
            link.addEventListener('click', (event) => {
                const targetLink = event.target;
                const nome = targetLink.getAttribute('data-nome');
                const id = targetLink.getAttribute('data-id');

                idDisInput.value = id;
                newTitleInput.value = nome;
            });
        });
    </script>

<!-- #Grupos Удалить нужный урок НЕ РАБОТАЕТ -->
    <script>
        const deleteButtons = document.querySelectorAll('.deleteBtn');
        deleteButtons.forEach(button => {
            button.addEventListener('click', (event) => {
                const targetButton = event.target;
                const id = targetButton.getAttribute('data-id');

                // Отправляем AJAX-запрос для удаления записи
                const xhr = new XMLHttpRequest();
                xhr.open('POST', 'bd/ap/delete-dis.php', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.onload = function() {
                    if (xhr.status === 200) {
                        console.log(xhr.responseText); // Ответ от сервера
                        // Можно выполнить дополнительные действия, например, обновить страницу
                    } else {
                        console.error('Произошла ошибка при отправке запроса');
                    }
                };
                xhr.send('id_dis=' + id);
            });
        });
    </script>


<script src="../assets/dist/js/bootstrap.bundle.min.js"></script>

<?php include 'other/footer.php'; ?>
</body>
</html>
