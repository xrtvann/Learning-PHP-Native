<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assosiative array</title>
</head>

<body>
    <h3>Tambah Produk</h3>
    <hr>

    <!-- Form -->
    <form action="produk.php" method="post">
        <div style="display: block;">
            <label for="id">Kode Barang</label>
            <input type="text" name="kode_barang" id="id">
        </div>
        <div style="display: block;">
            <label for="nama">Nama</label>
            <input type="text" name="nama_barang" id="nama">
        </div>
        <div class="" style="display: block;">
            <label for="harga">Harga</label>
            <input type="number" name="harga_barang" id="harga">
        </div>
        <div class="" style="display: block;">
            <label for="stok">Stok</label>
            <input type="number" name="stok_barang" id="stok">
        </div>
        <div class="">
            <button type="submit" name="simpan">Tambah</button>
        </div>

    </form>
    <!-- End form -->


    <!-- table -->
     <h3>Daftar Produk</h3>
     <hr>
     
     <table border="1">
        <thead>
            <tr>
                <th>Kode Barang</th>
                <th>Nama</th>
                <th>Harga</th>
                <th>Stok</th>
            </tr>
        </thead>
        <tbody>
            <?php 

                $jsonfile = 'produk.json';
                $produk = file_exists($jsonfile) ? json_decode(file_get_contents($jsonfile), true) : [];
                foreach ($produk as $p) : ?>
                    <tr>
                        <td><?= $p['kode_barang']?></td>
                        <td><?= $p['nama_barang']?></td>
                        <td><?= $p['harga_barang']?></td>
                        <td><?= $p['stok_barang']?></td>
                    </tr>
                <?php endforeach ?>
        </tbody>
     </table>

</body>

</html>
