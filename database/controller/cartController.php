<?php
include '../config.php';
if (isset($_POST['action']) && $_POST['action'] == 'addToCart') {
    session_start();
    $jsonData = $_SESSION['account'];
    $data = json_decode($jsonData, true);
    $user_id = $data[0]['user_id'];
    $productColor = $_POST['productColor'];
    $quantity = $_POST['quantity'];
    $inventory  = $_POST['inventory'];
    if ($inventory == 0) {
        echo "sold Out";
        return;
    }
    $checkCart = "SELECT * FROM cart WHERE product_color_id = '$productColor' and user_id = '$user_id'; ";
    $data = Query($checkCart, $connection);
    if (count($data) == 0) {
        $sqlAddCart = "INSERT INTO `cart` ( `user_id`, `product_color_id`, `quantity`) VALUES ('$user_id','$productColor','$quantity')";
        $dataAddCart = Query($sqlAddCart, $connection);
        echo "success";
        return;
    } else {
        $newQuantity = $data[0]['quantity'] + $quantity;
        $sqlUpdateCart = "UPDATE `cart` SET `quantity` = '$newQuantity' WHERE `user_id` = '$user_id' AND `product_color_id` = '$productColor'";
        $dataUpdateCart = Query($sqlUpdateCart, $connection);
        echo "success";
        return;
    }
}
