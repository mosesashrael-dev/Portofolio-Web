<?php
header('Content-Type: application/json');
include("connection.php");

$sql = "SELECT tahun, proyek_selesai, skor_performa FROM performa ORDER BY id ASC";
$result = $conn->query($sql);

$labels = [];
$proyek = [];
$skor = [];

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

$conn->close();
?>