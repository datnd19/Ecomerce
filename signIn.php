

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
    <link href="https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <link rel="stylesheet" href="./css/style.css">
    <style>
        #login .container #login-row #login-column #login-box {
            margin-top: 70px;
            border-radius: 4px;
            border: 1px solid var(--gray-100, #E4E7E9);
            background: var(--gray-00, #FFF);
            box-shadow: 0px 8px 40px 0px rgba(0, 0, 0, 0.12);
        }
        #login .container #login-row #login-column #login-box #login-form {
            padding: 20px;
        }
    </style>
</head>

<body>
    <?php include './components/header.php' ?>
    <div class="container">
        <div id="login">
            <div class="container">
                <div id="login-row" class="row justify-content-center align-items-center">
                    <div id="login-column" class="col-md-6">
                        <div id="login-box" class="col-md-12 shadow-2-strong" style="border-radius: 1rem;">
                            <div>
                                <div>
                                    <h3 class="text-center pt-5 font-italic">Chào mừng bạn đến với CLICON!</h3>
                                    <a href="home.php" class="text-center pt-2" style="display: block">Quay Lại Trang Home!</a>
                                </div>
                            </div>
                            <form action="login">
                                <h3 class="text-center mt-3">Đăng Nhập</h3>
                                <div class="form-group">
                                    <label for="email" class="text-dark d-flex"><span>Email:</span>
                                        <span class="signInFail d-none ml-2 text-danger font-italic">Email hoặc mật khẩu không đúng. Thử Lại !</span>
                                    </label>
                                    <input type="email" name="email" id="email" class="form-control border border-dark" placeholder="Email" name="email" value="">
                                </div>
                                <div class="form-group">
                                    <label for="password" class="text-dark" style="display: flex; align-items: center;">
                                        <span>Mật Khẩu:</span>
                                        <span style="margin-left: auto;"><a href="#!">Quên Mật Khẩu?</a></span>
                                    </label>

                                    <input type="password" name="password" id="password" class="form-control border border-dark" placeholder="Password" name="password" value="">
                                </div>
                                <div class="form-group">
                                    <label for="remember-me" class="text-info d-lfex align-items-center">
                                        <span>Ghi Nhớ Đăng Nhập</span>
                                        <span style="margin-left: 5px;"><input id="remember-me" name="remember-me" type="checkbox"></span>
                                    </label>
                                    <button type="button" class="btn btn-info signInBtn col-md-12">Đăng Nhập</button>
                                </div>
                            </form>
                            <a href="signUp.php" class="text-center pt-2 mb-3" style="display: block">Chưa có tài khoản?</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <?php include './components/footer.php' ?>
    <script src="./js/jquery.min.js"></script>
    <script src="./js/popper.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <script src="./js/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script>
        const signInBtn = document.querySelector(".signInBtn");
        signInBtn.onclick = function() {
            var checkbox = document.getElementById("remember-me");

            const addForm = document.querySelector("#addForm");
            const data = new FormData();
            data.append('email', $('#email').val());
            data.append('password', $('#password').val());
            data.append('remember', checkbox.checked);
            data.append('action', "signIn");
            $.ajax({
                url: 'http://localhost:3000/database/controller/userController.php',
                type: 'POST',
                data: data,
                contentType: false,
                processData: false,
                success: (response) => {
                    console.log(response);
                    switch (response) {
                        case "success":
                            window.location.href = 'home.php';
                            break;
                        default:
                            const signInFail = document.querySelector('.signInFail');
                            signInFail.classList.remove('d-none');
                            signInFail.classList.add('d-block');
                            break;
                    }
                }
            });
        };
    </script>
</body>

</html>