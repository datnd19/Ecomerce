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
    <style>
        input[type="file"] {
            display: none;
        }

        .desc {
            display: block;
            position: relative;
            background-color: #025bee;
            color: #ffffff;
            font-size: 14px;
            text-align: center;
            width: 200px;
            margin-left: 10px;
            padding: 10px 0;
            border-radius: 5px;
            cursor: pointer;
        }

        .upload p {
            text-align: center;
            margin-top: 12px;
            margin-left: 20px;
        }

        #images,
        #imagesUpdate {
            width: 90%;
            position: relative;
            margin: auto;
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
        }

        img {
            width: 200px;
            height: 200px;
            object-fit: cover;
        }

        figcaption {
            text-align: center;
            font-size: 1.4vmin;
            margin-top: 0.5vmin;
        }

        select {
            /* for Chrome */
            -webkit-appearance: none;
        }
    </style>
</head>

<body>
    <div class="wrapper d-flex align-items-stretch">
        <?php include './components/sideBar.php' ?>
        <div id="content" class="p-4 p-md-5 pt-5">
            <h1><a href="productColor.php">List Product Color</a></h1>
            <div class="d-flex justify-content-end ">
                <button class="btn btn-primary  px-3 py-2 mb-3" data-toggle="modal" data-target="#addModal"><i class="fa-solid fa-circle-plus mr-2"></i>Add Product Color</button>
                <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl" role="document">
                        <div class="modal-content" style="background-color: #ccc;">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Add New Product Color</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="catrgoryName" style="font-weight: bold">Category Name</label>
                                            <select id="category" class="form-control" name="category">
                                                <option value="0">1</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="productName" style="font-weight: bold">Product Name</label>
                                            <select id="product" class="form-control" name="product">
                                                <option value="">Selected Product</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label for="color" style="font-weight: bold">Color
                                                <span id="existColor" class="text-danger d-none">The Color have exist </span>
                                            </label>
                                            <input type="text" class="form-control" id="color" placeholder="Color">

                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="price" style="font-weight: bold">Price</label>
                                            <input type="text" class="form-control" id="price" placeholder="Price">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="quantity" style="font-weight: bold">Quantity</label>
                                            <input type="text" class="form-control" id="quantity" placeholder="Quantity">
                                        </div>
                                    </div>
                                    <div class="form-row upload">
                                        <input type="file" id="file-input" accept="image/png, image/jpeg" onchange="preview()" multiple>
                                        <label for="file-input" class="desc">
                                            <i class="fas fa-upload"></i> &nbsp; Choose A Photo
                                        </label>
                                        <p id="num-of-files">No Files Chosen</p>
                                        <div id="images"></div>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary addProductColor">Save changes</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <table class="table table-hover table-bordered" id="example">
                <thead>
                    <tr>
                        <th scope="col">Color ID</th>
                        <th scope="col">Product Category</th>
                        <th scope="col">Product Name</th>
                        <th scope="col">Color</th>
                        <th scope="col">Price</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Sold Quantity</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody class="bodyTable">

                </tbody>
            </table>

            <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content" style="background-color: #ccc;">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Update Product Color</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form>
                                <input type="text" id="productColorId" hidden>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="catrgoryName" style="font-weight: bold">Category Name</label>
                                        <select id="categoryUpdate" class="form-control" name="category">
                                            <option value="0">1</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="productName" style="font-weight: bold">Product Name</label>
                                        <select id="productUpdate" class="form-control" name="product">
                                            <option value="">Selected Product</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="color" style="font-weight: bold">Color
                                            <span id="existColorUpdate" class="text-danger d-none">The Color have exist </span>
                                        </label>
                                        <input type="text" class="form-control" id="colorUpdate" placeholder="Color">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="price" style="font-weight: bold">Price</label>
                                        <input type="text" class="form-control" id="priceUpdate" placeholder="Price">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="quantity" style="font-weight: bold">Quantity</label>
                                        <input type="text" class="form-control" id="quantityUpdate" placeholder="Quantity">
                                    </div>
                                </div>
                                <div class="form-row upload">
                                    <input type="file" id="file-input-update" accept="image/png, image/jpeg" onchange="preview()" multiple>
                                    <label for="file-input-update" class="desc">
                                        <i class="fas fa-upload"></i> &nbsp; Choose A Photo
                                    </label>
                                    <p id="num-of-files-update">No Files Chosen</p>
                                    <div id="imagesUpdate"></div>
                                </div>
                            </form>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary update">Save changes</button>
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
            function preview(fileInput, imageContainer, numOfFiles) {
                imageContainer.innerHTML = "";
                numOfFiles.textContent = `${fileInput.files.length} Files Selected`;

                for (let file of fileInput.files) {
                    let reader = new FileReader();
                    let figure = document.createElement("figure");
                    let figCap = document.createElement("figcaption");

                    figCap.innerText = file.name;
                    figure.appendChild(figCap);

                    reader.onload = () => {
                        let img = document.createElement("img");
                        img.setAttribute("src", reader.result);
                        figure.insertBefore(img, figCap);
                    }

                    imageContainer.appendChild(figure);
                    reader.readAsDataURL(file);
                }
            }

            let fileInput = document.getElementById("file-input");
            let imageContainer = document.getElementById("images");
            let numOfFiles = document.getElementById("num-of-files");

            let fileInputUpdate = document.getElementById("file-input-update");
            let imageContainerUpdate = document.getElementById("imagesUpdate");
            let numOfFilesUpdate = document.getElementById("num-of-files-update");

            fileInput.addEventListener('change', () => {
                preview(fileInput, imageContainer, numOfFiles);
            });

            fileInputUpdate.addEventListener('change', () => {
                preview(fileInputUpdate, imageContainerUpdate, numOfFilesUpdate);
            });


            let listCategories = new Array();
            const getAllCategories = () => {
                $.ajax({
                    url: 'http://localhost:3000/database/controller/productColorController.php',
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
                        const categories = ['<option value="" selected>Select Category</option>']
                            .concat(listCategories.map((category) => `<option value="${category.id}">${category.name}</option>`));

                        const selectElement = document.getElementById('category');
                        selectElement.innerHTML = categories.join('');
                        const updateSelect = document.getElementById('categoryUpdate');
                        updateSelect.innerHTML = categories.join('');
                    }
                })
            }
            getAllCategories();

            let listProducts = new Array();
            const getAllProduct = () => {
                $.ajax({
                    url: 'http://localhost:3000/database/controller/productColorController.php',
                    type: 'GET',
                    data: {
                        action: "getProducts",
                    },
                    success: (response) => {
                        let data = JSON.parse(response);
                        data.forEach((product) => {
                            let item = {
                                id: product.product_id,
                                name: product.product_name,
                                category_id: product.category_id
                            }
                            listProducts.push(item);
                        });
                    }
                })
            }
            getAllProduct();



            function updateProductSelect(categoryId, selectId) {
                const productsToShow = listProducts
                    .filter(product => product.category_id == categoryId)
                    .map(product => `<option value="${product.id}">${product.name}</option>`);

                const selectElement = document.getElementById(selectId);
                selectElement.innerHTML = productsToShow.join('');
            }
            const selectedCategory = document.querySelector('#category');
            const selectedUpdateCategory = document.querySelector('#categoryUpdate');

            selectedCategory.addEventListener('change', (e) => {
                updateProductSelect(e.target.value, 'product');
            });

            selectedUpdateCategory.addEventListener('change', (e) => {
                updateProductSelect(e.target.value, 'productUpdate');
            });


            const showAllProductColors = () => {
                $.ajax({
                    url: 'http://localhost:3000/database/controller/productColorController.php',
                    type: 'GET',
                    data: {
                        action: "view",
                    },
                    success: (response) => {
                        let data = JSON.parse(response);
                        if (data == "No data found") {
                            data = "<h2 style=\"font-style: italic;\">No data found</h2>";
                            $('.bodyTable').html(data);
                        } else {
                            $('#example').DataTable({
                                data: data,
                                columns: [{
                                        data: 'productColorId',
                                        render: function(data, type, row) {
                                            return row.product_color_id;
                                        }
                                    },
                                    {
                                        data: 'productCategory',
                                        render: function(data, type, row) {
                                            const product = listProducts.find(item => item.id === row.product_id);
                                            if (product) {
                                                const category = listCategories.find(category => category.id === product.category_id);
                                                if (category) {
                                                    return category.name;
                                                }
                                            }
                                        }
                                    },
                                    {
                                        data: 'productColorName',
                                        render: function(data, type, row) {
                                            for (let i = 0; i < listProducts.length; i++) {
                                                if (listProducts[i].id == row.product_id) {
                                                    return listProducts[i].name;
                                                }
                                            }
                                        }
                                    },
                                    {
                                        data: 'color',
                                        render: function(data, type, row) {
                                            return row.color;
                                        }
                                    },
                                    {
                                        data: 'price',
                                        render: function(data, type, row) {
                                            return row.price + "$";
                                        }
                                    },
                                    {
                                        data: 'quantity',
                                        render: function(data, type, row) {
                                            return row.quantity;
                                        }
                                    },
                                    {
                                        data: 'sold_quantity',
                                        render: function(data, type, row) {
                                            return row.sold_quantity;
                                        }
                                    },
                                    {
                                        "data": null,
                                        render: function(data, type, row) {
                                            return `<div class="btn-group" role="group" aria-label="Basic example">
                                                <button onclick="handleUpdate(${row.product_color_id})" data-toggle="modal" data-target="#updateModal" type="button" class="btn btn-success mr-3">Update</button>
                                                <button onclick="handleDelete(${row.product_color_id})" type="button" class="btn  btn-danger">Delete</button>
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
            showAllProductColors();

            const handleDelete = (id) => {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: 'http://localhost:3000/database/controller/productColorController.php',
                            type: 'GET',
                            data: {
                                action: "delete",
                                id: id
                            },
                            success: (response) => {
                                Swal.fire(
                                    'Deleted!',
                                    'Your file has been deleted.',
                                    'success'
                                )
                                showAllProductColors();
                            }
                        })
                    }
                })
            }

            function isInteger(value) {
                return /^\d+$/.test(value);
            }

            function isFloat(value) {
                return /^\d+(\.\d+)?$/.test(value);
            }

            const addProductColor = document.querySelector('.addProductColor');
            addProductColor.onclick = function() {
                function isEmpty(value) {
                    return value.trim() === '';
                }
                const fields = ['category', 'product', 'color', 'price', 'quantity'];
                fields.forEach(field => {
                    const element = document.querySelector(`#${field}`);
                    if (isEmpty(element.value)) {
                        element.classList.add('is-invalid');
                    } else {
                        element.classList.remove('is-invalid');
                    }
                });

                let listImages = Array.from(document.querySelectorAll('figcaption')).map((element) => element.innerHTML);


                if (fields.some(field => isEmpty(document.querySelector(`#${field}`).value))) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Please fill all fields',
                    });
                } else if (!isInteger(document.querySelector(`#quantity`).value) || !isFloat(document.querySelector(`#price`).value)) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Price must be float or integer, quantity must be integer',
                    });

                } else {
                    const existColor = document.querySelector('#existColor');
                    const addForm = document.querySelector("#addForm");
                    const data = new FormData();
                    data.append('categoryId', $('#category').val());
                    data.append('productId', $('#product').val());
                    data.append('color', $('#color').val());
                    data.append('price', $('#price').val());
                    data.append('quantity', $('#quantity').val());
                    data.append('images', listImages);
                    data.append('action', "addProductColor");
                    $.ajax({
                        url: 'http://localhost:3000/database/controller/productColorController.php',
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
                                        title: "Add Successfully",
                                        confirmButtonText: 'OK',
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            showAllProductColors();
                                        }
                                    })
                                    break;
                                default:
                                    if (response.includes("existColor")) {
                                        existColor.classList.remove('d-none');
                                    } else {
                                        existColor.classList.add('d-none');
                                    }
                                    Swal.fire({
                                        title: 'Something was wrong',
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
                    url: 'http://localhost:3000/database/controller/productColorController.php',
                    type: 'GET',
                    data: {
                        action: "getProductColorById",
                        id: id
                    },
                    success: (response) => {
                        let data = JSON.parse(response);
                        let product = data[0];
                        let images = data.slice(1);
                        let category;
                        listProducts.forEach((product) => {
                            if (product.id == data[0].product_id) {
                                category = product.category_id;
                            }
                        })
                        const selectElement = document.getElementById('categoryUpdate');
                        Array.from(selectElement.options).forEach(option => {
                            if (option.value === category) {
                                option.selected = true;
                            } else {
                                option.selected = false;
                            }
                        });
                        let productsToShow = [];
                        listProducts.forEach((product) => {
                            if (product.category_id == category) {
                                productsToShow.push(`<option value="${product.id}">${product.name}</option>`);
                            }
                        })
                        const updateSelect = document.getElementById('productUpdate');
                        updateSelect.innerHTML = productsToShow.join('');
                        $("#productColorId").val(data[0].product_color_id);
                        $("#productUpdate").val(data[0].product_id);
                        $("#colorUpdate").val(data[0].color);
                        $("#priceUpdate").val(data[0].price);
                        $("#quantityUpdate").val(data[0].quantity);
                        if (images.length > 0) {
                            let listImage = [];
                            images.forEach((image) => {
                                listImage.push(`<figure><img src="./images/${image.image}"><figcaption>${image.image}</figcaption></figure>`)
                            })
                            const imagesUpdate = document.getElementById('imagesUpdate');
                            imagesUpdate.innerHTML = listImage.join('');
                            numOfFilesUpdate.innerHTML = `${images.length} files chosen`;
                        }
                    }
                })
            }

            const updateBtn = document.querySelector('.update');
            updateBtn.onclick = function() {
                function isEmpty(value) {
                    return value.trim() === '';
                }
                const fields = ['categoryUpdate', 'productUpdate', 'colorUpdate', 'priceUpdate', 'quantityUpdate'];
                fields.forEach(field => {
                    const element = document.querySelector(`#${field}`);
                    if (isEmpty(element.value)) {
                        element.classList.add('is-invalid');
                    } else {
                        element.classList.remove('is-invalid');
                    }
                });

                let listImages = Array.from(document.querySelectorAll('figcaption')).map((element) => element.innerHTML);

                if (fields.some(field => isEmpty(document.querySelector(`#${field}`).value))) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Please fill all fields',
                    });
                } else if (!isInteger(document.querySelector(`#quantityUpdate`).value) || !isFloat(document.querySelector(`#priceUpdate`).value)) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Price must be float or integer, quantity must be integer',
                    });

                } else {
                    const existColor = document.querySelector('#existColorUpdate');
                    console.log(existColor);
                    const addForm = document.querySelector("#addForm");
                    const data = new FormData();
                    data.append('id', $('#productColorId').val());
                    data.append('categoryId', $('#categoryUpdate').val());
                    data.append('productId', $('#productUpdate').val());
                    data.append('color', $('#colorUpdate').val());
                    data.append('price', $('#priceUpdate').val());
                    data.append('quantity', $('#quantityUpdate').val());
                    data.append('images', listImages);
                    data.append('action', "updateProductColor");
                    $.ajax({
                        url: 'http://localhost:3000/database/controller/productColorController.php',
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
                                        title: "Update Successfully",
                                        confirmButtonText: 'OK',
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            showAllProductColors();
                                        }
                                    })
                                    break;
                                default:
                                    if (response.includes("existData")) {
                                        existColor.classList.remove('d-none');
                                    } else {
                                        existColor.classList.add('d-none');
                                    }
                                    Swal.fire({
                                        title: 'Something was wrong',
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