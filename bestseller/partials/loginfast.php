<?php

  session_start();

  if (isset($_SESSION['user_id'])) {
    header('Location: /bestseller');
  }
  require 'database.php';

  if (!empty($_POST['email']) && !empty($_POST['password'])) {
    $records = $conn->prepare('SELECT id, email, password FROM users WHERE email = :email');
    $records->bindParam(':email', $_POST['email']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $message = '';

    if (count($results) > 0 && password_verify($_POST['password'], $results['password'])) {
      $_SESSION['user_id'] = $results['id'];
      header("Location: /bestseller");
    } else {
      $message = 'Sorry, those credentials do not match';
    }
  }

?>

    <?php if(!empty($message)): ?>
      <p> <?= $message ?></p>
    <?php endif; ?>

    <form action="login.php" method="POST">
      <input name="email" type="text" class="placeholders_data" placeholder="Enter your email">
      <input name="password" type="password" class="placeholders_data" placeholder="Enter your Password">
      <input type="submit" class="submit_form" value="Iniciar sesión">
    </form>
