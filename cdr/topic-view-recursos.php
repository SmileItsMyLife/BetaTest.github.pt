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
  include 'bd/data-topic-view-r.php';
  include 'bd/ConnectBD.php';
  $recursosData = getRecursosDataById($conn, $id)  
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
            <li class="breadcrumb-item"><a href="recursos.php">Recursos</a></li>
            <li class="breadcrumb-item active" aria-current="page">Topic-<?=$id = $_GET['id'];?></li>
        </ol>
    </nav>
  </div>
  <!-- Topics-View-ID<Atividades -->


  
  <div class="my-3 p-3 bg-body rounded shadow-sm">
    <h6 class="border-bottom pb-2 mb-0">Atividades - Ver topico</h6>
        <div class="d-flex text-body-secondary pt-3">
          <?php
          if ($recursosData['image_data']) {
            echo '<img src="data:image/jpeg;base64,' . base64_encode($recursosData['image_data']) . '" alt="User Avatar" class="bd-placeholder-img flex-shrink-0 me-2 rounded" width="32" height="32">';
          } else {
              echo '<img src="default-avatar.jpg" alt="Default Avatar" class="bd-placeholder-img flex-shrink-0 me-2 rounded" width="32" height="32">';
          }
          ?>
            <div class="pb-3 mb-0 small lh-sm border-bottom w-100">
                <div class="d-flex justify-content-between">
                    <h6 class="text-gray-dark">Nome: <?= $recursosData['nick'] ?></h6>
                </div>
                <div class="d-flex justify-content-between">
                    <strong class="text-gray-dark"><?= $recursosData['titlo'] ?></strong>
                </div>
                <div class="d-flex justify-content-between">
                  <span class="text-gray-dark" >
                        <?= $recursosData['coment'] ?>
                  </span>
                </div><br>

                <span class="text-gray-dark">* <?= $recursosData['formatted_data_r'] ?></span><br>        
            </div>      
        </div>
    <small class="d-block text-end mt-3">
      <a href="#">File</a>
    </small>
  </div>
</main>
<script src="../assets/dist/js/bootstrap.bundle.min.js"></script>

    <script src="offcanvas-navbar.js"></script>
</body>
</html>
