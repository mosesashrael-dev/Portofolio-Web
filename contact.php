<?php
// Pastikan koneksi database tersedia
include_once("connection.php");

$pesan_status = "";

// Cek apakah form dikirim menggunakan metode POST
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["kirim_pesan"])) {
    $nama  = trim($_POST["nama"]);
    $email = trim($_POST["email"]);
    $pesan = trim($_POST["pesan"]);

    if (!empty($nama) && !empty($email) && !empty($pesan)) {
        // Menggunakan prepared statement untuk mencegah SQL Injection
        $stmt = $conn->prepare("INSERT INTO contact (nama, email, pesan) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $nama, $email, $pesan);

        if ($stmt->execute()) {
            $pesan_status = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Berhasil!</strong> Terima kasih, pesan Anda telah tersimpan ke database.
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                             </div>';
        } else {
            $pesan_status = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>Gagal!</strong> Terjadi kesalahan saat menyimpan pesan: ' . htmlspecialchars($stmt->error) . '
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                             </div>';
        }
        $stmt->close();
    } else {
        $pesan_status = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong>Peringatan!</strong> Semua kolom wajib diisi.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                         </div>';
    }
}
?>

<section id="Contact" class="py-5 bg-contact">
    <div class="container py-4">
        <div class="text-center mb-5">
            <h2 class="section-title font-weight-bold text-uppercase text-white">Contact</h2>
            <div class="title-divider mx-auto bg-danger"></div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card border-0 shadow-lg p-4 p-md-5 contact-card">
                    
                    
                    <?php echo $pesan_status; ?>

                    <form action="#Contact" method="POST">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="nama" class="font-weight-bold small text-uppercase">Nama Lengkap</label>
                                <input type="text" class="form-control form-control-lg custom-input" id="nama" name="nama" placeholder="Masukkan nama Anda" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="email" class="font-weight-bold small text-uppercase">Alamat Email</label>
                                <input type="email" class="form-control form-control-lg custom-input" id="email" name="email" placeholder="nama@email.com" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="pesan" class="font-weight-bold small text-uppercase">Pesan</label>
                            <textarea class="form-control form-control-lg custom-textarea" id="pesan" name="pesan" rows="5" placeholder="Tuliskan detail proyek atau pesan Anda..." required></textarea>
                        </div>

                        <div class="text-center mt-4">
                            <button type="submit" name="kirim_pesan" class="btn btn-danger btn-lg px-5 py-3 rounded-pill font-weight-bold shadow">
                                <i class="fas fa-paper-plane mr-2"></i> Kirim Pesan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>