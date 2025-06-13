<?php
require_once '../config.php';
// Cek jika admin belum login, redirect ke halaman login
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: index.php");
    exit();
}

// ===================================================================
// LOGIKA UNTUK PROSES CRUD (CREATE, UPDATE, DELETE)
// ===================================================================

// Cek jika ada request POST (untuk Tambah atau Edit)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Aksi TAMBAH PRODUK
    if (isset($_POST['action']) && $_POST['action'] == 'tambah') {
        $nama_produk = mysqli_real_escape_string($conn, $_POST['nama_produk']);
        $deskripsi = mysqli_real_escape_string($conn, $_POST['deskripsi']);
        $harga = (int)$_POST['harga'];

        // Logika Upload Gambar
        $gambar = $_FILES['gambar']['name'];
        $target_dir = "../uploads/";
        $target_file = $target_dir . basename($gambar);
        move_uploaded_file($_FILES['gambar']['tmp_name'], $target_file);

        $sql = "INSERT INTO produk (nama_produk, deskripsi, harga, gambar) VALUES ('$nama_produk', '$deskripsi', '$harga', '$gambar')";
        mysqli_query($conn, $sql);
        header("Location: dashboard.php"); // Redirect untuk refresh halaman
        exit();
    }

    // Aksi EDIT PRODUK
    if (isset($_POST['action']) && $_POST['action'] == 'edit') {
        $id = (int)$_POST['id'];
        $nama_produk = mysqli_real_escape_string($conn, $_POST['nama_produk']);
        $deskripsi = mysqli_real_escape_string($conn, $_POST['deskripsi']);
        $harga = (int)$_POST['harga'];

        // Cek jika ada gambar baru yang diupload
        if (!empty($_FILES['gambar']['name'])) {
            $gambar = $_FILES['gambar']['name'];
            $target_dir = "../uploads/";
            $target_file = $target_dir . basename($gambar);
            move_uploaded_file($_FILES['gambar']['tmp_name'], $target_file);
            $sql = "UPDATE produk SET nama_produk='$nama_produk', deskripsi='$deskripsi', harga='$harga', gambar='$gambar' WHERE id=$id";
        } else {
            // Jika tidak ada gambar baru, jangan update kolom gambar
            $sql = "UPDATE produk SET nama_produk='$nama_produk', deskripsi='$deskripsi', harga='$harga' WHERE id=$id";
        }
        mysqli_query($conn, $sql);
        header("Location: dashboard.php"); // Redirect untuk refresh halaman
        exit();
    }
}

// Aksi HAPUS PRODUK (via GET request)
if (isset($_GET['action']) && $_GET['action'] == 'hapus') {
    $id = (int)$_GET['id'];

    // Ambil nama file gambar untuk dihapus dari folder
    $result = mysqli_query($conn, "SELECT gambar FROM produk WHERE id=$id");
    if($row = mysqli_fetch_assoc($result)) {
        $gambar_file = "../uploads/" . $row['gambar'];
        if(file_exists($gambar_file)) {
            unlink($gambar_file); // Hapus file gambar
        }
    }
    
    $sql = "DELETE FROM produk WHERE id=$id";
    mysqli_query($conn, $sql);
    header("Location: dashboard.php"); // Redirect untuk refresh halaman
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard - Toko Batik</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Admin Panel Toko Batik</a>
            <a href="logout.php" class="btn btn-danger">Logout</a>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Manajemen Produk</h2>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahModal">
                <i class="bi bi-plus-circle"></i> Tambah Produk Baru
            </button>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Gambar</th>
                        <th>Nama Produk</th>
                        <th>Deskripsi</th>
                        <th>Harga</th>
                        <th style="width: 15%;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM produk ORDER BY id DESC";
                    $result = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><img src="../uploads/<?php echo htmlspecialchars($row['gambar']); ?>" width="100" class="img-thumbnail"></td>
                        <td><?php echo htmlspecialchars($row['nama_produk']); ?></td>
                        <td><?php echo htmlspecialchars(substr($row['deskripsi'], 0, 100)) . '...'; ?></td>
                        <td>Rp <?php echo number_format($row['harga'], 0, ',', '.'); ?></td>
                        <td>
                            <button type="button" class="btn btn-sm btn-warning edit-btn" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#editModal"
                                    data-id="<?php echo $row['id']; ?>"
                                    data-nama="<?php echo htmlspecialchars($row['nama_produk']); ?>"
                                    data-deskripsi="<?php echo htmlspecialchars($row['deskripsi']); ?>"
                                    data-harga="<?php echo $row['harga']; ?>">
                                <i class="bi bi-pencil-square"></i> Edit
                            </button>
                            <a href="dashboard.php?action=hapus&id=<?php echo $row['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus produk ini?')">
                                <i class="bi bi-trash"></i> Hapus
                            </a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahModalLabel">Tambah Produk Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="dashboard.php" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <input type="hidden" name="action" value="tambah">
                        <div class="mb-3">
                            <label for="nama_produk" class="form-label">Nama Produk</label>
                            <input type="text" class="form-control" id="nama_produk" name="nama_produk" required>
                        </div>
                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="harga" class="form-label">Harga</label>
                            <input type="number" class="form-control" id="harga" name="harga" required>
                        </div>
                        <div class="mb-3">
                            <label for="gambar" class="form-label">Gambar Produk</label>
                            <input type="file" class="form-control" id="gambar" name="gambar" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan Produk</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Produk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="dashboard.php" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <input type="hidden" name="action" value="edit">
                        <input type="hidden" name="id" id="editId">
                        
                        <div class="mb-3">
                            <label for="editNamaProduk" class="form-label">Nama Produk</label>
                            <input type="text" class="form-control" id="editNamaProduk" name="nama_produk" required>
                        </div>
                        <div class="mb-3">
                            <label for="editDeskripsi" class="form-label">Deskripsi</label>
                            <textarea class="form-control" id="editDeskripsi" name="deskripsi" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="editHarga" class="form-label">Harga</label>
                            <input type="number" class="form-control" id="editHarga" name="harga" required>
                        </div>
                        <div class="mb-3">
                            <label for="editGambar" class="form-label">Gambar Produk (Kosongkan jika tidak ingin diubah)</label>
                            <input type="file" class="form-control" id="editGambar" name="gambar">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
    // Ketika tombol edit di-klik
    $('.edit-btn').on('click', function() {
        // Ambil data dari atribut data-*
        const id = $(this).data('id');
        const nama = $(this).data('nama');
        const deskripsi = $(this).data('deskripsi');
        const harga = $(this).data('harga');

        // Isi nilai-nilai tersebut ke dalam form di modal edit
        $('#editId').val(id);
        $('#editNamaProduk').val(nama);
        $('#editDeskripsi').val(deskripsi);
        $('#editHarga').val(harga);
    });
    </script>
</body>
</html>