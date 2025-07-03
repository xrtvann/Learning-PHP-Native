<?php

require_once __DIR__ . '/vendor/autoload.php';
require 'functions.php';

$products = show("SELECT * FROM product");

$mpdf = new \Mpdf\Mpdf();
$html = '
<style>
    table { border-collapse: collapse; width: 100%; }
    th, td { border: 1px solid #ddd; padding: 8px; }
    th { background: #f2f2f2; }
</style>
<h1 style="text-align: center">Daftar Barang</h1>
<table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode Barang</th>
                                <th>Gambar</th>
                                <th>Nama Barang</th>
                                <th>Harga</th>
                                <th>Stok</th>
                            </tr>
                        </thead>
                        <tbody>';

$i = 1;
foreach ($products as $product) {

    $html .= '<tr>
                <td>' . $i++ . '</td>
                <td>' . $product['product_code'] . '</td>
                <td><img src="image/' . $product['image'] . '" width="100"></td>
                <td>' . $product['name'] . '</td>
                <td>' . number_format($product['price'], 0, ',', '.') . '</td>
                <td>' . $product['stock'] . '</td>
              </tr>';
}
$html .= '</tbody>
          </table>';
$mpdf->WriteHTML($html);
$mpdf->Output('daftar_barang.pdf', 'D');
