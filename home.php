<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <link rel="stylesheet" href="./css/style.css">
    <style>
        .dropdown-toggle::after {
            content: none;
        }

        .dropdown-toggle {
            background-color: transparent;
        }

        body {
            overflow-x: hidden;

        }

        img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
        }

        .main {
            height: 85%;
            position: relative;
        }

        .control {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            font-size: 80px;
            color: white;
            cursor: pointer;
        }

        .prev {
            left: -10px;
            color: black
        }

        .next {
            right: -10px;
            color: black
        }

        .img-wrap {
            width: 100%;
            height: 100%;
        }

        .list-img {
            display: flex;
        }

        .list-img div {
            cursor: pointer;
            padding: 5px;
            background-color: #bbb;
            flex: 1;
        }

        .list-img div.active {
            background-color: rgb(220, 86, 86);
        }

        .list {
            margin-left: 60px;
            display: flex;
            gap: 40px;
            flex-wrap: wrap;
        }
    </style>
</head>

<body>
    <?php include './components/header.php' ?>
    <div class="container mt-5">
        <div class="main border">
            <span class="control prev">
                <i class="fa-solid fa-arrow-left"></i>
            </span>
            <span class="control next">
                <i class="fa-solid fa-right-long"></i>
            </span>
            <div class="img-wrap" style="height: 400px;object-fit: cover">
                <img src="images/image1.jpg" alt="" />
            </div>
        </div>
        <div class="list-img">
            <div class="d-none">
                <img src="images/image1.jpg" alt="" />
            </div>
            <div class="d-none">
                <img src="images/image2.jpg" alt="" />
            </div>
            <div class="d-none">
                <img src="images/image3.jpg" alt="" />
            </div>
            <div class="d-none">
                <img src="images/image4.jpg" alt="" />
            </div>
            <div class="d-none">
                <img src="images/image5.jpg" alt="" />
            </div>
        </div>
    </div>

    <div class="container ">
        <div class="row d-flex gap-2 mt-4">
            <div class="col-md-2">
                <form id="filterForm">
                    <input type="text" class="searchInput" name="search" hidden="">
                    <div>
                        <label for="sort">
                            <h4>Sort by:</h4>
                        </label>
                        <select id="sort" class="form-control" name="sort">
                            <option selected=""></option>
                            <option value="price asc">Price ascending</option>
                            <option value="price desc">Price descending</option>
                            <option value="total_sold desc">Best Seller</option>
                            <option value="product.create_at desc">New Product</option>
                        </select>
                    </div>
                    <hr />
                    <div class="filterCategory">


                    </div>
                    <hr />
                    <div>
                        <h4>Price</h4>
                        <div class="d-flex">
                            <div class="mr-3">
                                <input type="text" id="pricefrom" style="width: 50px;border-radius: 5px" placeholder="From">$
                            </div>
                            <div>
                                <input type="text" id="priceto" style="width: 50px;border-radius: 5px" placeholder="To">$
                            </div>
                        </div>
                    </div>
                    <hr />
                    <div>
                        <h4>Rate</h4>
                        <input type="radio" id="5" name="star" value="5">
                        <label for="5">
                            <i class="fas fa-star" style="color: #FA8232"></i>
                            <i class="fas fa-star" style="color: #FA8232"></i>
                            <i class="fas fa-star" style="color: #FA8232"></i>
                            <i class="fas fa-star" style="color: #FA8232"></i>
                            <i class="fas fa-star" style="color: #FA8232"></i>
                        </label><br>
                        <input type="radio" id="4" name="star" value="4">
                        <label for="4">
                            <i class="fas fa-star" style="color: #FA8232"></i>
                            <i class="fas fa-star" style="color: #FA8232"></i>
                            <i class="fas fa-star" style="color: #FA8232"></i>
                            <i class="fas fa-star" style="color: #FA8232"></i>
                            <i class="far fa-star"></i>
                        </label><br>
                        <input type="radio" id="3" name="star" value="3">
                        <label for="3">
                            <i class="fas fa-star" style="color: #FA8232"></i>
                            <i class="fas fa-star" style="color: #FA8232"></i>
                            <i class="fas fa-star" style="color: #FA8232"></i>
                            <i class="far fa-star"></i>
                            <i class="far fa-star"></i>
                        </label><br>
                        <input type="radio" id="2" name="star" value="2">
                        <label for="2">
                            <i class="fas fa-star" style="color: #FA8232"></i>
                            <i class="fas fa-star" style="color: #FA8232"></i>
                            <i class="far fa-star"></i>
                            <i class="far fa-star"></i>
                            <i class="far fa-star"></i>
                        </label><br>
                        <input type="radio" id="1" name="star" value="1">
                        <label for="1">
                            <i class="fas fa-star" style="color: #FA8232"></i>
                            <i class="far fa-star"></i>
                            <i class="far fa-star"></i>
                            <i class="far fa-star"></i>
                            <i class="far fa-star"></i>
                        </label>
                    </div>
                    <hr />
                    <input type="button" id="filterBtn" value="Filter" class="btn btn-primary" style="width: 155px">
                </form>
            </div>

            <div class="col-md-10">
                <div class="d-flex justify-content-between align-items-center mb-4" style="padding: 12px 24px; background-color: #F2F4F5;">
                    <div>Active Filters: </div>
                    <div><b>65,867</b> Results found.</div>
                </div>
                <div class="d-flex flex-wrap listProduct">

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
        const listImg = document.querySelectorAll(".list-img div");
        const img = document.querySelector(".img-wrap img");
        const prevBtn = document.querySelector(".prev");
        const nextBtn = document.querySelector(".next");

        let currentIndex = 0;

        prevBtn.addEventListener("click", function() {
            if (currentIndex === 0) {
                currentIndex = listImg.length - 1;
                display(currentIndex);
            } else {
                currentIndex--;
                display(currentIndex);
            }
        });

        nextBtn.addEventListener("click", function() {
            if (currentIndex === listImg.length - 1) {
                currentIndex = 0;
                display(currentIndex);
            } else {
                currentIndex++;
                display(currentIndex);
            }
        });

        const display = function(currentIndex) {
            listImg.forEach(function(value, index) {
                if (currentIndex === index) {
                    img.src = `images/image${currentIndex + 1}.jpg`;
                } else {
                    value.classList.remove("active");
                }
            });
        };

        setInterval(function() {
            currentIndex++;
            if (currentIndex === listImg.length) {
                currentIndex = 0;
            }
            display(currentIndex);
        }, 2000);

        const viewAll = () => {
            const data = new FormData();
            // data.append('sort', $('#sort').val());
            // data.append('category', $('input[name="category"]:checked').val());
            // data.append('pricefrom', $('#pricefrom').val());
            // data.append('priceto', $('#priceTo').val());
            // data.append('rate', $('input[name="star"]:checked').val());
            // data.append('action', 'view');
            // data.append('categoryId', $('#category').val());
            // data.append('productId', $('#product').val());
            // data.append('color', $('#color').val());
            // data.append('price', $('#price').val());
            // data.append('quantity', $('#quantity').val());
            // data.append('action', "addProductColor");
            $.ajax({
                url: 'http://localhost:3000/database/controller/homeController.php',
                type: 'GET',
                data: {
                    action: 'view',
                },
                success: (response) => {
                    let data = JSON.parse(response);
                    let html = "<h5>Category</h5>";
                    data.dataCategory.forEach(function(category) {
                        html += `<input type="radio" id="category${category.category_id}" name="category" value="${category.category_id}">
                    <label for="category${category.category_id}">${category.category_name}</label>
                    <br />`
                    })
                    document.querySelector('.filterCategory').innerHTML = html;


                    let content = "";
                    data.dataProduct.forEach(function(product) {
                        content += `<div style="padding: 16px; border: 1px solid #E4E7E9; border-radius: 3px;" class="mr-3">`
                        let src = "";
                        data.dataImage.forEach(function(image) {
                            if (image.product_id == product.product_id) {
                                src = image.image;
                            }
                        })
                        content += `<img src="./images/${src}" alt="" style="width: 180px; height: 180px; object-fit: cover; margin-bottom: 24px;">
                        <div>`;

                        // Loop to add filled stars based on product.rate
                        for (var i = 0; i < product.rate; i++) {
                            content += `<i class="fas fa-star" style="color: #FA8232"></i>`;
                        }

                        // Loop to add empty stars for the remaining
                        for (var i = 0; i < 5 - product.rate; i++) {
                            content += `<i class="fas fa-star"></i>`;
                        }

                        content += `<span>(${product.total_sold_quantity})</span>
                        </div>
                    <div style="color: #191C1F; font-size: 14px; font-weight: 400; margin: 8px 0px;">
                         ${product.product_name}
                        </div>
                     <div style="color: #2DA5F3;">
                         ${product.price}$
                    </div>
                    </div>`;
                    })
                    document.querySelector('.listProduct').innerHTML = content;

                }
            })
        }
        viewAll();
        console.log(document.querySelector('#filterBtn'));
        document.getElementById('filterBtn').onclick = function(e) {
            viewAll();
        };
    </script>
</body>

</html>