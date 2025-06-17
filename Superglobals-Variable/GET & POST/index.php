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
        <button data-bs-toggle="modal" data-bs-target="#staticBackdrop" class="btn btn-success w-100 mt-4" type="submit" name="submit">Tambah Data </button>

        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah Data</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form action="store-data.php" method="post">
                  <div class="container-fluid">
                    <div class="row d-flex gap-4">
                      <div class="input-group">
                        <div class="col-3">
                          <label for="kode_barang" class="col-form-label">Kode Barang</label>
                        </div>
                        <div class="col-9">
                          <input type="text" id="kode_barang" class="form-control" name="kode_barang" required>
                        </div>
                      </div>
                      <div class="input-group">
                        <div class="col-3">
                          <label for="nama_barang" class="col-form-label">Nama Barang</label>
                        </div>
                        <div class="col-9">
                          <input type="text" id="nama_barang" name="nama_barang" class="form-control" required>
                        </div>
                      </div>

                      <div class="input-group">
                        <div class="col-3">
                          <label for="harga_barang" class="col-form-label">Harga</label>
                        </div>
                        <div class="col-9">
                          <input type="number" name="harga_barang" id="harga_barang" class="form-control" required>
                        </div>
                      </div>
                      <div class="input-group">
                        <div class="col-3">
                          <label for="stok" class="col-form-label">Stok</label>
                        </div>
                        <div class="col-9">
                          <input type="number" name="stok_barang" id="stok" class="form-control" required>
                        </div>
                      </div>
                      <div class="input-group">
                        <div class="col-3">
                          <label for="merek" class="col-form-label">Merek</label>
                        </div>
                        <div class="col-9">
                          <input type="text" name="merek_barang" id="merek" class="form-control" required>
                        </div>
                      </div>
                      <div class="input-group">
                        <div class="col-3">
                          <label for="berat" class="col-form-label">Berat</label>
                        </div>
                        <div class="col-9">
                          <div class="input-group">
                            <input type="number" name="berat_barang" id="berat" class="form-control" required>
                            <span class="input-group-text" id="basic-addon2">/kg</span>
                          </div>

                        </div>
                      </div>

                      <div class="input-group">
                        <div class="col-3">
                          <label for="kategori" class="col-form-label">kategori</label>
                        </div>
                        <div class="col-9">
                          <select required class="form-select" aria-label="Default select example" name="kategori_barang">
                            <option selected>Pilih Kategori</option>
                            <option value="Kebutuhan Rumah Tangga">Kebutuhan Rumah Tangga</option>
                            <option value="Elektronik">Elektronik</option>

                          </select>
                        </div>
                      </div>
                    </div>
                  </div>

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
              </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>