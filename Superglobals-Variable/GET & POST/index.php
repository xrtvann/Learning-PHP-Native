<?php
include 'produk.php';
?>


<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Bootstrap demo</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>

  <div class="container my-5">
    <div class="card">
      <div class="card-header p-3 text-center">
        <h3>Daftar Produk</h3>
      </div>
      <div class="card-body p-5">
        <table class="table table-striped">
          <thead>
            <tr>
              <th>Kode Barang</th>
              <th>Nama Barang</th>
              <th>Harga</th>
              <th>Stok</th>
              <th>Detail</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($produk as $p): ?>
              <tr>
                <td><?= $p['kodebarang'] ?></td>
                <td><?= $p['nama'] ?></td>
                <td><?= $p['harga'] ?></td>
                <td><?= $p['stok'] ?></td>
                <td>
                  <a href="detailproduk.php?nama=<?= $p['nama'] ?>&harga=<?= $p['harga'] ?>&stok=<?= $p['stok'] ?>&berat=<?= $p['detail']['berat'] ?>&merk=<?= $p['detail']['merk'] ?>&kategori=<?= $p['detail']['kategori'] ?>" class="btn btn-success">Lihat Detail</a>
                </td>
              </tr>
            <?php endforeach ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>