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
  <?php include 'other/navbar.php';?>
   
<main>
  <div class="container py-4">
    <header class="pb-3 mb-4 border-bottom">
      <a href="/" class="d-flex align-items-center text-body-emphasis text-decoration-none">
      <img src="img/CDR-7-Gray.jpg" alt="Default Avatar" class="bd-placeholder-img flex-shrink-0 me-2 rounded" width="32" height="32">
        <span class="fs-4">Centro de recursos</span>
      </a>
    </header>

    <div class="p-5 mb-4 bg-body-tertiary rounded-3">
      <div class="container-fluid py-5">
        <h1 class="display-5 fw-bold">Bem-vindo!</h1>
        <p class="col-md-8 fs-4">Ao nosso sítio Web dedicado à partilha de experiências e informações entre professores!.</p>
        <a href="atividades.php" class="btn btn-primary btn-lg" type="button">Atividades</a>
      </div>
    </div>

    <div class="row align-items-md-stretch">
      <div class="col-md-6">
        <div class="h-100 p-5 text-bg-dark rounded-3">
          <h2>Recursos!</h2>
          <p>Pode partilhar vídeos, ficheiros e muito mais. Eis o que encontrará no nosso recurso: Biblioteca de recursos, Partilha de ficheiros, Comentários e classificações, Filtros e pesquisa, Perfil pessoal..</p>
          <a href="recursos.php" class="btn btn-outline-light" type="button">Recursos</a>
        </div>
      </div>
      <div class="col-md-6">
        <div class="h-100 p-5 bg-body-tertiary border rounded-3">
          <h2>Ferramentos!</h2>
          <p>O nosso objetivo é fornecer-lhe todas as ferramentas necessárias para criar e editar diferentes tipos de conteúdos. Com estas ferramentas, poderá criar conteúdos únicos e personalizados que apoiam o seu currículo e proporcionam uma aprendizagem eficaz.</p>
          <a href="ferramentos.php" class="btn btn-outline-secondary" type="button">Ferramentos</a>
        </div>
      </div>
    </div>

    <footer class="pt-3 mt-4 text-body-secondary border-top">
      &copy; 2023
    </footer>
  </div>
</main>
<script src="../assets/dist/js/bootstrap.bundle.min.js"></script>


<div class="b-example-divider"></div>

<?php include 'other/footer.php'; ?>
</body>
</html>
