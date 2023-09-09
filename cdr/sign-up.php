<?php
include 'bd/datauser.php';
include 'bd/ConnectBD.php';
$schools = getSchoolDataForSignUp($conn);
$groups = getGroupDataForSignUp($conn);

?>
<!doctype html>
<html lang="en" data-bs-theme="auto">
  <head><script src="../assets/js/color-modes.js"></script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CDR - Regisration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/checkout/">

    
    <?php include 'other/navbar.php';?>
    

<link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Custom styles for this template -->
    <link href="css/registration.css" rel="stylesheet">
  </head>
  <body class="bg-body-tertiary">  
<div class="container">
  <main>
    <div class="py-5 text-center">
  <img class="d-block mx-auto mb-4" src="img/CDR-7-Gray.jpg" alt="" width="72" height="72">
  <h2>Registration Form</h2>
  <p class="lead">Join our friendly community where you'll find a wealth of exciting opportunities. Registered members have access to exclusive content, can interact with other members, leave comments, and customize their profile to their liking.</p>
</div>

<div class="row g-5">
  <div class="col-md-5 col-lg-4 order-md-last">
    <h4 class="mb-3">List of Benefits</h4>
    <ul class="list-group mb-3">
      <li class="list-group-item d-flex justify-content-between">
        <span>Access to exclusive content</span>
        <span class="badge bg-primary">+</span>
      </li>
      <li class="list-group-item d-flex justify-content-between">
        <span>Interact with other members</span>
        <span class="badge bg-primary">+</span>
      </li>
      <li class="list-group-item d-flex justify-content-between">
        <span>Leave comments on posts</span>
        <span class="badge bg-primary">+</span>
      </li>
      <li class="list-group-item d-flex justify-content-between">
        <span>Customize your profile</span>
        <span class="badge bg-primary">+</span>
      </li>
    </ul>
  </div>
      <div class="col-md-7 col-lg-8">
        <h4 class="mb-3">Sing-up</h4>
        <form class="needs-validation" novalidate action="bd/registo.php" method="post">
          <div class="row g-3">
            <div class="col-sm-6"><label for="username" class="form-label">Username</label>
              <div class="input-group has-validation">
                <span class="input-group-text">@</span>
                <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
                <div class="invalid-feedback">
                O seu nome de utilizador é obrigatório.
                </div>
              </div>
              
            </div>

            <div class="col-sm-6">
              <label for="lastName" class="form-label">NickName</label>
              <input type="text" class="form-control" id="nick" name="nick" placeholder="Nome" value="" required>
              <div class="invalid-feedback">
              É necessário um apelido válido.
              </div>
            </div>

            <div class="col-6">
              <label for="firstName" class="form-label">Password</label>
              <input type="password" class="form-control" id="password" name="password" placeholder="#Pk9Ls2A3" value="" required>
              <div class="invalid-feedback">
                A valid password of 8 characters or more is required.
              </div>
            </div>

            <div class="col-6">
              <label for="firstName" class="form-label">Reset The Password</label>
              <input type="password" class="form-control" id="password2" name="password2" placeholder="#Pk9Ls2A3" value="" required>
              <div class="invalid-feedback">
               Password is not the same as the main password
              </div>
            </div>

            <div class="col-12">
              <label for="email" class="form-label">Email <span class="text-body-secondary"></span></label>
              <input type="email" class="form-control" id="email" name="email" placeholder="you@example.com">
              <div class="invalid-feedback">
              Please enter a valid e-mail address.
              </div>
            </div>

            <div class="col-md-7">
              <label for="country" class="form-label">School</label>
              <select class="form-select" id="escola" name="escola" required>
                  <option value="">Choose...</option>
                  <?php
                  foreach ($schools as $school) {
                      echo "<option value='" . $school['id_escola'] . "'>" . $school['nome_escola'] . "</option>";
                  }
                  ?>
              </select>

              <div class="invalid-feedback">
                Por favor, uma escola.
              </div>
            </div>

            <div class="col-md-5">
              <label for="state" class="form-label">Group</label>
              <select class="form-select" id="escola" name="group" required>
                  <option value="">Choose...</option>
                  <?php
                  foreach ($groups as $group) {
                      echo "<option value='" . $group['id_grupo'] . "'>" . $group['nome_grupo'] . "</option>";
                  }
                  ?>
              </select>
              <div class="invalid-feedback">
                Por favor, uma groupo.
              </div>
            </div>

            <div class="input-group mb-3">
              <button class="btn btn-outline-secondary" type="button" id="inputGroupFileAddon03" disabled>Avatar</button>
              <input type="file" class="form-control" id="inputGroupFile03" aria-describedby="inputGroupFileAddon03" aria-label="Upload">
          </div>
          </div>

     <hr class="my-4">

          <button class="w-100 btn btn-primary btn-lg" type="submit">Continued</button>
          <p>Esti acaunt?<a href="sign-in.php">Sign-In</a></p>
        </form>
      </div>
    </div>
  </main>

  <footer class="my-5 pt-5 text-body-secondary text-center text-small">
    <p class="mb-1">&copy; 2017–2023 Company Name</p>
    <ul class="list-inline">
      <li class="list-inline-item"><a href="#">Privacy</a></li>
      <li class="list-inline-item"><a href="#">Terms</a></li>
      <li class="list-inline-item"><a href="#">Support</a></li>
    </ul>
  </footer>
</div>
<script src="../assets/dist/js/bootstrap.bundle.min.js"></script>

    <script src="js/registration.js"></script></body>
</html>
