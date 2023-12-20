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
                    <div id="login-column" class="col-md-7">
                        <div id="login-box" class="col-md-12 shadow-2-strong" style="border-radius: 1rem;">
                            <div>
                                <div>
                                    <h3 class="text-center pt-5 font-italic">Đăng kí để tham gia vào CLICON!</h3>
                                    <a href="home.php" class="text-center pt-2" style="display: block">Trở về Trang chủ!</a>
                                </div>
                            </div>
                            <form action="login">
                                <div class="form-group">
                                    <label for="Email" class="text-dark">Email:
                                        <span id="wrongEmail" class="text-danger d-none">Email không đúng form</span>
                                        <span id="existEmail" class="text-danger d-none">Email đã tồn tại</span>
                                    </label>
                                    <input type="email" class="form-control border border-dark" id="email" placeholder="Email" name="email">
                                </div>
                                <div class="form-group">
                                    <label for="Password" class="text-dark">Mật Khẩu:
                                        <span id="wrongPassword" class="text-danger d-none">Mật khẩu ít nhất 6 kí tự bao gồm chữ và số</span>
                                    </label>
                                    <input type="password" class="form-control border border-dark" id="password" placeholder="Password" name="password">
                                </div>
                                <div class="form-group">
                                    <label for="ConfirmPassword" class="text-dark">Xác nhận Mật Khẩu: <span id="wrongConfirmPassword" class="text-danger d-none">Confirm password doesn't same with password</span></label>
                                    <input type="password" class="form-control border border-dark" id="confirmPassword" placeholder="Confirm Password" name="confirmpassword">
                                </div>
                                <div class="form-group">
                                    <label for="Username" class="text-dark">Tên Người Dùng:
                                        <span id="existUsername" class="text-danger d-none">Tên người dùng đã tồn tại</span>
                                    </label>
                                    <input type="text" class="form-control border border-dark" id="username" placeholder="Username" name="username">
                                </div>
                                <div class="form-group">
                                    <label for="Fullname" class="text-dark">Tên đầy đủ: </label>
                                    <input type="text" class="form-control border border-dark" id="fullname" placeholder="Fullname" name="Fullname">
                                </div>
                                <div class="form-group">
                                    <label for="Phone" class="text-dark">Điện Thoại:
                                        <span id="wrongPhone" class="text-danger d-none">Điện Thoại phải có 10 chữ số</span>
                                        <span id="existPhone" class="text-danger d-none">Điện Thoại đã tồn tại</span>
                                    </label>
                                    <input type="text" class="form-control border border-dark" id="phone" placeholder="Phone" name="phone">
                                </div>
                                <div class="form-group">
                                    <label for="Address" class="text-dark">Địa Chỉ: </label>
                                    <input type="text" class="form-control border border-dark" id="address" placeholder="Address" name="address">
                                </div>
                                <button type="button" class="btn btn-info signUpBtn col-md-12">Đăng Ký</button>
                            </form>
                            <a href="signIn.php" class="text-center pt-2 mb-3" style="display: block">Đã có tài khoản ?</a>
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
        const signUpBtn = document.querySelector('.signUpBtn');
        signUpBtn.onclick = function() {
            function isEmpty(value) {
                return value.trim() === '';
            }
            const fields = ['email', 'password', 'username', 'fullname', 'phone', 'address', 'confirmPassword'];
            fields.forEach(field => {
                const element = document.querySelector(`#${field}`);
                if (isEmpty(element.value)) {
                    element.classList.add('is-invalid');
                } else {
                    element.classList.remove('is-invalid');
                }
            });

            if (fields.some(field => isEmpty(document.querySelector(`#${field}`).value))) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'ĐIền đầy đủ thông tin',
                });
            } else {
                function checkEmail(email) {
                    const EMAIL_REGEX = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
                    return EMAIL_REGEX.test(email);
                }

                function checkPassword(password) {
                    const PASSWORD_REGEX = /^(?=.*[0-9])(?=.*[a-zA-Z]).{6,20}$/;
                    return PASSWORD_REGEX.test(password);
                }

                function checkPhone(phone) {
                    const PHONE_REGEX = /^\d{10}$/;
                    return PHONE_REGEX.test(phone);
                }
                const wrongEmail = document.querySelector('#wrongEmail');
                const existEmail = document.querySelector('#existEmail');
                const wrongPassword = document.querySelector('#wrongPassword');
                const wrongConfirmPassword = document.querySelector('#wrongConfirmPassword');
                const wrongPhone = document.querySelector('#wrongPhone');
                const existPhone = document.querySelector('#existPhone');
                const existUsername = document.querySelector('#existUsername');
                const checkEmailValid = checkEmail(email.value);
                const checkPasswordValid = checkPassword(password.value);
                const checkPhoneValid = checkPhone(phone.value);
                const checkConfirmPasswordValid = $('#password').val() == $('#confirmPassword').val();
                if (!checkEmailValid) {
                    wrongEmail.classList.remove('d-none');
                } else {
                    wrongEmail.classList.add('d-none');
                }
                if (!checkPasswordValid) {
                    wrongPassword.classList.remove('d-none');
                } else {
                    wrongPassword.classList.add('d-none');
                }
                if (!checkPhoneValid) {
                    wrongPhone.classList.remove('d-none');
                } else {
                    wrongPhone.classList.add('d-none');
                }
                if (!checkConfirmPasswordValid) {
                    wrongConfirmPassword.classList.remove('d-none');
                } else {
                    wrongConfirmPassword.classList.add('d-none');
                }
                if (checkEmailValid && checkPhoneValid && checkEmailValid && checkConfirmPasswordValid) {
                    const addForm = document.querySelector("#addForm");
                    const data = new FormData();
                    data.append('email', $('#email').val());
                    data.append('phone', $('#phone').val());
                    data.append('password', $('#password').val());
                    data.append('username', $('#username').val());
                    data.append('fullname', $('#fullname').val());
                    data.append('address', $('#address').val());
                    data.append('action', "signUp");
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
                                    Swal.fire({
                                        icon: 'success',
                                        title: "Đăng Ký Thành Công",
                                        confirmButtonText: 'Đăng Nhập',
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            window.open("signIn.php", "_self");
                                        }
                                    })
                                    setTimeout(function() {
                                        window.location.href = 'signIn.php';
                                    }, 2000); // 5000 milliseconds = 5 seconds
                                    break;
                                default:
                                    if (response.includes("existemail")) {
                                        existEmail.classList.remove('d-none');
                                    } else {
                                        existEmail.classList.add('d-none');
                                    }

                                    if (response.includes("existusername")) {
                                        existUsername.classList.remove('d-none');
                                    } else {
                                        existUsername.classList.add('d-none');
                                    }
                                    if (response.includes("existphone")) {
                                        existPhone.classList.remove('d-none');
                                    } else {
                                        existPhone.classList.add('d-none');
                                    }
                                    Swal.fire({
                                        title: 'Có gì đó sai sót',
                                        icon: 'error',
                                        confirmButtonText: 'OK',
                                    })
                                    break;
                            }
                        }
                    });
                }
            }
        }
    </script>
</body>

</html>