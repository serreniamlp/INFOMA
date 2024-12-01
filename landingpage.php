<?php
session_start();
include('db.php');

// Proses login
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login_email'])) {
    $email = $_POST['login_email'];
    $password = $_POST['login_password'];

    // Cek apakah email dan password cocok dengan data di database
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        // Jika login berhasil, simpan ID pengguna di sesi
        $_SESSION['user_id'] = $user['id'];
        header('Location: profile.php');  // Alihkan ke halaman profil setelah login
    } else {
        $login_error = "Invalid email or password.";
    }
}

// Proses registrasi
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register_username'])) {
    $username = $_POST['register_username'];
    $email = $_POST['register_email'];
    $password = $_POST['register_password'];
    $confirm_password = $_POST['register_confirm_password'];

    if ($password === $confirm_password) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Simpan pengguna baru ke database
        $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        $stmt->execute([$username, $email, $hashed_password]);

        // Redirect ke halaman login setelah registrasi sukses
        header('Location: landingpage.php');
    } else {
        $register_error = "Passwords do not match.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Landing Page</title>
    <!-- Link Bootstrap css -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;300;400;700&display=swap" rel="stylesheet" />
    <style>
      body {
        font-family: "Poppins", sans-serif;
        background: linear-gradient(to bottom, #d9d9d9, #4f65f1);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        height: 100vh;
        margin: 0;
      }
      .center-content {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        height: 100vh;
      }
      .custom-modal-content {
        background-color: #f0f8ffe5;
        border-radius: 10px;
        border: 2px solid #000080;
      }
    </style>
  </head>
  <body>
    <div class="container center-content">
      <img src="assets/InfomaLogo.png" alt="Infoma Logo" class="img-fluid" />
      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#loginModal">Entry</button>
    </div>

    <!-- The Login Modal -->
    <div class="modal fade" id="loginModal">
      <div class="modal-dialog">
        <div class="modal-content custom-modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Sign In</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body">
            <form method="POST">
              <div class="form-group">
                <label for="login_email">Email address:</label>
                <input type="email" class="form-control" id="login_email" name="login_email" placeholder="Enter email" required />
              </div>
              <div class="form-group">
                <label for="login_password">Password:</label>
                <input type="password" class="form-control" id="login_password" name="login_password" placeholder="Enter password" required />
              </div>
              <?php if (isset($login_error)) { echo "<p class='text-danger'>$login_error</p>"; } ?>
              <button type="submit" class="btn btn-primary btn-block">Login</button>
            </form>
            <div class="text-center mt-2">
              <a href="#" class="d-block">Forgot Password?</a>
              <a href="#" class="d-block" data-toggle="modal" data-target="#registerModal" data-dismiss="modal">Create Account</a>
            </div>
            <div class="text-center mt-3">
              <p>Or login with</p>
              <button type="button" class="btn btn-light btn-block social-btn">
                <a href="homepage.html">
                  <img src="https://img.icons8.com/color/48/000000/google-logo.png" alt="Google" style="width: 20px; margin-right: 8px" />Sign in with Google
                </a>
              </button>
              <button type="button" class="btn btn-primary btn-block social-btn">
                <img src="https://img.icons8.com/color/48/000000/facebook-new.png" alt="Facebook" style="width: 20px; margin-right: 8px" />
                Sign in with Facebook
              </button>
              <button type="button" class="btn btn-dark btn-block social-btn">
                <img src="https://img.icons8.com/?size=512&id=de4vjQ6J061l&format=png" alt="Twitter" style="width: 20px; margin-right: 8px" />
                Sign in with Twitter
              </button>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Skip</button>
          </div>
        </div>
      </div>
    </div>

    <!-- The Register Modal -->
    <div class="modal fade" id="registerModal">
      <div class="modal-dialog">
        <div class="modal-content custom-modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Create Account</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body">
            <form method="POST">
              <div class="form-group">
                <label for="register_username">Username:</label>
                <input type="text" class="form-control" id="register_username" name="register_username" placeholder="Enter username" required />
              </div>
              <div class="form-group">
                <label for="register_email">Email address:</label>
                <input type="email" class="form-control" id="register_email" name="register_email" placeholder="Enter email" required />
              </div>
              <div class="form-group">
                <label for="register_password">Password:</label>
                <input type="password" class="form-control" id="register_password" name="register_password" placeholder="Enter password" required />
              </div>
              <div class="form-group">
                <label for="register_confirm_password">Confirm Password:</label>
                <input type="password" class="form-control" id="register_confirm_password" name="register_confirm_password" placeholder="Confirm password" required />
              </div>
              <?php if (isset($register_error)) { echo "<p class='text-danger'>$register_error</p>"; } ?>
              <button type="submit" class="btn btn-primary btn-block">Create Account</button>
            </form>
            <div class="text-center mt-2">
              <a href="#loginModal" class="d-block" data-toggle="modal" data-target="#loginModal" data-dismiss="modal">Already have an account? Login</a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Link Bootstrap js -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  </body>
</html>
