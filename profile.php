<?php
session_start();
include('db.php');

// Cek apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];

// Ambil data pengguna dari database
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch();

// Update data pengguna setelah formulir disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['username'])) {
        $username = $_POST['username'];
        $stmt = $pdo->prepare("UPDATE users SET username = ? WHERE id = ?");
        $stmt->execute([$username, $user_id]);
    } elseif (isset($_POST['email'])) {
        $email = $_POST['email'];
        $stmt = $pdo->prepare("UPDATE users SET email = ? WHERE id = ?");
        $stmt->execute([$email, $user_id]);
    } elseif (isset($_POST['phone'])) {
        $phone = $_POST['phone'];
        $stmt = $pdo->prepare("UPDATE users SET phone = ? WHERE id = ?");
        $stmt->execute([$phone, $user_id]);
    }
    header('Location: profile.php');
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Profile</title>
    <!-- Link Bootstrap css -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
      crossorigin="anonymous"
    />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
    />
    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
      rel="stylesheet"
    />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;300;400;700&display=swap"
      rel="stylesheet"
    />
    <style>
      body {
        font-family: "Poppins", sans-serif;
        background: linear-gradient(to bottom, #d9d9d9, #4f65f1);
      }
      .search-section {
        min-height: 60vh;
        background-image: url("assets/mahasiswa.png");
        background-size: cover;
        background-position: center;
        position: relative;
      }

      .search-section::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: rgba(0, 11, 39, 0.6);
        z-index: 1;
      }

      .search-section .container {
        position: relative;
        z-index: 2;
      }
    </style>
  </head>

  <body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light sticky-top" style="background-color: whitesmoke">
      <div class="container-fluid">
        <a class="navbar-brand ms-3" href="homepage.html"
          ><img src="assets/InfomaLogo.png" alt="Infoma Logo" width="110" height="50"
        /></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
            <li class="nav-item mx-3">
              <a class="nav-link active" aria-current="page" href="profile.php"><i class="bi bi-person-fill"
                  style="color: #4351e8"></i><span class="ms-2">Profile</span></a>
            </li>
            <li class="nav-item mx-3">
              <a class="nav-link" href="category.php"><i class="bi bi-grid-3x3-gap-fill" style="color: #4351e8"></i>
                <span class="ms-2">Category</span></a>
            </li>
            <li class="nav-item mx-3">
              <a class="nav-link" href="aboutus.php"><i class="bi bi-people-fill" style="color: #4351e8"></i>
                <span class="ms-2">About Us</span></a>
            </li>
            <li class="nav-item mx-3">
              <a class="nav-link" href="contactus.php"><i class="bi bi-envelope-fill" style="color: #4351e8"></i>
                <span class="ms-2">Contact Us</span></a>
            </li>
            <li class="nav-item mx-3">
              <a class="nav-link" href="faq.php"><i class="bi bi-chat-square-text-fill" style="color: #4351e8"></i>
                <span class="ms-2">FAQ</span></a>
            </li>
          </ul>
          <div>
            <span class="me-3"><i class="bi bi-box-arrow-in-left" style="color: #4351e8"></i><span class="ms-1">Sign
                In</span></span>
          </div>
        </div>
      </div>
    </nav>

    <!-- Search Section -->
    <section class="search-section d-flex flex-column align-items-center justify-content-center text-center">
      <div class="container">
        <h1 class="text-white fw-bold">PROFILE</h1>
      </div>
    </section>

    <!-- Profile -->
    <div class="container mt-5">
      <h2 class="text-center">Profile</h2>
      <div class="card p-4">
        <div class="mb-3">
          <label class="form-label"><strong>Current Username:</strong></label>
          <div class="d-flex align-items-center">
            <span id="username"><?php echo htmlspecialchars($user['username']); ?></span>
            <button class="btn btn-primary btn-sm ms-3" data-bs-toggle="modal" data-bs-target="#editUsernameModal">
              Edit
            </button>
          </div>
        </div>
        <div class="mb-3">
          <label class="form-label"><strong>Current Email:</strong></label>
          <div class="d-flex align-items-center">
            <span id="email"><?php echo htmlspecialchars($user['email']); ?></span>
            <button class="btn btn-primary btn-sm ms-3" data-bs-toggle="modal" data-bs-target="#editEmailModal">
              Edit
            </button>
          </div>
        </div>
        <div class="mb-3">
          <label class="form-label"><strong>Current Phone Number:</strong></label>
          <div class="d-flex align-items-center">
            <span id="phone"><?php echo htmlspecialchars($user['phone']); ?></span>
            <button class="btn btn-primary btn-sm ms-3" data-bs-toggle="modal" data-bs-target="#editPhoneModal">
              Edit
            </button>
          </div>
        </div>
      </div>
    </div>

    <!-- Edit Username Modal -->
    <div class="modal fade" id="editUsernameModal" tabindex="-1" aria-labelledby="editUsernameLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="editUsernameLabel">Edit Username</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form method="POST">
              <input type="text" class="form-control mb-3" name="username" placeholder="New Username"
                value="<?php echo htmlspecialchars($user['username']); ?>" required />
          </div>
          <div class="modal-footer">
            <button class="btn btn-primary" type="submit">Update</button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- Edit Email Modal -->
    <div class="modal fade" id="editEmailModal" tabindex="-1" aria-labelledby="editEmailLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="editEmailLabel">Edit Email</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form method="POST">
              <input type="email" class="form-control mb-3" name="email" placeholder="New Email"
                value="<?php echo htmlspecialchars($user['email']); ?>" required />
          </div>
          <div class="modal-footer">
            <button class="btn btn-primary" type="submit">Update</button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- Edit Phone Modal -->
    <div class="modal fade" id="editPhoneModal" tabindex="-1" aria-labelledby="editPhoneLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="editPhoneLabel">Edit Phone Number</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form method="POST">
              <input type="text" class="form-control mb-3" name="phone" placeholder="New Phone Number"
                value="<?php echo htmlspecialchars($user['phone']); ?>" required />
          </div>
          <div class="modal-footer">
            <button class="btn btn-primary" type="submit">Update</button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- Footer Section -->
    <footer class="text-white py-4 mt-5" style="background-color: #4f65f1">
      <div class="container">
        <div class="text-center pt-3">
          <p class="mb-0">© 2024 Infoma. All rights reserved.</p>
        </div>
      </div>
    </footer>

    <!-- Link Bootstrap js -->
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
