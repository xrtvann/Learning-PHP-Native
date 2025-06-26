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
    $productImage = uploadImage();

    if (!$productImage) {
        return false;
    }

    $query = "INSERT INTO product VALUES('$productCode', '$productName', '$productPrice', '$productStock', '$productImage')";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function update($data)
{
    global $conn;
    $productCode = htmlspecialchars($data['product_code']);
    $productName = htmlspecialchars($data['product_name']);
    $productPrice = htmlspecialchars($data['product_price']);
    $productStock = htmlspecialchars($data['product_stock']);
    $oldProductImage = htmlspecialchars($data['old_image']);

    if ($_FILES['product_image']['error'] === 4) {
        $productImage = $oldProductImage;
    } else {
        $productImage = uploadImage();
    }



    $query = "UPDATE product SET
             product_code = '$productCode',
             name = '$productName',
             price = '$productPrice',
             stock = '$productStock',
             image = '$productImage' 
             WHERE product_code = '$productCode'
    ";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}


function delete($id)
{
    global $conn;

    $query = "DELETE FROM product WHERE product_code = '$id'";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function search($keyword)
{

    $query = "SELECT * FROM product WHERE 
    name LIKE '%$keyword%' OR 
    product_code LIKE  '%$keyword%'";

    return show($query);
}

function  uploadImage()
{

    $name = $_FILES['product_image']['name'];
    $size = $_FILES['product_image']['size'];
    $error = $_FILES['product_image']['error'];
    $tmpName = $_FILES['product_image']['tmp_name'];

    if ($error === 4) {
        echo "<script>
            alert('Pilih gambar terlebih dahulu!')
        </script>";
        return false;
    }

    $extensionImageAccepted = ['jpg', 'jpeg', 'png'];
    $extensionImage = explode('.', $name);
    $extensionImage = strtolower(end($extensionImage));

    $randomImageName = uniqid();
    $randomImageName .= '.';
    $randomImageName .= $extensionImage;

    if (!in_array($extensionImage, $extensionImageAccepted)) {
        echo "<script>
            alert('Format gambar tidak didukung!')
        </script>";
        return false;
    }

    move_uploaded_file($tmpName, 'image/' . $randomImageName);

    return $randomImageName;
}


function register($data)
{
    global $conn;

    $username = strtolower(stripslashes($data['username']));
    $password = mysqli_escape_string($conn, $data['password']);
    $confirmationPassword = mysqli_escape_string($conn, $data['confirmation_password']);

    $checkUsername = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username'");

    if (mysqli_fetch_assoc($checkUsername)) {
        echo "<script>
            alert('Username sudah digunakan');location = 'registrasi.php';
        </script>";
        return false;
    }

    if ($password !== $confirmationPassword) {
        echo "<script>
            alert('Password tidak sesuai');location = 'registrasi.php';
        </script>";
        return false;
    }

    $password = password_hash($password, PASSWORD_DEFAULT);

    mysqli_query($conn, "INSERT INTO user VALUES(NULL,'$username', '$password')");

    return mysqli_affected_rows($conn);
}

function login()
{
    global $conn;

    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);

    $result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");

    if (mysqli_num_rows($result) === 1) {

        $row = mysqli_fetch_assoc($result);

        if (password_verify($password, $row['password'])) {

            $_SESSION['login'] = true;

            if (isset($_POST['remember_me'])) {
                setcookie('id', $row['id'], time() + 60);
                setcookie('key', hash('sha256', $row['username']), time() + 60);
            }

            header('Location: index.php');
            return true;
        }
    }

    return false;
}

