<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
    <div class="wrapper d-flex align-items-stretch">
        <?php include './components/sideBar.php' ?>
        <div id="content" class="p-4 p-md-5 pt-5">
            <h1><a href="category.php">Danh Sách Sản Phẩm</a></h1>
            <div class="d-flex justify-content-end ">
                <button class="btn btn-primary px-3 py-2 mb-3" data-toggle="modal" data-target="#addModal"><i class="fa-solid fa-circle-plus mr-2"></i>Thêm Sản Phẩm</button>

                <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl" role="document">
                        <div class="modal-content" style="background-color: #ccc;">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Thêm Sản Phẩm Mới</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="productName" style="font-weight: bold">Tên Sản Phẩm
                                                <span id="existCategoryName" class="text-danger d-none">Tên Sản Phẩm Đã Tồn Tại </span>
                                            </label>
                                            <input type="text" class="form-control" id="productName" placeholder="Category Name">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="category" style="font-weight: bold">Nhãn Hàng </label>
                                            <select id="category" class="form-control" name="category"></select>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <label for="description" style="font-weight: bold">Mô Tả</label>
                                            <textarea id="description" class="form-control" name="description" rows="4" cols="50" placeholder="Description"></textarea>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                <button type="button" class="btn btn-primary addCategory">Lưu</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <table class="table table-hover table-bordered" id="example">
                <thead>
                    <tr>
                        <th scope="col-1">Mã Sản Phẩm</th>
                        <th scope="col-1">Tên Sản Phẩm</th>
                        <th scope="col-1">Nhãn Hàng</th>
                        <th scope="col-6">Mô Tả</th>
                        <th scope="col-1">Đánh giá</th>
                        <th scope="col-2">Ngày tạo</th>
                        <th scope="col-1">Hành Động</th>
                    </tr>
                </thead>
                <tbody class="bodyTable">

                </tbody>
            </table>

            <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content" style="background-color: #ccc;">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Cập Nhật Sản Phẩm</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <form>
                                <div class="form-row">
                                    <input type="text" class="form-control" id="productId" placeholder="Email" hidden>
                                    <div class="form-group col-md-6">
                                        <label for="productNameUpdate" style="font-weight: bold">Tên Sản Phẩm
                                            <span id="existCategoryName" class="text-danger d-none">Tên Sản Phẩm đã tồn tại</span>
                                        </label>
                                        <input type="text" class="form-control" id="productNameUpdate" placeholder="Category Name">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="categoryUpdate" style="font-weight: bold">Nhãn Hàng</label>
                                        <select id="categoryUpdate" class="form-control" name="categoryUpdate">

                                        </select>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="descriptionUpdate" style="font-weight: bold">Mô Tả</label>
                                        <textarea id="descriptionUpdate" class="form-control" name="descriptionUpdate" rows="4" cols="50" placeholder="Description"></textarea>
                                    </div>
                                </div>
                            </form>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                <button type="button" class="btn btn-primary update">Lưu</button>
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
        <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>
        <script>
            let listCategories = new Array();
            const getAllCategories = () => {
                $.ajax({
                    url: 'http://localhost:3000/database/controller/productController.php',
                    type: 'GET',
                    data: {
                        action: "getCategories",
                    },
                    success: (response) => {
                        let data = JSON.parse(response);
                        data.forEach((category) => {
                            let item = {
                                id: category.category_id,
                                name: category.category_name,
                            }
                            listCategories.push(item);
                        });

                        const abc = listCategories.map((category) => `<option value="${category.id}">${category.name}</option>`);
                        const selectElement = document.getElementById('category');
                        selectElement.innerHTML = abc.join('');
                        const updateSelect = document.getElementById('categoryUpdate');
                        updateSelect.innerHTML = abc.join('');
                    }
                })
            }
            getAllCategories();

            const showAllProducts = () => {
                $.ajax({
                    url: 'http://localhost:3000/database/controller/productController.php',
                    type: 'GET',
                    data: {
                        action: "view",
                    },
                    success: (response) => {
                        let data = JSON.parse(response);
                        if (data == "No data found") {
                            data = "<h2 style=\"font-style: italic;\">Không Có Dữ Liệu</h2>";
                            $('.bodyTable').html(data);
                        } else {
                            $('#example').DataTable({
                                data: data,
                                columns: [{
                                        data: 'productid',
                                        render: function(data, type, row) {
                                            return row.product_id;
                                        }
                                    },
                                    {
                                        data: 'productname',
                                        render: function(data, type, row) {
                                            return row.product_name;
                                        }
                                    },
                                    {
                                        data: 'categoryid',
                                        render: function(data, type, row) {
                                            for (let i = 0; i < listCategories.length; i++) {
                                                if (listCategories[i].id == row.category_id) {
                                                    return listCategories[i].name;
                                                }
                                            }
                                        }
                                    },
                                    {
                                        data: 'description',
                                        render: function(data, type, row) {
                                            return row.description;
                                        }
                                    },
                                    {
                                        data: 'rate',
                                        render: function(data, type, row) {
                                            return row.rate;
                                        }
                                    },
                                    {
                                        data: 'create_at',
                                        render: function(data, type, row) {
                                            return row.created_at;
                                        }
                                    },
                                    {
                                        "data": null,
                                        render: function(data, type, row) {
                                            return `<div class="btn-group" role="group" aria-label="Basic example">
                                                <button onclick="handleUpdate(${row.product_id})" data-toggle="modal" data-target="#updateModal" type="button" class="btn btn-success mr-3">Cập Nhật</button>
                                                <button onclick="handleDelete(${row.product_id})" type="button" class="btn  btn-danger">Xóa</button>
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
            showAllProducts();

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
                            url: 'http://localhost:3000/database/controller/productController.php',
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
                                showAllProducts();
                            }
                        })
                    }
                })
            }

            const addCategory = document.querySelector('.addCategory');
            addCategory.onclick = function() {
                function isEmpty(value) {
                    return value.trim() === '';
                }
                const fields = ['productName', 'category', 'description'];
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
                    const existCategoryName = document.querySelector('#existCategoryName');
                    const addForm = document.querySelector("#addForm");
                    const data = new FormData();
                    data.append('productName', $('#productName').val());
                    data.append('category', $('#category').val());
                    data.append('description', $('#description').val());
                    data.append('action', "addProduct");
                    $.ajax({
                        url: 'http://localhost:3000/database/controller/productController.php',
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
                                        title: "Thêm Thành Công",
                                        confirmButtonText: 'OK',
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            showAllProducts();
                                        }
                                    })
                                    break;
                                default:
                                    if (response.includes("existProductName")) {
                                        existCategoryName.classList.remove('d-none');
                                    } else {
                                        existCategoryName.classList.add('d-none');
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

            const handleUpdate = (id) => {
                $.ajax({
                    url: 'http://localhost:3000/database/controller/productController.php',
                    type: 'GET',
                    data: {
                        action: "getProductById",
                        id: id
                    },
                    success: (response) => {
                        let data = JSON.parse(response);
                        $('#productId').val(data[0].product_id);
                        $("#productNameUpdate").val(data[0].product_name);
                        $("#descriptionUpdate").val(data[0].description);
                        const selectElement = document.getElementById('categoryUpdate');
                        Array.from(selectElement.options).forEach(option => {
                            if (option.value === data[0].category_id) {
                                option.selected = true;
                            } else {
                                option.selected = false;
                            }
                        });
                    }
                })
            }

            function addBackslashBeforeSingleQuote(paragraph) {
                // Check if the paragraph includes a single quote
                if (paragraph.includes("'")) {
                    // Add a backslash before every single quote
                    return paragraph.replace(/'/g, "\\'");
                }
                // If no single quotes found, return the original paragraph
                return paragraph;
            }
            const updateBtn = document.querySelector('.update');
            updateBtn.onclick = function() {
                function isEmpty(value) {
                    return value.trim() === '';
                }
                const fields = ['productNameUpdate', 'categoryUpdate', 'descriptionUpdate'];
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
                        text: 'Điền Đầy đủ thông tin',
                    });
                } else {
                    const existCategoryName = document.querySelector('#existCategoryName');
                    const addForm = document.querySelector("#addForm");
                    const data = new FormData();
                    data.append('id', $('#productId').val());
                    data.append('productNameUpdate', $('#productNameUpdate').val());
                    data.append('categoryUpdate', $('#categoryUpdate').val());
                    data.append('descriptionUpdate', addBackslashBeforeSingleQuote($('#descriptionUpdate').val()));
                    data.append('action', "updateCategory");
                    $.ajax({
                        url: 'http://localhost:3000/database/controller/productController.php',
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
                                        title: "Cập Nhật Thành Công",
                                        confirmButtonText: 'OK',
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            showAllProducts();
                                        }
                                    })
                                    break;
                                default:
                                    if (response.includes("existProductName")) {
                                        existCategoryName.classList.remove('d-none');
                                    } else {
                                        existCategoryName.classList.add('d-none');
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
        </script>
</body>

</html>