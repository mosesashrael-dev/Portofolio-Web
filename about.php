<?php
// Bagian ini menangani permintaan data JSON untuk pembaruan grafik realtime
if (isset($_GET['action']) && $_GET['action'] === 'get_performa') {
    header('Content-Type: application/json');
    include_once("connection.php");

    $sql = "SELECT tahun, proyek_selesai, skor_performa FROM performa ORDER BY id ASC";
    $result = $conn->query($sql);

    $labels = [];
    $proyek = [];
    $skor   = [];

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $labels[] = $row['tahun'];
            $proyek[] = (int)$row['proyek_selesai'];
            $skor[]   = (int)$row['skor_performa'];
        }
    }

    echo json_encode([
        'labels' => $labels,
        'proyek' => $proyek,
        'skor'   => $skor
    ]);
    exit;
}
?>

<section id="About" class="py-5">
    <div class="container py-4">
        <div class="text-center mb-5">
            <h2 class="section-title font-weight-bold text-uppercase">About</h2>
            <div class="title-divider mx-auto bg-danger"></div>
        </div>
        <div class="row align-items-center">
            <div class="col-md-6 mb-4 mb-md-0 pr-md-5">
                <span class="text-danger font-weight-bold text-uppercase">Tentang Performa Kami</span>
                <h3 class="font-weight-bold mt-2 mb-3">Presisi, Kecepatan, dan Hasil Terukur</h3>
                <p class="text-muted">
                    Setiap proyek dikerjakan dengan standar kualitas tinggi dan dipantau secara berkala untuk memastikan hasil yang optimal serta kepuasan maksimal.
                </p>
               
                <div class="mt-4">
                    <div class="d-flex justify-content-between font-weight-bold mb-1">
                        <span>WEB DEVELOPMENT</span>
                        <span>95%</span>
                    </div>
                    <div class="progress mb-3" style="height: 8px;">
                        <div class="progress-bar bg-danger" role="progressbar" style="width: 95%" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>

                    <div class="d-flex justify-content-between font-weight-bold mb-1">
                        <span>UI/UX DESIGN</span>
                        <span>90%</span>
                    </div>
                    <div class="progress mb-3" style="height: 8px;">
                        <div class="progress-bar bg-dark" role="progressbar" style="width: 90%" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>

            
            <div class="col-md-6 text-center">
                <div class="about-img-wrapper p-4 bg-white rounded shadow-lg">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="font-weight-bold m-0 text-dark">Statistik Performa</h5>
                        <span class="badge badge-danger px-2 py-1">● Live Database</span>
                    </div>
                    
                    <div style="position: relative; height: 280px; width: 100%;">
                        <canvas id="performanceChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const ctx = document.getElementById("performanceChart");
    
    if (ctx && typeof Chart !== "undefined") {
        const performanceChart = new Chart(ctx, {
            type: "bar",
            data: {
                labels: [],
                datasets: [
                    {
                        label: "Proyek Selesai",
                        data: [],
                        backgroundColor: "rgba(220, 53, 69, 0.85)",
                        borderColor: "rgba(220, 53, 69, 1)",
                        borderWidth: 1,
                        borderRadius: 6,
                        order: 2
                    },
                    {
                        label: "Skor Performa (%)",
                        data: [],
                        type: "line",
                        borderColor: "#0f172a",
                        backgroundColor: "rgba(15, 23, 42, 0.1)",
                        borderWidth: 3,
                        tension: 0.3,
                        fill: false,
                        order: 1
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                animation: {
                    duration: 600
                },
                plugins: {
                    legend: {
                        position: "top"
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 110
                    }
                }
            }
        });

        // Fungsi mengambil data terbaru dari about.php
        function fetchPerformaRealtime() {
            fetch("about.php?action=get_performa")
                .then((response) => {
                    if (!response.ok) throw new Error("Network response was not ok");
                    return response.json();
                })
                .then((data) => {
                    const isChanged =
                        JSON.stringify(performanceChart.data.labels) !== JSON.stringify(data.labels) ||
                        JSON.stringify(performanceChart.data.datasets[0].data) !== JSON.stringify(data.proyek) ||
                        JSON.stringify(performanceChart.data.datasets[1].data) !== JSON.stringify(data.skor);

                    if (isChanged) {
                        performanceChart.data.labels = data.labels;
                        performanceChart.data.datasets[0].data = data.proyek;
                        performanceChart.data.datasets[1].data = data.skor;
                        performanceChart.update();
                    }
                })
                .catch((err) => console.error("Gagal memuat data realtime:", err));
        }

        // Panggil saat pertama kali dimuat, lalu ulangi setiap 3 detik
        fetchPerformaRealtime();
        setInterval(fetchPerformaRealtime, 3000);
    }
});
</script>