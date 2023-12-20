<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
    <div class="wrapper d-flex align-items-stretch">
        <?php include './components/sideBar.php' ?>
        <div id="content" class="p-4 p-md-5 pt-5 ml-3">
            <h1>Thêm người dùng</h1>
            <form id="addForm">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="email" style="font-weight: bold;"> Email:
                            <span id="wrongEmail" class="text-danger d-none">Email không đúng form</span>
                            <span id="existEmail" class="text-danger d-none">Email này đã tồn tại</span>
                        </label>
                        <input type="email" class="form-control" id="email" placeholder="Email" name="email">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="password" style="font-weight: bold">Mật Khẩu:
                            <span id="wrongPassword" class="text-danger d-none">Mật khẩu ít nhất 6 kí tự bao gồm chữ và số</span>
                        </label>
                        <input type="password" class="form-control" id="password" placeholder="Password" name="password">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="username" style="font-weight: bold">Tên Người Dùng:
                            <span id="existUsername" class="text-danger d-none">Tên người dùng đã tồn tại</span>
                        </label>
                        <input type="text" class="form-control" id="username" placeholder="Username" name="username">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="fullname" style="font-weight: bold">Tên đầy đủ:</label>
                        <input type="text" class="form-control" id="fullname" placeholder="FullName" name="fullname">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="phone" style="font-weight: bold">Điện Thoại:
                            <span id="wrongPhone" class="text-danger d-none">Điện Thoại phải có 10 chữ số</span>
                            <span id="existPhone" class="text-danger d-none">Điện Thoại đã tồn tại</span>
                        </label>
                        <input type="text" class="form-control" id="phone" placeholder="Phone" name="phone">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-8">
                        <label for="address" style="font-weight: bold">Địa Chỉ:</label>
                        <input type="text" class="form-control" id="address" placeholder="1234 Main St" name="address">
                    </div>
                    <div class="form-group col-md-2">
                        <label for="role" style="font-weight: bold">Quyền:</label>
                        <select id="role" class="form-control" name="role">
                            <option value="0">Quản trị</option>
                            <option value="1">Khách hàng</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="avatar" style="font-weight: bold">Ảnh đại diện</label>
                    <input type="file" class="form-control-file" accept="image/*" onchange="loadFile(event)" id="avatar" name="avatar">
                    <img id="output" style="width: 200px;height: 200px;object-fit: cover" />
                </div>
                <input type="text" class="form-control" id="image" name="image" hidden="">
                <button type="button" class="btn btn-primary addBtn px-3">Thêm người dùng</button>
            </form>
        </div>


    </div>
    
    <script src="./js/jquery.min.js"></script>
    <script src="./js/popper.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <script src="./js/main.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        var loadFile = function(event) {
            var output = document.getElementById('output');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src);
            }
            const image = document.querySelector("#image");
            image.value = event.target.files[0].name;

        };
        const addBtn = document.querySelector('.addBtn');

        addBtn.onclick = () => {
            function isEmpty(value) {
                return value.trim() === '';
            }
            const fields = ['email', 'password', 'username', 'fullname', 'phone', 'address', 'role'];
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
                    text: 'Điền đầy đủ thông tin',
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
                const wrongPhone = document.querySelector('#wrongPhone');
                const existPhone = document.querySelector('#existPhone');
                const existUsername = document.querySelector('#existUsername');
                const checkEmailValid = checkEmail(email.value);
                const checkPasswordValid = checkPassword(password.value);
                const checkPhoneValid = checkPhone(phone.value);
                if (!checkEmailValid) {
                    console.log(checkEmail(email.value));
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
                if (checkEmailValid && checkPhoneValid && checkEmailValid) {
                    const addForm = document.querySelector("#addForm");
                    const data = new FormData();
                    data.append('email', $('#email').val());
                    data.append('phone', $('#phone').val());
                    data.append('password', $('#password').val());
                    data.append('username', $('#username').val());
                    data.append('fullname', $('#fullname').val());
                    data.append('address', $('#address').val());
                    data.append('role', $("#role").val());
                    // data.append('avatar', $('#form-control-file'));
                    

                    var imageInput = $('.form-control-file');
                    if (imageInput.get(0).files.length > 0) {
                        data.append('avatar', imageInput.prop('files')[0]);
                    }
                    data.append('action', "addUser");
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
                                        title: "Thêm thành công",
                                        showCancelButton: true,
                                        confirmButtonText: 'Đến danh sách người dùng',
                                        cancelButtonText: 'Ok'
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            window.open("listUser.php", "_self");
                                        }
                                    })
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