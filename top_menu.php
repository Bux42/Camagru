<div class="navbar">
  <a class="navbar_home" href="/">Home</a>
  <?php
  session_start();
  if (isset($_SESSION['user'])) {
    include "navbars/navbar_user.php";
  } else {
    include "navbars/navbar.php";
  }
  ?>
</div>
