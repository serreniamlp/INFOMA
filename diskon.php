<?php
session_start();
include('db.php');

// Proses menambah diskon
if (isset($_POST['submit_tambah_diskon'])) {
    $judul_diskon = htmlspecialchars($_POST['judul_diskon']);
    $deskripsi_diskon = htmlspecialchars($_POST['deskripsi_diskon']);
    $persentase_diskon = $_POST['persentase_diskon'];
    
    // Masukkan data diskon ke dalam tabel
    $stmt = $pdo->prepare("INSERT INTO diskon (judul_diskon, deskripsi_diskon, persentase_diskon) VALUES (?, ?, ?)");
    $stmt->execute([$judul_diskon, $deskripsi_diskon, $persentase_diskon]);
    header('Location: diskon.php');
    exit();
}

// Proses edit diskon
if (isset($_POST['submit_edit_diskon'])) {
    $id = $_POST['id'];
    $judul_diskon = htmlspecialchars($_POST['judul_diskon']);
    $deskripsi_diskon = htmlspecialchars($_POST['deskripsi_diskon']);
    $persentase_diskon = $_POST['persentase_diskon'];
    
    // Update data diskon
    $stmt = $pdo->prepare("UPDATE diskon SET judul_diskon = ?, deskripsi_diskon = ?, persentase_diskon = ? WHERE id = ?");
    $stmt->execute([$judul_diskon, $deskripsi_diskon, $persentase_diskon, $id]);
    header('Location: diskon.php');
    exit();
}

// Proses hapus diskon
if (isset($_GET['delete_id_diskon'])) {
    $id = $_GET['delete_id_diskon'];
    $stmt = $pdo->prepare("DELETE FROM diskon WHERE id = ?");
    $stmt->execute([$id]);
    header('Location: diskon.php');
    exit();
}

// Ambil data diskon untuk ditampilkan
$stmt = $pdo->prepare("SELECT * FROM diskon ORDER BY created_at DESC");
$stmt->execute();
$diskon = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Diskon - Dashboard Infoma</title>
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
                            <a href="landingpage.php" class="btn btn-danger">Ya, Logout</a>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- Tambah Diskon -->
        <div class="mb-4">
            <button class="btn btn-success" data-toggle="modal" data-target="#tambahModalDiskon">Tambah Diskon</button>
        </div>

        <!-- Tabel Diskon -->
        <h4>Diskon</h4>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Judul Diskon</th>
                    <th>Deskripsi</th>
                    <th>Persentase Diskon</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($diskon as $row): ?>
                    <tr>
                        <td><?= $row['id'] ?></td>
                        <td><?= $row['judul_diskon'] ?></td>
                        <td><?= $row['deskripsi_diskon'] ?></td>
                        <td><?= $row['persentase_diskon'] ?>%</td>
                        <td>
                            <!-- Edit Button -->
                            <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editModalDiskon<?= $row['id'] ?>">Edit</button>
                            <!-- Hapus Button -->
                            <a href="?delete_id_diskon=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this item?')">Hapus</a>
                        </td>
                    </tr>

                    <!-- Modal Edit Diskon -->
                    <div class="modal fade" id="editModalDiskon<?= $row['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabelDiskon<?= $row['id'] ?>" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editModalLabelDiskon<?= $row['id'] ?>">Edit Diskon</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form method="POST">
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="judul_diskon">Judul Diskon</label>
                                            <input type="text" class="form-control" name="judul_diskon" value="<?= $row['judul_diskon'] ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="deskripsi_diskon">Deskripsi</label>
                                            <textarea class="form-control" name="deskripsi_diskon" rows="3" required><?= $row['deskripsi_diskon'] ?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="persentase_diskon">Persentase Diskon</label>
                                            <input type="number" class="form-control" name="persentase_diskon" value="<?= $row['persentase_diskon'] ?>" required>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" name="submit_edit_diskon" class="btn btn-primary">Simpan Perubahan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- Modal Tambah Diskon -->
        <div class="modal fade" id="tambahModalDiskon" tabindex="-1" role="dialog" aria-labelledby="tambahModalLabelDiskon" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tambahModalLabelDiskon">Tambah Diskon</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="POST">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="judul_diskon">Judul Diskon</label>
                                <input type="text" class="form-control" name="judul_diskon" placeholder="Masukkan judul diskon" required>
                            </div>
                            <div class="form-group">
                                <label for="deskripsi_diskon">Deskripsi</label>
                                <textarea class="form-control" name="deskripsi_diskon" rows="3" placeholder="Masukkan deskripsi diskon" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="persentase_diskon">Persentase Diskon</label>
                                <input type="number" class="form-control" name="persentase_diskon" placeholder="Masukkan persentase diskon" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" name="submit_tambah_diskon" class="btn btn-success">Tambah Diskon</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Link Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </div>
</body>
</html>
