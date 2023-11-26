<?php
include '../config.php';
if ($_POST['action'] && $_POST['action'] == 'view') {
    $searchName ='';
    if(isset($_POST['usernameSearch'])) {
        $searchName = $_POST['usernameSearch']; 
    } 
    $sql = "SELECT * FROM user WHERE username like '%$searchName%'";
    $data = Query($sql, $connection);
    $output = '';
    if (empty($data)) {
        $output =  "<tr><td colspan='4'>No data found</td></tr>";
    } else {
        foreach ($data as $user) {
            $action = ' <div class="btn-group" role="group" aria-label="Basic example">
                        <button onclick="EnableUser(\'' . $user['user_id'] . '\')" type="button" class="btn btn-sm btn-success mr-2">Update</button>
                        <button onclick="DisableUser(\'' . $user['user_id'] . '\')" type="button" class="btn btn-sm btn-danger">Delete</button>
                    </div>';
            $id = $user['user_id'];
            $email = $user['email'];
            $username = $user['username'];
            $phone = $user['phone'];
            $fullname = $user['fullname'];
            $address = $user['address'];
            $role = $user['role'] == 0 ? 'Admin' : 'Customer';

            $output .= "<tr>
                            <td>$id</td>
                            <td>$email</td>
                            <td>$username</td>
                            <td>$phone</td>
                            <td>$fullname</td>
                            <td>$address</td>
                            <td>$role</td>
                            <td>$action</td>
                            </tr>";
        }
        echo $output;
    }
}

if ($_POST['action'] && $_POST['action'] == 'addUser') {
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
