
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
  <title>Centro de Recursos - Profile</title>
</head>
<body>
  <!-- NavBar -->
  <?php include 'other/navbar.php';
  

  ?>
  
  <!-- Форма для редактирования профиля -->
  <main class="container mt-4 mb-4">
    <input type="hidden" name="username" value="<?= $userData['username'] ?>">
    <div class="row">
      <div class="col-md-3">
        <div class="card">
        <form action="bd/save-profile-avatar.php" method="post" enctype="multipart/form-data">
            <img id="avatar-preview" src="<?= $userData['avatar'] ?>" class="card-img-top" alt="Фото профиля">
            <div class="card-body">
                <div class="mb-3">
                    <label for="avatar" class="form-label">Выберите аватарку</label>
                    <input type="file" class="form-control" id="image" name="image" accept="image/*">
                </div>
                <button type="submit" class="btn btn-primary" name="submit">Изменить аватарку</button>
            </div>
        </form>

        </div>
        <form action="bd/save-profile.php" method="post" enctype="multipart/form-data">
            </div>
            <div class="col-md-9">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Редактировать профиль</h5>
              <div class="mb-3">
                  <label for="username" class="form-label">Имя пользователя</label>
                  <input type="text" class="form-control" id="username" name="username" value="<?= $userData['username'] ?>" required>
              </div>
              <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?= $userData['email'] ?>" required>
              </div>
              <div class="mb-3">
                <label for="nick" class="form-label">Nick</label>
                <input type="text" class="form-control" id="nick" name="nick" value="<?= $userData['nick'] ?>" required>
              </div>
              <div class="mb-3">
                <label for="state" class="form-label">Group</label>
                <select class="form-select" id="group" name="group" required>
                    <option value="<?php echo $userData['cod_grupo']; ?>"><?= $userData['cod_grupo'] ?> <?= $userData['nome_grupo'] ?></option>
                    <?php
                    foreach ($groups as $group) {
                        echo "<option value='" . $group['id_grupo'] . "'>" . $group['cod_grupo'] . '  ' . $group['nome_grupo'] . "</option>";
                    }
                    ?>
                </select>
              </div>
              <div class="mb-3">
                <label for="state" class="form-label">Escola</label>
                  <select class="form-select" id="escola" name="escola" required>
                      <option value="<?php echo $userData['nome_escola']; ?>"><?= $userData['nome_escola'] ?></option>
                      <?php
                      foreach ($schools as $school) {
                          echo "<option value='" . $school['id_escola'] . "'>" . $school['nome_escola'] . "</option>";
                      }
                      ?>
                  </select>

              </div>
              <?php if (isset($updateError)) { ?>
                <div class="alert alert-danger" role="alert">
                  <?= $updateError ?>
                </div>
              <?php } ?>
              <button type="submit" class="btn btn-primary">Сохранить профиль</button>
            </div>
          </div>
        </div>
      </div>
    </form>
  </main>



<!-- Подключение Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
  // Скрипт для предпросмотра и загрузки аватарки
  const avatarInput = document.getElementById('avatar');
  const avatarPreview = document.getElementById('avatar-preview');
  const defaultAvatar = 'path/to/default-avatar.png'; // Путь к дефолтной аватарке

  avatarInput.addEventListener('change', (event) => {
    const file = event.target.files[0];
    if (file) {
      const reader = new FileReader();
      reader.onload = (e) => {
        avatarPreview.setAttribute('src', e.target.result);
      };
      reader.readAsDataURL(file);
    } else {
      // Если файл не выбран, используем дефолтную аватарку
      avatarPreview.setAttribute('src', defaultAvatar);
    }
  });
</script>
  
<div class="b-example-divider"></div>

<?php include 'other/footer.php'; ?>
</body>
</html>
