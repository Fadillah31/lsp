<?php
session_start();

$totalBayar = "";
$errorIdentitas = "";
$hargaPerMalam = "";
$list = isset($_GET["id"]) ? (int) $_GET["id"] : 0;

// Data mobil
$mobil = array(
    array("Fortuner", 500000, "fortuner.jpg"),
    array("Creta", 1000000, "creta.jpg"),
    array("CRV", 1500000, "crv.jpg")
);

// Daftar harga mobil
$hargamobil = [
    "Fortuner" => 500000,
    "Creta" => 1000000,
    "CRV" => 1500000
];

// Pilihan mobil
$pilih_mobil = $_POST['car'] ?? ($mobil[$list][0] ?? '');

// Cek harga sesuai pilihan mobil
if (!empty($pilih_mobil) && isset($hargamobil[$pilih_mobil])) {
    $hargaPerMalam = $hargamobil[$pilih_mobil];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'] ?? '';
    $gender = $_POST['gender'] ?? '';
    $listentitas = $_POST['identitas'] ?? '';
    $tipemobil = $_POST['car'] ?? '';
    $tanggal = $_POST['tanggal'] ?? '';
    $durasi = $_POST['durasi'] ?? 0;
    $includesupir = isset($_POST['supir']);

    // Validasi nomor identitas (16 digit angka)
    if (!preg_match('/^\d{16}$/', $listentitas)) {
        $errorIdentitas = "Nomor identitas harus 16 digit angka!";
    }

    // Hitung total bayar jika tidak ada error
    if (empty($errorIdentitas) && !empty($tipemobil) && !empty($durasi)) {
        $total = $hargamobil[$tipemobil] * $durasi;

        // Diskon 10% jika menyewa lebih dari 3 hari
        if ($durasi >= 3) {
            $total *= 0.9;
        }

        // Tambahan biaya supir Rp80.000
        if ($includesupir) {
            $total += 100000;
        }

        $totalBayar = "Rp" . number_format($total, 0, ',', '.');
    }

    // Simpan data ke session jika valid
    if (isset($_POST['simpan']) && empty($errorIdentitas)) {
        $_SESSION['invoice'] = [
            'nama' => $nama,
            'gender' => $gender,
            'identitas' => $listentitas,
            'tipemobil' => $tipemobil,
            'hargaPerMalam' => $hargamobil[$tipemobil],
            'tanggal' => $tanggal,
            'durasi' => $durasi,
            'includesupir' => $includesupir,
            'totalBayar' => $totalBayar
        ];

        header("Location: invoice.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Form Pemesanan Mobil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h2 class="text-center">Form Pemesanan</h2>
        <form method="POST">
            <div class="mb-3">
                <label for="nama" class="form-label">Nama Pemesan</label>
                <input type="text" class="form-control" id="nama" name="nama" value="<?= htmlspecialchars($_POST['nama'] ?? '') ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Jenis Kelamin</label>
                <div>
                    <input type="radio" id="laki" name="gender" value="Laki-laki" <?= (isset($_POST['gender']) && $_POST['gender'] == "Laki-laki") ? "checked" : "" ?>> <label for="laki">Laki-laki</label>
                    <input type="radio" id="perempuan" name="gender" value="Perempuan" <?= (isset($_POST['gender']) && $_POST['gender'] == "Perempuan") ? "checked" : "" ?>> <label for="perempuan">Perempuan</label>
                </div>
            </div>

            <div class="mb-3">
                <label for="identitas" class="form-label">Nomor Identitas</label>
                <input type="text" class="form-control <?= !empty($errorIdentitas) ? 'is-invalid' : '' ?>" id="identitas" name="identitas" maxlength="16" value="<?= htmlspecialchars($_POST['identitas'] ?? '') ?>" required>
                <?php if (!empty($errorIdentitas)): ?>
                    <div class="invalid-feedback"><?= $errorIdentitas; ?></div>
                <?php endif; ?>
            </div>

            <div class="mb-3">
                <label for="car" class="form-label">Pilih Mobil</label>
                <select class="form-select" id="car" name="car" onchange="this.form.submit()">
                    <?php foreach ($mobil as $list): ?>
                        <option value="<?= $list[0] ?>" <?= ($list[0] === $pilih_mobil) ? 'selected' : '' ?>>
                            <?= $list[0] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="harga" class="form-label">Harga</label>
                <input type="text" class="form-control" id="harga" name="harga" value="<?= $hargaPerMalam ? "Rp" . number_format($hargaPerMalam, 0, ',', '.') : '' ?>" readonly>
            </div>

            <div class="mb-3">
                <label for="tanggal" class="form-label">Tanggal Pesan</label>
                <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?= $_POST['tanggal'] ?? '' ?>" required>
            </div>

            <div class="mb-3">
                <label for="durasi" class="form-label">Durasi</label>
                <input type="number" class="form-control" id="durasi" name="durasi" min="1" value="<?= $_POST['durasi'] ?? '' ?>" required>
            </div>

            <div class="mb-3">
                <input type="checkbox" id="supir" name="supir" <?= isset($_POST['supir']) ? "checked" : "" ?>>
                <label for="supir">Termasuk Supir</label>
            </div>

            <div class="mb-3">
                <label for="totalBayar" class="form-label">Total Bayar</label>
                <input type="text" class="form-control" id="totalBayar" value="<?= $totalBayar; ?>" readonly>
            </div>
            <button type="submit" class="btn btn-primary">Hitung Total Bayar</button>
            <button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
        </form>
    </div>
</body>

</html>