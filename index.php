<?php
session_start();
include('components/header.php');
include('components/navbar.php');
require_once('models/user.php');
print_r($_SESSION);
if (!isset($_SESSION['username'])) {
	header('Location:' . 'login.php');
}
?>
<div class="text-center">
test
</div>