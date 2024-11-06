<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once 'dbConn.php';

$conn = connection();

if (isset($_SESSION['UserID']) && is_numeric($_SESSION['UserID'])) {
    $userId = $_SESSION['UserID'];

    // Retrieve user info from the database
    $sql = "SELECT * FROM Users WHERE UserID = $userId";
    $result = mysqli_query($conn, $sql);

    if ($result && $row = mysqli_fetch_assoc($result)) {
        $userInfo = $row;
        $pp = $row['ProfileImage'];
    } else {
        echo "Error fetching user info: " . mysqli_error($conn);
        exit();
    }
} else {
    $userInfo = null;
}
?>

<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">Novel Nook</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="mynavbar">
      <ul class="navbar-nav me-auto">
        <?php if (!$userInfo): ?>
        <li class="nav-item active">
          <a class="nav-link custom-hover" style="color: #FFFFFF;" href="login.php">Login</a>
        </li>
        <?php else: ?>
        <li class="nav-item active">
          <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Login</a>
        </li>
        <?php endif; ?>

        <?php if (!$userInfo): ?>
        <li class="nav-item active">
          <a class="nav-link custom-hover" style="color: #FFFFFF;" href="registration.php">Sign Up</a>
        </li>
        <?php else: ?>
        <li class="nav-item active">
          <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Already Signed In</a>
        </li>
        <?php endif; ?>
      </ul>

      <ul class="navbar-nav ms-auto">
        <li class="nav-item active">
          <a class="nav-link custom-hover" style="color: #FFFFFF;" href="index.php">Book Shelf</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link custom-hover" style="color: #FFFFFF;" href="userDashboard.php">
          <?php if (!$userInfo): ?>
            <i class="material-icons" style="font-size: 36px">&#xe853;</i>
          <?php else: ?>
          <div class="profile-img-container">
            <img src="<?php echo $userInfo['ProfileImage']; ?>" id="profile-img" alt="" class="img-fluid mb-3">
          </div>
          <?php endif; ?>
          </a>
        </li>
      </ul>

      <?php if ($userInfo): ?>
      <form class="d-flex ms-3" method="post" action="logout.php">
        <button name="logout" class="btn btn-primary">Log Out</button>
      </form>
      <?php endif; ?>
    </div>
  </div>
</nav>

<div class="sidebar offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="offcanvasNavbarLabel"><a href="index.php">Novel Nook</a></h5>
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
    <ul class="navbar-nav mr-auto">
      <?php if (!$userInfo): ?>
      <li class="nav-item active">
        <a class="nav-link custom-hover" href="login.php">Login</a>
      </li>
      <?php else: ?>
      <li class="nav-item active">
        <a class="nav-link disabled" href="#" tabindex="-1" style="color: darkgrey;" aria-disabled="true">Logged In</a>
      </li>
      <?php endif; ?>

      <?php if (!$userInfo): ?>
      <li class="nav-item active">
        <a class="nav-link custom-hover" href="registration.php">Sign Up</a>
      </li>
      <?php else: ?>
      <li class="nav-item active">
        <a class="nav-link disabled" href="#" tabindex="-1" style="color: darkgrey;" aria-disabled="true">Already Signed In</a>
      </li>
      <?php endif; ?>

      <li class="nav-item active"><a class="nav-link custom-hover" href="index.php">Book Shelf</a></li>
      <li class="nav-item active"><a class="nav-link custom-hover" href="userDashboard.php">User</a></li>
    </ul>
    <br>
    <?php if ($userInfo): ?>
    <ul class="navbar-nav mr-auto">
      <form class="d-flex" method="post" action="logout.php">
        <button name="logout" class="btn btn-primary">Log Out</button>
      </form>
    </ul>
    <?php endif; ?>
  </div>
</div>

<style>
  .custom-hover {
    color: black;
    transition: color 0.3s ease;
    text-decoration: none;
  }
  .navbar-toggler {
    border: none;
    outline: none;
    background: transparent;
    color: white;
    font-size: 1.5rem;
  }
  .custom-hover:hover {
    color: blue;
  }
  .profile-img-container {
    width: 30px;
    height: 30px;
    overflow: hidden;
    border-radius: 50%;
  }
  #profile-img {
    width: 30px;
    height: 30px;
  }
  .navbar-nav.ms-auto {
    margin-left: auto;
  }
</style>
