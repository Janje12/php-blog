<?php
include('components/header.php');
require_once('models/user.php');
$message = '';
if (isset($_POST['username']) && isset($_POST['password'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];
  $user = User::login($username, $password);
  if ($user !== null) {
    $_SESSION['username'] = $username;
    $_SESSION['userID'] = $user['userID'];
    header('Location: ' . 'index.php');
  } else {
    $message = 'Netačno korisničko ime ili šifra!';
  }
}
?>
<style>
  .form-signin {
    width: 100%;
    max-width: 330px;
    padding: 15px;
    margin: auto;
    margin-top: 7%;
  }
</style>
<div class="text-center">
  <main class="form-signin">
    <form method="POST">
      <h1 class="h3 mb-3 fw-normal">Ulogujte se!</h1>
      <label for="inputUsername" class="visually-hidden">Korisničko ime:</label>
      <input type="text" id="username" name="username" class="form-control" placeholder="Korisničko ime" required="" autofocus="">
      <label for="inputPassword" class="visually-hidden">Šifra</label>
      <input type="password" id="password" name="password" class="form-control" placeholder="Šifra" required="">
      <div class="checkbox mb-3">
        <label>
          <?php echo $message; ?>
        </label>
      </div>
      <button class="w-100 btn btn-lg btn-primary" type="submit">Uloguj se</button>
      <p class="text-muted mt-1">Nemaš nalog? <a href="register.php">Registruj se!</a></p>
    </form>
  </main>
</div>