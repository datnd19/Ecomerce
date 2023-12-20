<div style="background-color:  #FA8232;">
    <div class="container d-flex justify-content-between align-items-center py-3">
        <div class="logo col-md-2">
            <a href="home.php"><img src="../images/Logo.png"></a>
        </div>
        <div class="search col-md-6">
            <input type=" text" placeholder="tìm kiếm sản phẩm..." style="padding: 10px 15px; width:600px">
        </div>

        <?php
        // Start the session
        session_start();
    
        // Assuming $_SESSION['account'] contains a JSON-encoded string
        if (!isset($_SESSION['account'])) {
            echo "<div class='user col-md-2 d-flex'>
            <i class='fa-solid fa-cart-shopping' style='font-size: 24px'></i>
            <a href='signIn.php'><button class='btn btn-success mr-3'>Đăng Nhập</button></a>
            <a href='signup.php'><button class='btn btn-info'>Đăng Kí</button></a>
        </div>";
        } else {
            $jsonData = $_SESSION['account'];
            $data = json_decode($jsonData, true);
            $username = $data[0]['username'];
            $image = $data[0]['avatar'];
            $role = $data[0]['role'];
            $html = "<div class='col-md-2 d-flex align-items-center justify-content-between'>
            <a href='cart.php' id='cartLink' style='text-decoration: none; color: inherit;'>
                <i class='fas fa-shopping-cart fa-2x' style='margin-right: 30px'></i>
            </a>
            <div class='dropdown'>
                <button class='btn dropdown-toggle d-flex align-items-center justify-content-center border border-secondary p-2' type='button' id='dropdownMenuButton' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                    <div class = 'username'>$username</div>
                    <img src='/database/uploads/$image' style='width: 20px; height: 20px; border-radius: 50%; margin-left: 20px'/>
                </button>
                <div class='dropdown-menu' aria-labelledby='dropdownMenuButton'>
                    <a href='information' class='dropdown-item' >THông tin cá nhân</a>";
                    if($role == 0) {
                        $html .= "<a href='listuser.php' class='dropdown-item'>Quản lý cửa hàng</a>";
                    }
            $html .="<a href='history-purchase' class='dropdown-item' >Lịch sử mua sắm</a>
                    <a href='change-password' class='dropdown-item' >Đổi mật khẩu</a>
                    <a  class='dropdown-item logout' href='#' >Đăng xuất</a>
                </div>
            </div>
        </div>";
        echo $html;
        }
        ?>
    </div>
</div>

<script>
    const logout = document.querySelector('.logout');
    if (logout) {
        logout.onclick = function() {
            const data = new FormData();
            data.append('action', 'view');
            $.ajax({
                url: 'http://localhost:3000/database/controller/userController.php',
                type: 'GET',
                data: {
                    action: 'logOut',
                },
                success: (response) => {
                    location.reload();
                }
            })
        }
    }
</script>