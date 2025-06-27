<?php
session_start();
require 'functions.php';

if (!isset($_SESSION['login']) || !$_SESSION['login']) {
    header('Location: login.php');
    exit;
}

$pagination = pagination($conn, 'product');
$start = $pagination['start'];
$currentPage = $pagination['currentPage'];
$pageAmount = $pagination['pageAmount'];
$dataPerPage = $pagination['dataPerPage'];

$products = show("SELECT * FROM product LIMIT $start, $dataPerPage");
$newProductCode = generateProductCode($conn);

if (isset($_POST['store'])) {
    if (store($_POST) > 0) {

        header("Location: index.php");
        exit;
    } else {

        header("Location: index.php");
        exit;
    }
}

if (isset($_POST['update'])) {
    if (update($_POST) > 0) {

        header("Location: index.php");
        exit;
    } else {

        header("Location: index.php");
        exit;
    }
}

if (isset($_POST['search'])) {
    $keyword = $_POST['keyword'];
    $products = search($keyword);
}


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
                <div class="wrapper d-flex justify-content-between mb-4">
                    <div class="search-box col-md-6">
                        <form action="" method="post" class="d-flex align-items-center">

                            <input type="text" name="keyword" id="" class="form-control me-3" placeholder="Search">
                            <button type="submit" name="search" class="btn btn-secondary">Cari</button>
                        </form>
                    </div>
                    <a class="logout-button btn btn-danger" href="logout.php">Logout</a>
                </div>

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Barang</th>
                            <th>Gambar</th>
                            <th>Nama Barang</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th>Aksi</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = $start + 1; ?>
                        <?php foreach ($products as $product): ?>
                            <tr>
                                <td><?= $i++ ?></td>
                                <td><?= $product['product_code'] ?></td>
                                <td>
                                    <img src="image/<?= $product['image'] ?>" alt="" width="60">
                                </td>
                                <td><?= $product['name'] ?></td>
                                <td><?= $product['price'] ?></td>
                                <td><?= $product['stock'] ?></td>
                                <td>
                                    <a class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#edit<?= $product['product_code'] ?>">Edit</a>
                                    <a class="btn btn-danger" href="hapus.php?id=<?= $product['product_code'] ?>" onclick="return confirm('Yakin ?')">Hapus</a>
                                </td>

                            </tr>

                            <div class="modal fade" id="edit<?= $product['product_code'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">

                                <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Ubah Data</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="" method="post" enctype="multipart/form-data">
                                                <input type="hidden" name="old_image" value="<?= $product['image'] ?>">
                                                <div class="container-fluid">
                                                    <div class="row d-flex gap-4">
                                                        <div class="input-group">
                                                            <div class="col-3">
                                                                <label for="product_code" class="col-form-label">Kode Barang</label>
                                                            </div>
                                                            <div class="col-9">
                                                                <input type="text" id="product_code" class="form-control" name="product_code" value="<?= $product['product_code'] ?>" readonly required>
                                                            </div>
                                                        </div>
                                                        <div class="input-group">
                                                            <div class="col-3">
                                                                <label for="product_name" class="col-form-label">Nama Barang</label>
                                                            </div>
                                                            <div class="col-9">
                                                                <input type="text" id="product_name" name="product_name" class="form-control" value="<?= $product['name'] ?>" required>
                                                            </div>
                                                        </div>

                                                        <div class="input-group">
                                                            <div class="col-3">
                                                                <label for="product_price" class="col-form-label">Harga</label>
                                                            </div>
                                                            <div class="col-9">
                                                                <input type="number" name="product_price" id="product_price" class="form-control" value="<?= $product['price'] ?>" required>
                                                            </div>
                                                        </div>
                                                        <div class="input-group">
                                                            <div class="col-3">
                                                                <label for="product_stock" class="col-form-label">Stok</label>
                                                            </div>
                                                            <div class="col-9">
                                                                <input type="number" name="product_stock" id="product_stock" class="form-control" value="<?= $product['stock'] ?>" required>
                                                            </div>
                                                        </div>
                                                        <div class="input-group">
                                                            <div class="col-3">
                                                                <label for="product_image" class="col-form-label">Gambar</label>
                                                            </div>
                                                            <div class="col-9">
                                                                <input type="file" name="product_image" id="product_image" class="form-control">
                                                                <div class="img-wrapper card mt-5 p-3">
                                                                    <img src="image/<?= $product['image'] ?>" alt="" width="200">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                            <button type="submit" class="btn btn-primary" name="update">Simpan Perubahan</button>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach ?>
                    </tbody>
                </table>
                <div class="pagination d-flex justify-content-center mt-5">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">



                            <li class="page-item <?= ($currentPage == 1) ? 'disabled' : '' ?>"><a class="page-link" href="?page=<?= previousButton($currentPage) ?>">Previous</a></li>


                            <?php for ($i = 1; $i <= $pageAmount; $i++) : ?>
                                <?php if ($i == $currentPage) : ?>
                                    <li class="page-item"><a class="page-link active" href="?page=<?= $i; ?>"><?= $i; ?></a></li>
                                <?php else : ?>
                                    <li class="page-item"><a class="page-link" href="?page=<?= $i; ?>"><?= $i; ?></a></li>
                                <?php endif; ?>
                            <?php endfor; ?>
                            <li class="page-item <?= ($currentPage == $pageAmount) ? 'disabled' : '' ?>"><a class="page-link" href="?page=<?= nextButton($currentPage, $pageAmount) ?>">Next</a></li>
                        </ul>
                    </nav>
                </div>
                <button data-bs-toggle="modal" data-bs-target="#store" class="btn btn-success w-100 mt-4" type="submit" name="submit">Tambah Data </button>

                <div class="modal fade" id="store" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah Data</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="" method="post" enctype="multipart/form-data">
                                    <div class="container-fluid">
                                        <div class="row d-flex gap-4">
                                            <div class="input-group">
                                                <div class="col-3">
                                                    <label for="product_code" class="col-form-label">Kode Barang</label>
                                                </div>
                                                <div class="col-9">
                                                    <input type="text" id="product_code" class="form-control" name="product_code" value="<?= $newProductCode ?>" readonly required>
                                                </div>
                                            </div>
                                            <div class="input-group">
                                                <div class="col-3">
                                                    <label for="product_name" class="col-form-label">Nama Barang</label>
                                                </div>
                                                <div class="col-9">
                                                    <input type="text" id="product_name" name="product_name" class="form-control" required>
                                                </div>
                                            </div>

                                            <div class="input-group">
                                                <div class="col-3">
                                                    <label for="product_price" class="col-form-label">Harga</label>
                                                </div>
                                                <div class="col-9">
                                                    <input type="number" name="product_price" id="product_price" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="input-group">
                                                <div class="col-3">
                                                    <label for="product_stock" class="col-form-label">Stok</label>
                                                </div>
                                                <div class="col-9">
                                                    <input type="number" name="product_stock" id="product_stock" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="input-group">
                                                <div class="col-3">
                                                    <label for="product_image" class="col-form-label">Gambar</label>
                                                </div>
                                                <div class="col-9">
                                                    <input type="file" name="product_image" id="product_image" class="form-control" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                <button type="submit" class="btn btn-primary" name="store">Simpan</button>
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