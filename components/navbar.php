<?php
if (!isset($_SESSION['username']) || !isset($_SESSION['userID'])) {
  header('Location: ' . 'login.php');
}
$icon = 'moon';
$color = 'light';
if (isset($_COOKIE['darkmode'])) {
  $icon = 'sun';
  $color = 'dark';
}
if (isset($_POST['darkmode'])) {
  if ($_POST['darkmode'] == 1)
    setcookie('darkmode', $_POST['darkmode'], time() + 60 * 60 * 24 * 30, "", "" . false, false);
  else
    setcookie("darkmode", "", time() - 3600);
  header("Refresh:0;url=" . $_SERVER['REQUEST_URI']);
}
$active = "active";

?>
<nav class="navbar navbar-expand-lg navbar-<?php echo $color . " bg-" . $color; ?>">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">AjTi Blog</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link <?php echo $_SERVER['REQUEST_URI'] === "/index.php" ? $active : ""; ?>" aria-current="page" href="index.php">Početna</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php echo $_SERVER['REQUEST_URI'] === "/top-posts.php" ? $active : ""; ?>" href="top-posts.php">Top objave</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php echo $_SERVER['REQUEST_URI'] === "/all-posts.php" ? $active : ""; ?>" href="all-posts.php">Sve objave</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php echo $_SERVER['REQUEST_URI'] === "/search-posts.php" ? $active : ""; ?>" href="search-posts.php">Pronađi objave</a>
        </li>
      </ul>
      <div class="d-flex justify-content-center flex-fill">
        <?php echo "Dobrodošli " . $_SESSION['username']; ?>
      </div>
      <form class="mt-3" action="search-posts.php">
        <div class="input-group">
          <input type="hidden" name="filter" value="title">
          <input name="value" class="form-control" type="search" placeholder="Pretraži po nasolvu" aria-label="Search">
          <button class="btn btn-outline-primary" type="submit"><i class="fa fa-search"></i></button>
        </div>
      </form>
      <form method="POST" class="mt-3 mx-2">
        <input type="hidden" name="darkmode" value="<?php echo $color === 'dark' ? 0 : 1; ?>">
        <button type="submit" class="btn btn-outline-dark">&nbsp;<i class="fa fa-<?php echo $icon; ?>"></i>&nbsp;</button>
      </form>
      <form action="logout.php" class="mt-3">
        <div class="input-group">
          <button type="submit" class="btn btn-outline-danger">Odjavi se <i class="fa fa-sign-out-alt"></i></button>
        </div>
      </form>
    </div>
  </div>
</nav>