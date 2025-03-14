<?php
$mobil = array(
    array("Fortuner", 500000, "fortuner.jpg"),
    array("Creta", 1000000, "creta.jpg"),
    array("CRV", 1500000, "crv.jpg")
);
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg" style="background-color: #000000;">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active text-white" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#">Transaksi</a>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- IMG BANNER -->
    <img src="img/banner.jpg" alt="IMG BANNER" class="img-fluid w-100" style="max-height: 400px; object-fit: contain;">
    <div class="container">
        <h2 class="text-center fw-bold">Daftar Mobil</h2>
        <div class="row">

            <?php foreach ($mobil as $produk => $list): ?>
                <div class="col-4">
                    <img src="img/<?= $list[2] ?>" class="ms-auto w-100" class="card-img-top" alt="Image">
                    <h5 class="card-title"><?= $list[0] ?></h5>
                    <p class="card-text">Rp.<?= number_format($list[1], 0, ',', '.'); ?></p>
                    <a href="transaksi.php?id=<?= $produk ?>" class="btn btn-dark">Pesan</a>
                </div>
            <?php endforeach;  ?>
        </div>

        <div class="container mt-5">
            <div class="row">
                <!-- Kolom Video -->
                <div class="col-md-6 d-flex justify-content-center">
                    <video width="100%" controls muted>
                        <source src="img/mobil.mp4" type="video/mp4">
                        Your browser does not support HTML video.
                    </video>
                </div>

                <!-- Kolom Tentang Kami -->
                <div class="col-md-6">
                    <h2 class="fw-bold">Tentang Kami</h2>
                    <p><strong>Alamat:</strong> Jl. Kelayan</p>
                    <p><strong>No. Telp:</strong> 0813297382</p>
                    <p><strong>Email:</strong> rawr@gmail.com</p>
                </div>
            </div>
        </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>