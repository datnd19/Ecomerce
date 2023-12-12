<?php
include '../config.php';
if (isset($_GET['action']) && $_GET['action'] == 'view') {
    $sql = "SELECT * FROM product_color ";
    $data = Query($sql, $connection);
    $output = '';
    if (empty($data)) {
        echo json_encode("No data found");
    } else {
        echo json_encode($data);
    }
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

if (isset($_GET['action']) && $_GET['action'] == 'getProducts') {
    $sql = "SELECT * FROM product ";
    $data = Query($sql, $connection);
    $output = '';
    if (empty($data)) {
        echo json_encode("No data found");
    } else {
        echo json_encode($data);
    }
}

if (isset($_GET['action']) && $_GET['action'] == 'delete') {
    $id = $_GET['id'];
    $sql1 = "DELETE FROM product_image WHERE product_color_id = '$id'; ";
    $data1 = Query($sql1, $connection);
    $sql = "DELETE FROM product_color WHERE product_color_id = '$id'; ";
    $data = Query($sql, $connection);
    echo "success";
}


if (isset($_POST['action']) && $_POST['action'] == 'addProductColor') {
    $categoryName = $_POST['categoryId'];
    $productId = $_POST['productId'];
    $color = $_POST['color'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $images = $_POST['images'];
    $output = "";
    $sql1 = "SELECT * FROM product_color WHERE color = '$color' and product_id = '$productId'; ";
    $existcategoryName = Query($sql1, $connection);
    if (count($existcategoryName) > 0) {
        $output .= "existColor";
        echo $output;
        return;
    }
    $sql2 = "INSERT INTO `product_color` ( `color`, `quantity`, `price`,  `product_id`) VALUES ('$color','$quantity', '$price','$productId')";
    $data = Query($sql2, $connection);
    $sql3 = "SELECT product_color_id FROM product_color ORDER BY product_color_id DESC LIMIT 1;";
    $rs = Query($sql3, $connection);
    $id = $rs[0]['product_color_id'];
    $imagesString = $_POST['images'];
    $images = explode(',', $imagesString);
    foreach ($images as $image) {
        $sql3 = "INSERT INTO `product_image` ( `image`, `product_color_id`) VALUES ('$image','$id')";
        $data3 = Query($sql3, $connection);
    }
    echo "success";
}




if (isset($_GET['action']) && $_GET['action'] == 'getProductColorById') {
    $id = $_GET['id'];
    $sql = "SELECT * FROM product_color WHERE product_color_id = '$id'; ";
    $data = Query($sql, $connection);
    $sql1 = "SELECT * FROM product_image WHERE product_color_id = '$id'; ";
    $data1 = Query($sql1, $connection);
    $join = array_merge($data, $data1);
    echo json_encode($join);
}

if (isset($_POST['action']) && $_POST['action'] == 'updateProductColor') {
    $id = $_POST['id'];
    $categoryName = $_POST['categoryId'];
    $productId = $_POST['productId'];
    $color = $_POST['color'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $images = $_POST['images'];

    $sql1 = "SELECT * FROM product_color WHERE color = '$color' and product_id = '$productId' and product_color_id != '$id'; ";
    $existcategoryName = Query($sql1, $connection);
    $output = "";
    if (count($existcategoryName) > 0) {
        $output .= "existData";
        echo $output;
        return;
    }
    $sql = "UPDATE `product_color` SET `color` = '$color' ,`quantity` = '$quantity', `price` = '$price', `product_id` = '$productId' where `product_color_id` = '$id'";
    $data = Query($sql, $connection);

    $imagesString = $_POST['images'];
    $images = explode(',', $imagesString);
    $sql2 = "DELETE FROM product_image WHERE product_color_id = '$id';";
    $data2 = Query($sql2, $connection);
    foreach ($images as $image) {
        $sql3 = "INSERT INTO `product_image` ( `image`, `product_color_id`) VALUES ('$image','$id')";
        $data3 = Query($sql3, $connection);
    }
    echo "success";
}



if (isset($_GET['action']) && $_GET['action'] == 'getProductDetails') {
    $productId = $_GET['productId'];
    $sqlProductColor = "SELECT * FROM product_color where product_id = $productId";

    $dataProductColor = Query($sqlProductColor, $connection);
    $sqlProduct = "SELECT * FROM product where product_id = $productId";
    $dataProduct = Query($sqlProduct, $connection);
    $arrayImage = [];
    foreach ($dataProductColor as $row) {
        if (isset($row['product_color_id'])) {
            $product_color_id = $row['product_color_id'];
            $sqlProductImage = "SELECT * FROM product_image WHERE product_color_id = $product_color_id";
            $dataImage = Query($sqlProductImage, $connection);
            array_push($arrayImage, $dataImage);
        }
    }
    $category;
    foreach ($dataProduct as $row) {
        if (isset($row['category_id'])) {
            $categoryId = $row['category_id'];
            $sqlCategory = "SELECT * FROM category WHERE category_id = $categoryId";
            $data = Query($sqlCategory, $connection);
            $category = $data;
        }
    }
    $combinedData = [
        "category" => $category,
        "product" => $dataProduct,
        "productColor" => $dataProductColor,
        "productImage" => $arrayImage,
    ];
    if (empty($combinedData)) {
        echo json_encode("No data found");
    } else {
        echo json_encode($combinedData);
    }
}
