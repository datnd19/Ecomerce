<?php
include '../config.php';
if (isset($_GET['action']) && $_GET['action'] == 'view') {
    $sql = "SELECT * FROM category ";
    $data = Query($sql, $connection);
    $output = '';
    if (empty($data)) {
        echo json_encode("No data found");
    } else {
        echo json_encode($data);
    }
}

if (isset($_POST['action']) && $_POST['action'] == 'addCategory') {
    $categoryName = $_POST['categoryName'];
    $description  = $_POST['description'];
    $sql = "SELECT * FROM category WHERE category_name = '$categoryName'";
    $existcategoryName = Query($sql, $connection);
    $output = "";
    if (count($existcategoryName) > 0) {
        $output .= "existCategoryName";
        echo $output;
        return;
    }
    $sql = "INSERT INTO `category` ( `category_name`, `description`) VALUES ('$categoryName','$description')";
    $data = Query($sql, $connection);
    echo "success";
}


if (isset($_GET['action']) && $_GET['action'] == 'delete') {
    $id = $_GET['id'];
    $sql = "DELETE FROM category WHERE category_id = '$id'; ";
    $data = Query($sql, $connection);
    echo "success";
}


if (isset($_GET['action']) && $_GET['action'] == 'getCategoryById') {
    $id = $_GET['id'];
    $sql = "SELECT * FROM category WHERE category_id = '$id'; ";
    $data = Query($sql, $connection);
    echo json_encode($data);
}

if (isset($_POST['action']) && $_POST['action'] == 'updateCategory') {
    $id = $_POST['id'];
    $categoryName = $_POST['categoryName'];
    $description  = $_POST['description'];
    $sql1 = "SELECT * FROM category WHERE category_name = '$categoryName'; and category_id != '$id'; ";
    $existcategoryName = Query($sql1, $connection);
    $output = "";
    if (count($existcategoryName) > 0) {
        $output .= "existCategoryName";
        echo $output;
        return;
    }
    $sql = "UPDATE `category` SET `description` = '$description' WHERE `category_name` = '$categoryName'";
    $data = Query($sql, $connection);
    echo "success";
}
