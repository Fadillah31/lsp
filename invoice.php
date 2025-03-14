<?php
session_start();

// Pastikan ada data invoice
if (!isset($_SESSION['invoice'])) {
    header("Location: index.php");
    exit();
}
$invoice = $_SESSION['invoice'];
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail Sewa Mobil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header text-center">
                <h2>Detail Transaksi Sewa Mobil</h2>
            </div>
            <div class="card-body">
                <p><strong>Nama Pemesan:</strong> <?= $invoice['nama']; ?></p>
                <p><strong>Nomor Identitas:</strong> <?= $invoice['identitas']; ?></p>
                <p><strong>Jenis Kelamin:</strong> <?= $invoice['gender']; ?></p>
                <p><strong>Mobil yang dipilih:</strong> <?= $invoice['tipemobil']; ?></p>
                <p><strong>Harga per Hari:</strong> Rp<?= number_format($invoice['hargaPerMalam'], 0, ',', '.'); ?></p>
                <p><strong>Supir:</strong> <?= $invoice['includesupir'] ? "Ya" : "Tidak"; ?></p>
                <p><strong>Durasi Sewa:</strong> <?= $invoice['durasi']; ?> hari</p>
                <?php if ($invoice['durasi'] >= 3): ?>
                    <p><strong>Diskon:</strong> 10%</p>
                <?php endif; ?>

                <h4><strong>Total Bayar: </strong> <?= $invoice['totalBayar']; ?></h4>
            </div>
            <div class="card-footer text-center">
                <a href="index.php" class="btn btn-secondary">Kembali</a>
            </div>
        </div>
    </div>
</body>

</html>