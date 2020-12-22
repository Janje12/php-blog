<?php

include('components/header.php');
require_once('models/user.php');

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    session_destroy();
    header("refresh:2;url=login.php");
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
        <h1>Odjavljivanje u toku...</h1>
        <h2 class="text-muted">Vidimo se <?php echo $username ?> </h2>
    </main>
</div>