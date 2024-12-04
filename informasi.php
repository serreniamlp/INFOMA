<?php
session_start();
include('db.php');

// Proses menambah informasi
if (isset($_POST['submit_tambah_informasi'])) {
    $judul_informasi = htmlspecialchars($_POST['judul_informasi']);
    $deskripsi_informasi = htmlspecialchars($_POST['deskripsi_informasi']);
    
    // Masukkan data informasi ke dalam tabel
    $stmt = $pdo->prepare("INSERT INTO informasi (judul, deskripsi) VALUES (?, ?)");
    $stmt->execute([$judul_informasi, $deskripsi_informasi]);
    header('Location: informasi.php');
    exit();
}

// Proses edit informasi
if (isset($_POST['submit_edit_informasi'])) {
    $id = $_POST['id'];
    $judul_informasi = htmlspecialchars($_POST['judul_informasi']);
    $deskripsi_informasi = htmlspecialchars($_POST['deskripsi_informasi']);
    
    // Update data informasi
    $stmt = $pdo->prepare("UPDATE informasi SET judul = ?, deskripsi = ? WHERE id = ?");
    $stmt->execute([$judul_informasi, $deskripsi_informasi, $id]);
    header('Location: informasi.php');
    exit();
}

// Proses hapus informasi
if (isset($_GET['delete_id_informasi'])) {
    $id = $_GET['delete_id_informasi'];
    $stmt = $pdo->prepare("DELETE FROM informasi WHERE id = ?");
    $stmt->execute([$id]);
    header('Location: informasi.php');
    exit();
}

// Ambil data informasi untuk ditampilkan
$stmt = $pdo->prepare("SELECT * FROM informasi ORDER BY created_at DESC");
$stmt->execute();
$informasi = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informasi - Dashboard Infoma</title>
    <!-- Link Bootstrap Css -->
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
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
    <div class="container mt-5">
        <!-- Header Navigasi -->
        <header class="d-flex justify-content-between align-items-center mb-4">
            <img src="assets/InfomaLogo.png" alt="Infoma Logo" class="img-fluid" style="max-width: 150px;">
            <nav class="nav">
                <a href="informasi.php" class="nav-link">Informasi</a>
                <a href="diskon.php" class="nav-link">Diskon</a>
                <a href="latest_update.php" class="nav-link">Latest Update</a>
            </nav>
            <!-- Button logout -->
            <div>
                <button
                type="button"
                class="btn mx-3"
                data-bs-toggle="modal"
                data-bs-target="#logoutModal"
                >
                <i class="bi bi-box-arrow-left" style="color: #4351e8"></i>
                </button>
            </div>
            <!-- Modal Logout -->
            <div
            class="modal fade"
            id="logoutModal"
            tabindex="-1"
            aria-labelledby="logoutModalLabel"
            aria-hidden="true"
            >
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="logoutModalLabel">Konfirmasi Logout</h5>
                            <button
                            type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"
                            aria-label="Close"
                            ></button>
                        </div>
                        <div class="modal-body">Apakah Anda yakin ingin logout?</div>
                        <div class="modal-footer">
                            <button
                            type="button"
                            class="btn btn-secondary"
                            data-bs-dismiss="modal"
                            >
                            Tidak
                            </button>
                            <a href="logout.php" class="btn btn-danger">Ya, Logout</a>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- Tambah Informasi -->
        <div class="mb-4">
            <button class="btn btn-success" data-toggle="modal" data-target="#tambahModalInformasi">Tambah Informasi</button>
        </div>

        <!-- Tabel Informasi -->
        <h4>Informasi</h4>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Judul</th>
                    <th>Deskripsi</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($informasi as $row): ?>
                    <tr>
                        <td><?= $row['id'] ?></td>
                        <td><?= $row['judul'] ?></td>
                        <td><?= $row['deskripsi'] ?></td>
                        <td>
                            <!-- Edit Button -->
                            <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editModalInformasi<?= $row['id'] ?>">Edit</button>
                            <!-- Hapus Button -->
                            <a href="?delete_id_informasi=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this item?')">Hapus</a>
                        </td>
                    </tr>

                    <!-- Modal Edit Informasi -->
                    <div class="modal fade" id="editModalInformasi<?= $row['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabelInformasi<?= $row['id'] ?>" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editModalLabelInformasi<?= $row['id'] ?>">Edit Informasi</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form method="POST">
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="judul_informasi">Judul</label>
                                            <input type="text" class="form-control" name="judul_informasi" value="<?= $row['judul'] ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="deskripsi_informasi">Deskripsi</label>
                                            <textarea class="form-control" name="deskripsi_informasi" rows="3" required><?= $row['deskripsi'] ?></textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" name="submit_edit_informasi" class="btn btn-primary">Simpan Perubahan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- Modal Tambah Informasi -->
        <div class="modal fade" id="tambahModalInformasi" tabindex="-1" role="dialog" aria-labelledby="tambahModalLabelInformasi" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tambahModalLabelInformasi">Tambah Informasi</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="POST">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="judul_informasi">Judul</label>
                                <input type="text" class="form-control" name="judul_informasi" placeholder="Masukkan judul informasi" required>
                            </div>
                            <div class="form-group">
                                <label for="deskripsi_informasi">Deskripsi</label>
                                <textarea class="form-control" name="deskripsi_informasi" rows="3" placeholder="Masukkan deskripsi informasi" required></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" name="submit_tambah_informasi" class="btn btn-success">Tambah Informasi</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Link Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"
        ></script>
    </div>
</body>
</html>
