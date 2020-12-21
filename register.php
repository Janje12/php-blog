<?php
session_start();
include('components/header.php');
require_once('models/user.php');
print_r($_SESSION);
$message = '';
if (isset($_POST['username']) && isset($_POST['password']) && $_POST['email'] && $_POST['firstName'] && $_POST['lastName']) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $user = new User($firstName, $lastName, $username, $password, $email);

    if (User::register($user)) {
        $message = 'Uspešno ste se registrovali!';
        header('Location: '. 'login.php');
    } else
        echo 'Proverite sve informacije';
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
            <h1 class="h3 mb-3 fw-normal">Registrujte se!</h1>
            <label for="firstName" class="visually-hidden">Ime:</label>
            <input type="text" id="firstName" name="firstName" class="form-control" placeholder="Ime" required="">
            <label for="lastName" class="visually-hidden">Prezime:</label>
            <input type="text" id="lastName" name="lastName" class="form-control" placeholder="Prezime" required="">
            <label for="email" class="visually-hidden">Email:</label>
            <input type="email" id="email" name="email" class="form-control" placeholder="Email" required="">
            <label for="username" class="visually-hidden">Korisničko ime:</label>
            <input type="text" id="username" name="username" class="form-control" placeholder="Korisničko ime" required="" autofocus="">
            <label for="password" class="visually-hidden">Šifra</label>
            <input type="password" id="password" name="password" class="form-control" placeholder="Šifra" required="">
            <button class="w-100 btn btn-lg btn-primary mt-2" type="submit">Registruj se</button>
            <p class="text-muted mt-1">Već imate nalog? <a href="login.php">Uloguj se!</a></p>
        </form>
    </main>
</div>