<?php
include '../config.php';
if (isset($_GET['action']) && $_GET['action'] == 'view') {
    $sql = "SELECT * FROM product ";
    $data = Query($sql, $connection);
    $output = '';
    if (empty($data)) {
        echo json_encode("No data found");
    } else {
        echo json_encode($data);
    }
}

if (isset($_POST['action']) && $_POST['action'] == 'addProduct') {
    $productName = $_POST['productName'];
    $category = $_POST['category'];
    $description  = $_POST['description'];
    $sql = "SELECT * FROM product WHERE product_name = '$productName'";
    $existProductName = Query($sql, $connection);
    $output = "";
    if (count($existProductName) > 0) {
        $output .= "existProductName";
        echo $output;
        return;
    }
    $sql = "INSERT INTO `product` ( `product_name`,`category_id`, `description`) VALUES ('$productName','$category','$description')";
    $data = Query($sql, $connection);
    echo "success";
}


if (isset($_GET['action']) && $_GET['action'] == 'delete') {
    $id = $_GET['id'];
    $sql = "DELETE FROM product WHERE product_id = '$id'; ";
    $data = Query($sql, $connection);
    echo "success";
}

if (isset($_GET['action']) && $_GET['action'] == 'getCategories') {
    $sql = "SELECT * FROM category ";
    $data = Query($sql, $connection);
    $output = '';
    if (empty($data)) {
        echo json_encode("No data found");
    } else {
        echo json_encode($data);
    }
}

if (isset($_GET['action']) && $_GET['action'] == 'getProductById') {
    $id = $_GET['id'];
    $sql = "SELECT * FROM product WHERE product_id = '$id'; ";
    $data = Query($sql, $connection);
    echo json_encode($data);
}

if (isset($_POST['action']) && $_POST['action'] == 'updateCategory') {
    $id = $_POST['id'];
    $productNameUpdate = $_POST['productNameUpdate'];
    $categoryUpdate = $_POST['categoryUpdate'];
    $descriptionUpdate  = $_POST['descriptionUpdate'];
    $sql1 = "SELECT * FROM product WHERE product_name = '$productNameUpdate' and product_id != '$id'; ";
    $existProductName = Query($sql1, $connection);
    $output = "";
    if (count($existProductName) > 0) {
        $output .= "existProductName";
        echo $output;
        return;
    }
    $sql = "UPDATE `product` SET `description` = '$descriptionUpdate', `product_name` = '$productNameUpdate', `category_id` = '$categoryUpdate' WHERE `product_id` = '$id'";
    $data = Query($sql, $connection);
    echo "success";
}



