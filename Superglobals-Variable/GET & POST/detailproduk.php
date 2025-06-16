<?php
$nama = $_GET['nama'];
$harga = $_GET['harga'];
$stok = $_GET['stok'];
$berat = $_GET['berat'];
$merk = $_GET['merk'];
$kategori = $_GET['kategori'];

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <style>
        .detail-produk {
            display: grid;
            grid-template-columns: 120px 10px auto;
            /* Label, titik dua, dan isi */
            gap: 8px;
            font-size: 18px;
            align-items: center;
            /* Menjaga semua elemen tetap sejajar */
        }

        .label {
            font-weight: bold;
            text-align: left;
        }

        .separator {
            text-align: right;
            width: 10px;
        }
    </style>
</head>

<body>

    <div class="container my-5">
        <div class="card" style="width: 70rem;">
            <div class="card-body">
                <h3 class="card-title p-3"><?= $nama ?></h3>
                <div class="detail-produk p-3 mb-5">
                    <span class="label">Harga</span> <span class="separator">:</span> <span><?= $harga ?></span>
                    <span class="label">Stok</span> <span class="separator">:</span> <span><?= $stok ?></span>
                    <span class="label">Berat</span> <span class="separator">:</span> <span><?= $berat ?></span>
                    <span class="label">Merk</span> <span class="separator">:</span> <span><?= $merk ?></span>
                    <span class="label">Kategori</span> <span class="separator">:</span> <span><?= $kategori ?></span>

                </div>

                <a href="index.php" class="btn btn-primary">Kembali</a>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>