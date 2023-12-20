<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" /> -->
    <link rel="stylesheet" href="./css/datatable/style.css">
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
    <div class="wrapper d-flex align-items-stretch">
        <?php include './components/sideBar.php' ?>
        <div id="content" class="p-4 p-md-5 pt-5">
            <h1><a href="listUser.php">Danh Sách Người Dùng</a></h1>
            <div class="d-flex justify-content-end ">
                <a href="addUser.php" class="btn btn-primary px-3 py-2 mb-3"><i class="fa-solid fa-circle-plus mr-2"></i>Thêm người dùng mới</a>
            </div>

            <table class="table table-bordered table-hover" id="example">
                <thead>
                    <tr>
                        <th>Mã Người Dùng</th>
                        <th>Email</th>
                        <th>Tên người dùng</th>
                        <th>Điện thoại</th>
                        <th>Tên đầy đủ</th>
                        <th>Địa chỉ</th>
                        <th>Quyền</th>
                        <th>Hành Động</th>
                    </tr>
                </thead>
                <tbody class="bodyTable">

                </tbody>
            </table>


            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content" style="background-color: #ccc;">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Cập Nhật Người Dùng</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form class="true">
                                <div class="form-row">
                                    <input type="text" class="form-control" id="inputUserid" placeholder="Email" hidden>
                                    <div class="form-group col-md-6">
                                        <label for="email" style="font-weight: bold">Email
                                            <span id="wrongEmail" class="text-danger d-none">Email không đúng form</span>
                                            <span id="existEmail" class="text-danger d-none">Email này đã tồn tại</span>
                                        </label>
                                        <input type="email" class="form-control" id="email" placeholder="Email">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="password" style="font-weight: bold">Mật Khẩu:
                                            <span id="wrongPassword" class="text-danger d-none">Mật khẩu ít nhất 6 kí tự bao gồm chữ và số</span>
                                        </label>
                                        <input type="password" class="form-control" id="password" placeholder="Password">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="username" style="font-weight: bold">Tên Người Dùng:
                                            <span id="existUsername" class="text-danger d-none">Tên người dùng đã tồn tại</span>

                                        </label>
                                        <input type="text" class="form-control" id="username" placeholder="username">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="fullname" style="font-weight: bold">Tên đầy đủ:</label>
                                        <input type="text" class="form-control" id="fullname" placeholder="fullname">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="phone" style="font-weight: bold">Điện Thoại:
                                            <span id="wrongPhone" class="text-danger d-none">Điện Thoại phải có 10 chữ số</span>
                                            <span id="existPhone" class="text-danger d-none">Điện Thoại đã tồn tại</span>
                                        </label>
                                        <input type="text" class="form-control" id="phone" placeholder="username">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="role" style="font-weight: bold">Quyền:</label>
                                        <select id="role" class="form-control" name="role">
                                            <option value="0">Quản trị</option>
                                            <option value="1" checked>Khách</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="address" style="font-weight: bold">Địa Chỉ:</label>
                                    <input type="text" class="form-control" id="address" placeholder="1234 Main St">
                                </div>
                                <div class="form-group">
                                    <label for="avatar" style="font-weight: bold">Ảnh Đại Diện</label>
                                    <input type="file" class="form-control-file" accept="image/*" onchange="loadFile(event)" id="avatar" name="avatar">
                                    <img id="avatarDisplay" style="width: 100px;height: 100px;object-fit: cover" />
                                    <input type="text" class="form-control" id="image" name="image" hidden="">
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                            <button type="button" class="btn btn-primary update">Lưu thay đổi</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="./js/jquery.min.js"></script>
    <script src="./js/popper.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <script src="./js/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!-- <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script> -->
    <script src="./js/simple-datatables.js"></script>
    <script>
        var loadFile = function(event) {
            var output = document.getElementById('avatarDisplay');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src);
            }
            const image = document.querySelector("#image");
            image.value = event.target.files[0].name;

        };
        const showAllUsers = () => {
            $.ajax({
                url: 'http://localhost:3000/database/controller/userController.php',
                type: 'GET',
                data: {
                    action: "view",
                },
                success: (response) => {
                    let data = JSON.parse(response);
                    if (data == "No data found") {
                        data = "<h2 style=\"font-style: italic;\">Không có dữ liệu</h2>";
                        $('.bodyTable').html(data);
                    } else {
                        $('#example').DataTable({
                            data: data,
                            columns: [{
                                    data: 'userid',
                                    render: function(data, type, row) {
                                        return row.user_id;
                                    }
                                },
                                {
                                    data: 'email',
                                    render: function(data, type, row) {
                                        return row.email;
                                    }
                                },
                                {
                                    data: 'username',
                                    render: function(data, type, row) {
                                        return row.username;
                                    }
                                },
                                {
                                    data: 'phone',
                                    render: function(data, type, row) {
                                        return row.phone;
                                    }
                                },
                                {
                                    data: 'fullname',
                                    render: function(data, type, row) {
                                        return row.fullname;
                                    }
                                },
                                {
                                    data: 'address',
                                    render: function(data, type, row) {
                                        return row.address;
                                    }
                                },
                                {
                                    data: 'role',
                                    render: function(data, type, row) {
                                        return row.role == 0 ? 'Quản trị' : 'Khách hàng';
                                    }
                                },
                                {
                                    "data": null,
                                    render: function(data, type, row) {
                                        return `<div class="btn-group" role="group" aria-label="Basic example">
                                                <button onclick="handleUpdate(${row.user_id})" data-toggle="modal" data-target="#exampleModal" type="button" class="btn btn-success mr-3">Cập Nhật</button>
                                                <button onclick="handleDelete(${row.user_id})" type="button" class="btn  btn-danger">Xóa</button>
                                            </div>`
                                    },
                                }
                            ],
                            "bDestroy": true
                        });
                    }


                }
            })
        }
        showAllUsers();

        const handleDelete = (id) => {
            Swal.fire({
                title: 'Bạn chắc chắn chứ?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Xóa!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: 'http://localhost:3000/database/controller/userController.php',
                        type: 'GET',
                        data: {
                            action: "delete",
                            id: id
                        },
                        success: (response) => {
                            Swal.fire({
                                title: 'Xóa thành công',
                                icon: 'success'
                            })
                            showAllUsers();
                        }
                    })
                }
            })
        }

        let imgDefault = '';
        const handleUpdate = (id) => {
            $.ajax({
                url: 'http://localhost:3000/database/controller/userController.php',
                type: 'GET',
                data: {
                    action: "getUserById",
                    id: id
                },
                success: (response) => {
                    let data = JSON.parse(response);
                    console.log(data);
                    $("#inputUserid").val(data[0].user_id);
                    $("#email").val(data[0].email);
                    $("#password").val(data[0].password);
                    $("#username").val(data[0].username);
                    $("#fullname").val(data[0].fullname);
                    $("#phone").val(data[0].phone);
                    $("#address").val(data[0].address);
                    var roleSelect = document.getElementById('role');
                    for (var i = 0; i < roleSelect.options.length; i++) {
                        if (roleSelect.options[i].value == data[0].role) {
                            roleSelect.options[i].selected = true;
                            break;
                        }
                    }
                    $("#avatarDisplay")[0].src = `./database/uploads/${data[0].avatar}`;
                    imgDefault = data[0].avatar;
                    showAllUsers();
                }
            })
        }

        const updateBtn = document.querySelector('.update');
        updateBtn.onclick = function() {
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
                console.log(checkEmailValid, checkPasswordValid, checkPhoneValid);
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
                    data.append('id', $('#inputUserid').val());
                    data.append('email', $('#email').val());
                    data.append('phone', $('#phone').val());
                    data.append('password', $('#password').val());
                    data.append('username', $('#username').val());
                    data.append('fullname', $('#fullname').val());
                    data.append('address', $('#address').val());
                    data.append('role', $("#role").val());
                    // data.append('avatar', $("#image").val() == '' ? imgDefault : $("#image").val());

                    var imageInput = $('.form-control-file');
                    if (imageInput.get(0).files.length > 0) {
                        data.append('avatar', imageInput.prop('files')[0]);
                    }
                    data.append('oldImage', imgDefault);
                    data.append('action', "updateUser");
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
                                        title: "Cập nhật thành công",
                                        confirmButtonText: 'Ok',
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            showAllUsers();
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