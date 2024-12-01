<?php
// Sertakan file db.php untuk koneksi database
include 'db.php';

$successMessage = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengambil data dari form
    $username = $_POST['username'];
    $email = $_POST['email'];
    $question = $_POST['question'];

    // Menyiapkan SQL dengan prepared statement
    $sql = "INSERT INTO faq (username, email, question) VALUES (:username, :email, :question)";
    
    // Menyiapkan statement untuk dieksekusi
    $stmt = $pdo->prepare($sql);  // Ganti $conn dengan $pdo

    // Bind parameter ke prepared statement
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':question', $question);

    // Menjalankan query dan memeriksa apakah berhasil
    if ($stmt->execute()) {
        // Jika berhasil, tampilkan modal pemberitahuan
        $successMessage = "FAQ berhasil terkirim!";
    } else {
        // Jika gagal, tampilkan pesan error
        echo "Error: " . $stmt->errorInfo()[2];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>FAQ</title>
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
      .faq-section {
        background-color: #e0e7ff;
        padding: 50px;
        border-radius: 20px;
        max-width: 900px;
        margin: auto;
        position: relative;
      }

      .faq-section h1 {
        font-size: 2.5rem;
        color: #4351e8;
        text-align: center;
        margin-bottom: 30px;
        font-weight: bold;
      }

      .faq-section form {
        margin-top: 20px;
      }

      .form-control {
        border: 2px solid #4351e8;
        border-radius: 10px;
        padding: 10px;
        font-size: 16px;
      }

      .form-control:focus {
        box-shadow: none;
        border-color: #2b3ea1;
      }

      .btn-submit {
        background-color: #4351e8;
        color: #fff;
        font-weight: bold;
        border-radius: 8px;
        padding: 10px 20px;
        font-size: 16px;
        display: block;
        margin: auto;
        width: 100px;
      }

      .btn-submit:hover {
        background-color: #2b3ea1;
        color: white;
      }
    </style>
  </head>

  <body>
    <!-- Navbar -->
    <nav
      class="navbar navbar-expand-lg navbar-light sticky-top"
      style="background-color: #ffffff"
    >
      <div class="container-fluid">
        <a class="navbar-brand ms-3" href="homepage.php"
          ><img
            src="assets/InfomaLogo.png"
            alt="Infoma Logo"
            width="110"
            height="50"
        /></a>

        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
            <li class="nav-item mx-3">
              <a class="nav-link" href="profile.php"
                ><i class="bi bi-person-fill" style="color: #4351e8"></i
                ><span class="ms-2">Profile</span></a
              >
            </li>
            <li class="nav-item mx-3">
              <a class="nav-link" href="category.php"
                ><i class="bi bi-grid-3x3-gap-fill" style="color: #4351e8"></i
                ><span class="ms-2">Category</span></a
              >
            </li>
            <li class="nav-item mx-3">
              <a class="nav-link" href="aboutus.php"
                ><i class="bi bi-people-fill" style="color: #4351e8"></i
                ><span class="ms-2">About Us</span></a
              >
            </li>
            <li class="nav-item mx-3">
              <a class="nav-link" href="contactus.php"
                ><i class="bi bi-envelope-fill" style="color: #4351e8"></i
                ><span class="ms-2">Contact Us</span></a
              >
            </li>
            <li class="nav-item mx-3">
              <a class="nav-link active" aria-current="page" href="faq.php"
                ><i
                  class="bi bi-chat-square-text-fill"
                  style="color: #4351e8"
                ></i
                ><span class="ms-2">FAQ</span></a
              >
            </li>
          </ul>
          <div>
            <span class="me-3"
              ><i class="bi bi-box-arrow-in-left" style="color: #4351e8"></i
              ><span class="ms-2">Sign In</span>
            </span>
          </div>
        </div>
      </div>
    </nav>

    <!-- Search Section -->
    <section
      class="search-section d-flex flex-column align-items-center justify-content-center text-center"
    >
      <div class="container">
        <h1 class="text-white fw-bold">FAQ</h1>
      </div>
    </section>

    <!-- FAQ Section -->
    <div class="container my-5">
      <div class="faq-section">
        <h1>Send Us a Message</h1>
        <form action="faq.php" method="POST">
          <div class="mb-4">
            <input
              type="text"
              class="form-control"
              id="username"
              name="username"
              placeholder="Username:"
              required
            />
          </div>
          <div class="mb-4">
            <input
              type="email"
              class="form-control"
              id="email"
              name="email"
              placeholder="Email:"
              required
            />
          </div>
          <div class="mb-4">
            <textarea
              class="form-control"
              id="question"
              name="question"
              placeholder="Question:"
              rows="5"
              required
            ></textarea>
          </div>
          <button type="submit" class="btn btn-submit">Send</button>
        </form>
      </div>
    </div>

    <!-- Modal Pemberitahuan -->
    <?php if ($successMessage): ?>
    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="successModalLabel">Success</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <?php echo $successMessage; ?>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
    <?php endif; ?>

    <!-- Footer Section -->
    <footer class="text-white py-4 mt-5" style="background-color: #4f65f1">
      <div class="container">
        <div class="row text-center text-md-start">
          <div class="col-md-4 mb-3">
            <h5 class="fw-bold">Contact</h5>
            <ul class="list-unstyled ps-0">
              <li class="mb-2">
                <i class="fas fa-envelope"></i> infoma@gmail.com
              </li>
              <li><i class="fas fa-phone"></i> +62 878 7433 8837</li>
            </ul>
          </div>
          <div class="col-md-4 mb-3">
            <h5 class="fw-bold">Follow Us</h5>
            <ul class="list-unstyled ps-0">
              <li class="mb-2">
                <a href="#" class="text-white text-decoration-none">
                  <i class="fab fa-instagram"></i> @InfomaOfficial
                </a>
              </li>
              <li class="mb-2">
                <a href="#" class="text-white text-decoration-none">
                  <i class="fab fa-facebook"></i> Infoma
                </a>
              </li>
              <li>
                <a href="#" class="text-white text-decoration-none">
                  <i class="fab fa-twitter"></i> @InfomaTwitter
                </a>
              </li>
            </ul>
          </div>
          <div class="col-md-4 mb-3">
            <h5 class="fw-bold">Location</h5>
            <p><i class="fas fa-map-marker-alt"></i> Jl. Likeblues, Bandung</p>
          </div>
        </div>
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

    <script>
      // Menampilkan modal pemberitahuan setelah berhasil
      <?php if ($successMessage): ?>
        var successModal = new bootstrap.Modal(document.getElementById('successModal'));
        successModal.show();
      <?php endif; ?>
    </script>
  </body>
</html>
