<?php
// Pastikan file koneksi sudah dipanggil di bagian paling atas index.php
include("connection.php");

// Sesuaikan 'nama_tabel_anda' dengan nama tabel di phpMyAdmin (misal: services atau layanan)
$sql = "SELECT id, layanan, keterangan FROM services";
$result = $conn->query($sql);

// Array ikon Font Awesome agar tampilan 3 kartu tetap variatif
$icons = [
    "fas fa-tachometer-alt",
    "fas fa-laptop-code",
    "fas fa-database"
];
$index = 0;
?>

<section id="Services" class="service-section">
    <div class="service-overlay"></div>
    <div class="container position-relative">
        <div class="text-center text-white mb-5">
            <img class="service-image mb-3 shadow" src="assets/img/services.png" alt="Services">
            <h2 class="section-title font-weight-bold text-uppercase">Services</h2>
            <div class="title-divider mx-auto bg-danger"></div>
            <p class="text-light mt-3">lorem ipsum dolor sit amet consectetur adipiscing elit aut officia similique ex ullamco velit mollitia autem voluptate ut labore non</p>
        </div>
        <div class="row">
            <?php
            if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    // Memilih ikon berdasarkan urutan baris data
                    $iconClass = $icons[$index % count($icons)];
                    $index++;
            ?>
                    <div class="col-md-4 mb-4">
                        <div class="card service-card h-100 border-0 shadow-lg text-center p-4">
                            <div class="icon-box mx-auto mb-4">
                                <i class="<?php echo $iconClass; ?> fa-2x text-danger"></i>
                            </div>
                            <h4 class="font-weight-bold mb-3"><?php echo htmlspecialchars($row["layanan"]); ?></h4>
                            <p class="text-muted">
                                <?php echo htmlspecialchars($row["keterangan"]); ?>
                            </p>
                        </div>
                    </div>
            <?php
                }
            } else {
                echo '<div class="col-12 text-center text-white"><p>Data layanan belum tersedia.</p></div>';
            }
            ?>
        </div>
    </div>
</section>