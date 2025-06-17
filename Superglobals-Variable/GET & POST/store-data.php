<?php
// 1. Ambil data POST
$kode = $_POST['kode_barang'];
$nama = $_POST['nama_barang'];
$harga = $_POST['harga_barang'];
$stok = $_POST['stok_barang'];
$merek = $_POST['merek_barang'];
$berat = $_POST['berat_barang'];
$kategori = $_POST['kategori_barang'];

// 2. Load produk lama
include 'produk.php';

// 3. Tambahkan produk baru ke array
$produk[] = [
  'kodebarang' => $kode,
  'nama' => $nama,
  'harga' => $harga,
  'stok' => $stok,
  'detail' => [
    'berat' => $berat,
    'merk' => $merek,
    'kategori' => $kategori
  ]
];

// 4. Simpan array kembali ke file produk.php
$isi = "<?php\n\$produk = " . var_export($produk, true) . ";\n?>";
file_put_contents('produk.php', $isi);

// 5. Redirect kembali ke index
header('Location: index.php');
exit;
?>
