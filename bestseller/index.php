<?php
  session_start();

  require 'database.php';

  if (isset($_SESSION['user_id'])) {
    $records = $conn->prepare('SELECT id, full_name, email, password FROM users WHERE id = :id');
    $records->bindParam(':id', $_SESSION['user_id']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $user = null;

    if (is_countable($results) > 0) {
      $user = $results;
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Inicia</title>
    <link rel="stylesheet" href="assets/css/index.css?v=<?php echo time(); ?>" />
    <script src="/js/functions.js?v=<?php echo time(); ?>"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>
<body class="body_index">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

    <?php if(!empty($user)): ?>
      <?php require 'partials/header.php' ?>
      <br> Welcome. <?= $user['full_name']; ?>
      <br>You are Successfully Logged In
      <a href="logout.php">
        Logout
      </a>

      
    <?php else: ?>
    <div class="text-center d-block">
      <div class="d-inline-block text-start introduction_container ">
        <img src="./images/bestsellermodoclaro.png" class="introduction_logo" width="500" alt="Bestseller">
        <p class='introduction'>
              En Bestseller podrás comprar, vender e intercambiar tus criptomonedas, donde quieras, cuando quieras.
        </p>
      </div>

      <div class="d-inline-block signup_container">
        <?php require 'partials/signupfast.php' ?>

      <button type="button" class="btn_session" data-bs-toggle="modal" data-bs-target="#exampleModal">

          Iniciar sesión
        </button>
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <?php require 'partials/loginfast.php' ?>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
              </div>
            </div>                                                                               
          </div>
        </div>
      </div>
    
      
        <?php endif; ?>
</body>
</html>