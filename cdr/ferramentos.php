<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ferramentas</title>
    <!-- Подключение файлов Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <?php include 'other/navbar.php';
    include 'bd/data-ferramentos.php';
    $data = fetchFerramentosData($conn);
    ?>
    <!-- Навигационная панель (необязательно) -->
   <div class="container py-4">
    <header class="pb-3 mb-4 border-bottom">
      <a href="/" class="d-flex align-items-center text-body-emphasis text-decoration-none">
      <img src="img/CDR-7-Gray.jpg" alt="Default Avatar" class="bd-placeholder-img flex-shrink-0 me-2 rounded" width="32" height="32">
        <span class="fs-4">Centro de recursos</span>
      </a>
    </header>
    
    <!-- Контейнер для компаний -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createCompanyModal">
        Добавить компанию
    </button>

    <!-- Модальное окно для создания новой компании -->
    <div class="modal fade" id="createCompanyModal" tabindex="-1" aria-labelledby="createCompanyModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createCompanyModalLabel">Создать новую компанию</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Форма для заполнения данных новой компании -->
                    <form action="bd/add-ferramentos.php" method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="nome" class="form-label">Имя компании</label>
                            <input type="text" class="form-control" id="nome" name="nome" required>
                        </div>
                        <div class="mb-3">
                            <label for="coment" class="form-label">Описание компании</label>
                            <textarea class="form-control" id="coment" name="coment" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="licencia" class="form-label">Тип компании</label>
                            <select class="form-control" id="licencia" name="licencia" required>
                                <option value="Grátis">Grátis</option>
                                <option value="Grátis & Pago">Grátis & Pago</option>
                                <option value="Pago">Pago</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="logo" class="form-label">Логотип</label>
                            <input type="file" class="form-control" id="logo" name="logo" accept="image/*" required>
                        </div>
                        <div class="mb-3">
                            <label for="fp_1" class="form-label">Характеристика 1</label>
                            <input type="text" class="form-control" id="fp_1" name="fp_1" required>
                        </div>
                        <div class="mb-3">
                            <label for="fp_2" class="form-label">Характеристика 2</label>
                            <input type="text" class="form-control" id="fp_2" name="fp_2" required>
                        </div>
                        <div class="mb-3">
                            <label for="fp_3" class="form-label">Характеристика 3</label>
                            <input type="text" class="form-control" id="fp_3" name="fp_3" required>
                        </div>
                        <div class="mb-3">
                            <label for="link" class="form-label">Сыллка</label>
                            <input type="text" class="form-control" id="link" name="link" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Сохранить</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Форма фильтрации -->
    <div class="container my-4">
        <form class="row g-3">
            <div class="col-md-4">
                <input type="text" class="form-control" id="filterName" placeholder="Имя компании">
            </div>
            <div class="col-md-4">
                <input type="text" class="form-control" id="filterCharacteristic" placeholder="Характеристика">
            </div>
            <div class="col-md-4">
                <button type="submit" class="btn btn-primary">Применить фильтр</button>
            </div>
        </form>
    </div>

    <div class="container my-5">
        <div class="row">
        <?php foreach ($data as $ferramento): ?>
            <div class="col-md-4 company-card" data-name="Компания" data-characteristic="Характеристика">
                <div class="card mb-4">
                    <img src="data:image/jpeg;base64,<?= base64_encode($ferramento['logo']) ?>" class="card-img-top" alt="Company">
                    <div class="card-body">
                        <h5 class="card-title"><a href="<?= $ferramento['link'] ?>"><?= $ferramento['nome'] ?></a></h5>
                        <p class="card-text"><?= $ferramento['coment'] ?></p>
                        <ul class="list-group list-group-flush">
                            <?php if ($ferramento['licenca'] == "Grátis"){echo"<li class='list-group-item' style=''>". $ferramento['licenca'] . "</li>";}?>
					        <?php if ($ferramento['licenca'] == "Grátis & Pago"){echo "<li class='list-group-item' style=''>". $ferramento['licenca'] . "</li>";}?>
					        <?php if ($ferramento['licenca'] == "Semi-splitless"){echo"<li class='list-group-item' style=''>". $ferramento['licenca'] . "</li>";}?>
                            <li class="list-group-item"><?= $ferramento['fp_1'] ?></li>
                            <li class="list-group-item"><?= $ferramento['fp_2'] ?></li>
                            <li class="list-group-item"><?= $ferramento['fp_3'] ?></li>
                        </ul>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Подключение файлов Bootstrap JavaScript (необязательно) -->
    <!-- Включает все плагины JavaScript, такие как модальные окна, всплывающие подсказки и т. д. -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script> -->

    <script>
        // Обработчик события отправки формы
        document.querySelector('form').addEventListener('submit', function (event) {
            event.preventDefault(); // Отменяем отправку формы

            const filterName = document.getElementById('filterName').value.toLowerCase();
            const filterCharacteristic = document.getElementById('filterCharacteristic').value.toLowerCase();

            // Перебираем все карточки компаний
            const companyCards = document.querySelectorAll('.company-card');
            for (const card of companyCards) {
                const companyName = card.dataset.name.toLowerCase();
                const companyCharacteristic = card.dataset.characteristic.toLowerCase();

                // Проверяем, соответствуют ли компания и её характеристики фильтру
                if (
                    (filterName === '' || companyName.includes(filterName)) &&
                    (filterCharacteristic === '' || companyCharacteristic.includes(filterCharacteristic))
                ) {
                    card.style.display = 'block'; // Отображаем карточку
                } else {
                    card.style.display = 'none'; // Скрываем карточку
                }
            }
        });
    </script>

</body>

</html>
