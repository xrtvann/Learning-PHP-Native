<?php

    $jsonfile = 'produk.json';

    $produk = file_exists($jsonfile) ? json_decode(file_get_contents($jsonfile), true): [];

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $kodeBarang = $_POST['kode_barang'];
        $namaBarang = $_POST['nama_barang'];
        $hargaBarang = $_POST['harga_barang'];
        $stokBarang = $_POST['stok_barang'];

        foreach ($produk as $p) {
            if ($p['kode_barang'] === $kodeBarang) {
                echo "<script>alert('Kode barang sudah ada !!!');</script>";
                header('Refresh:0');
                exit;
            }
        }

        $produk[] = [
            'kode_barang' => $kodeBarang,
            'nama_barang' => $namaBarang,
            'harga_barang' => $hargaBarang,
            'stok_barang'  => $stokBarang
        ];

        file_put_contents($jsonfile, json_encode($produk), JSON_PRETTY_PRINT);

        header('Location: index.php');
        exit;
    }
?>