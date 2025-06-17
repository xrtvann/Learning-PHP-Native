<?php

include 'connection.php';

function show($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function generateProductCode($conn)
{
    global $conn;
    $query = "SELECT MAX(product_code) AS last_code FROM product";
    $result = mysqli_query($conn, $query);
    $data = mysqli_fetch_assoc($result);

    $lastCode = $data['last_code'];

    if ($lastCode) {
        $number = (int) substr($lastCode, 3);
        $number++;
    } else {
        $number = 1;
    }

    $newProductCode = 'PRD' . str_pad($number, 3, '0', STR_PAD_LEFT);

    return $newProductCode;
}

function store($data)
{
    global $conn;

    $productCode = htmlspecialchars($data['product_code']);
    $productName = htmlspecialchars($data['product_name']);
    $productPrice = htmlspecialchars($data['product_price']);
    $productStock = htmlspecialchars($data['product_stock']);

    $query = "INSERT INTO product VALUES('$productCode', '$productName', '$productPrice', '$productStock')";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}


function delete($id) {
    global $conn;

    $query = "DELETE FROM product WHERE product_code = '$id'";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}