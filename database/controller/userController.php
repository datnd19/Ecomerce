<?php
include '../config.php';
if (isset($_GET['action']) && $_GET['action'] == 'view') {
    $sql = "SELECT * FROM user ";
    $data = Query($sql, $connection);
    $output = '';
    if (empty($data)) {
        echo $output =  "<tr><td colspan='4'>No data found</td></tr>";
    } else {
        echo json_encode($data);
    }
}

if (isset($_POST['action']) && $_POST['action'] == 'addUser') {
    $email = $_POST['email'];
    $phone  = $_POST['phone'];
    $username = $_POST['username'];
    $fullname = $_POST['fullname'];
    $address = $_POST['address'];
    $role = $_POST['role'];
    $password = $_POST['password'];
    $avatar = $_POST['avatar'];
    $sql = "SELECT * FROM user WHERE email = '$email'";
    $existPhone = Query($sql, $connection);
    $output = "";
    if (count($existPhone) > 0) {
        $output .= "existemail";
    }

    $sql1 = "SELECT * FROM user WHERE username = '$username'";
    $existUsername = Query($sql1, $connection);
    if (count($existUsername) > 0) {
        $output .= "existusername";
    }

    $sql2 = "SELECT * FROM `user` WHERE phone = '$phone'";
    $existPhone = Query($sql2, $connection);
    if (count($existPhone) > 0) {
        $output .= "existphone";
    }
    if (strlen($output) > 0) {
        echo $output;
        return;
    }
    $sql = "INSERT INTO `user` ( `email`, `password`, `username`, `fullname`, `phone`, `address`, `avatar`, `role`) VALUES ('$email','$password','$username','$fullname','$phone','$address','$avatar',$role)";
    $data = Query($sql, $connection);
    echo "success";
}


if (isset($_GET['action']) && $_GET['action'] == 'delete') {

    $id = $_GET['id'];
    $sql = "DELETE FROM user WHERE user_id = '$id'; ";
    $data = Query($sql, $connection);
    echo "success";
}


if (isset($_GET['action']) && $_GET['action'] == 'getUserById') {
    $id = $_GET['id'];
    $sql = "SELECT * FROM user WHERE user_id = '$id'; ";
    $data = Query($sql, $connection);
    echo json_encode($data);
}

if (isset($_POST['action']) && $_POST['action'] == 'updateUser') {
    $id = $_POST['id'];
    $email = $_POST['email'];
    $phone  = $_POST['phone'];
    $username = $_POST['username'];
    $fullname = $_POST['fullname'];
    $address = $_POST['address'];
    $role = $_POST['role'];
    $password = $_POST['password'];
    $avatar = $_POST['avatar'];
    $sql = "SELECT * FROM user WHERE email = '$email' and user_id != '$id'";
    $existPhone = Query($sql, $connection);
    $output = "";
    if (count($existPhone) > 0) {
        $output .= "existemail";
    }

    $sql1 = "SELECT * FROM user WHERE username = '$username' and user_id != '$id'";
    $existUsername = Query($sql1, $connection);
    if (count($existUsername) > 0) {
        $output .= "existusername";
    }

    $sql2 = "SELECT * FROM `user` WHERE phone = '$phone' and user_id != '$id'";
    $existPhone = Query($sql2, $connection);
    if (count($existPhone) > 0) {
        $output .= "existphone";
    }
    if (strlen($output) > 0) {
        echo $output;
        return;
    }
    $sql = "UPDATE user SET email = '$email', password = '$password', username = '$username', fullname = '$fullname', phone = '$phone', address = '$address', avatar = '$avatar', role = $role Where user_id = '$id'";
    $data = Query($sql, $connection);
    echo "success";
}
