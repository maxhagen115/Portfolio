<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
      <?php if (isset($_SESSION['login'])) : ?>
        <?php if ($_SESSION['role'] == "user") : ?>
          <li class="nav-item">
            <a class="nav-link" href="/Portfolio/dist/portfolio.html">Terug naar portfolio</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="index.php?page=home">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="index.php?page=producten">Producten</a>
          </li>
        <?php elseif ($_SESSION['role'] == "admin") : ?>
          <li class="nav-item">
            <a class="nav-link" href="index.php?page=adminHome">Home admin</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="index.php?page=producten">Producten pagina</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="index.php?page=gebruikers">Gebruikers</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="index.php?page=orders">Aankopen van users</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="index.php?page=productToevoegen">Product toevoegen</a>
          </li>
        <?php endif; ?>
      <?php endif; ?>
    </ul>
    <ul class="navbar-nav navbar-right">
      <?php if (isset($_SESSION['login'])) : ?>

        <li class="nav-item">
          <a href="index.php?page=winkelmand"><i class="bi bi-cart" style="margin-right:15px; font-size: 1.5rem; color:cornflowerblue;"></i></a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="index.php?page=profiel">Profiel</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="index.php?page=logout">Loguit</a>
        </li>
      <?php else : ?>

        <li class="nav-item">
          <a class="nav-link" href="index.php?page=register">Register</a>
        </li>

        <li class="nav-item ">
          <a class="nav-link" href="index.php?page=login">Login</a>
        </li>
      <?php endif; ?>
    </ul>
  </div>
</nav>