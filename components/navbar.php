<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">AjTi Blog</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Početna</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="top-posts.php">Top objave</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="all-posts.php">Sve objave</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="search-posts.php">Pronađi objave</a>
        </li>
      </ul>
      <form class="d-flex mx-2" action="search-posts.php">
        <input type="hidden" name="filter" value="title">
        <input name="value" class="form-control" type="search" placeholder="Pretraži po nasolvu" aria-label="Search">
        <button class="btn btn-outline-primary" type="submit">Pretraži</button>
      </form>
      <form action="logout.php">
          <button type="submit" class="btn btn-outline-danger">Odjavi se</button>
      </form>
    </div>
  </div>
</nav>