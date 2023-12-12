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

        .list-img span {
            cursor: pointer;
            padding: 5px;
            background-color: #bbb;
        }

        .list-img span.active {
            background-color: rgb(220, 86, 86);
        }

        .list-color .active {
            background-color: white;
            color: blue;
        }

        .dropdown-toggle::after {
            content: none;
        }

        .dropdown-toggle {
            background-color: transparent;
        }
    </style>
</head>

<body>
    <?php include './components/header.php' ?>
    <div class="container">
        <div class="row d-flex p-5" style=" background-color: white">
            <div class="col-md-6 images">
                <div class="container mt-3">
                    <div class="main border">
                        <span class="control prev">
                            <i class="bx bx-chevron-left"></i>
                        </span>
                        <span class="control next">
                            <i class="bx bx-chevron-right"></i>
                        </span>
                        <div class="img-wrap" style="height: 500px;object-fit: cover">
                            <img src="images/iphone14black1.jpg" class="mainImage" />
                        </div>
                    </div>
                    <div class="list-img">

                    </div>
                </div>
            </div>
            <div class="col-md-6 rightSide">

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
        const getProduct = () => {
            const urlParams = new URLSearchParams(window.location.search);
            const productId = urlParams.get('id');
            $.ajax({
                url: 'http://localhost:3000/database/controller/productColorController.php',
                type: 'GET',
                data: {
                    action: "getProductDetails",
                    productId: productId,
                },
                success: (response) => {
                    let data = JSON.parse(response);
                    console.log(data);
                    const mainImage = document.querySelector('.mainImage');
                    mainImage.src = `images/${data.productImage[0][0].image}`;
                    const listImage = document.querySelector('.list-img');
                    let htmlLeftSide = "";
                    let indexImage = 0;
                    data.productImage.forEach(function(images, index1) {
                        images.forEach(function(image, index2) {
                            htmlLeftSide += `<span class=" ${index1 == 0 && index2 == 0 ? "active" : ""}" ">
                            <img src="images/${image.image}" alt ="${image.image}" id="image${indexImage}" class="${image.product_color_id}" style="width: 80px;height: 80px; object-fit: cover" />
                        </span>`
                            indexImage++;
                        })
                    });
                    listImage.innerHTML = htmlLeftSide;
                    const rightSide = document.querySelector('.rightSide');
                    let listPriceProduct = "";
                    data.productColor.forEach(function(product, index) {
                        listPriceProduct += `<h2 style="color: #ee4d2d; font-weight: 500; font-size: 30px; font-style: italic" class="price${index} ${index == 0 ? "" : "d-none"}" >$${product.price}</h2>`;
                    });
                    let htmlRightSide = `<div class="mt-2">
                    <h2 style="font-weight: bold; font-size: 35px">${data.product[0].product_name}</h2>
                    <div class="d-flex mt-3">
                        <span style="padding-right: 30px; border-right: 1px solid black">`
                    for (var i = 0; i < data.product[0].rate; i++) {
                        htmlRightSide += `<i class="fas fa-star" style="color: #FA8232"></i>`;
                    }

                    // Loop to add empty stars for the remaining
                    for (var i = 0; i < 5 - data.product[0].rate; i++) {
                        htmlRightSide += `<i class="fas fa-star"></i>`;
                    }
                    let sumOfSold = 0;
                    data.productColor.forEach(function(product) {
                        sumOfSold += Number(product.sold_quantity);
                    })
                    let listcolor = ``;
                    data.productColor.forEach(function(product, index1) {
                        listcolor += ` <input type="button" class="btn btn-info ${index1 == 0 ? " active" : ""} color" name="${product.product_color_id}" value="${product.color}"></input>`
                    });
                    let listQuantiyproduct = "";
                    data.productColor.forEach(function(product, index) {
                        if (product.quantity > 0) {
                            listQuantiyproduct += ` <p style="color: #757575; font-style: italic" class="quantiy${index} ${index == 0 ? "" : "d-none"} ml-4" id="${product.quantity}">${product.quantity} quantities</p>`;
                        } else {
                            listQuantiyproduct += `<p style="color: red;font-weight: bold; font-style: italic" class="quantiy${index} ${index == 1 ? "" : "d-none"} ml-4" id="${product.quantity}">SOLD OUT</p>`;
                        }
                    })

                    htmlRightSide += `</span>
                        <span style="margin-left: 30px;padding-right: 30px; border-right: 1px solid black;font-size: 14px;font-weight: bold">0 reviews</span>
                        <span style="margin-left: 30px;padding-right: 30px; border-right: 1px solid black;font-size: 14px;font-weight: bold">
                            ${sumOfSold} Sold
                        </span>
                    </div>
                </div>
                <div class="list-price mt-3">
                    ${listPriceProduct}
                </div>
                <div class="d-flex justify-content-between">
                    <div>
                        <div style="font-size: 20px;font-weight: bold; margin-right: 50px">Category:</div>
                        <div class="category" style="color: black; font-size: 20px; font-style: italic">
                            ${data.category[0].category_name}
                        </div>
                    </div>
                    <div><div style="font-size: 20px;font-weight: bold; margin-right: 50px">Availability:</div>
                    <div class="category">
                    <div class="category" style="color: green; font-size: 20px; font-style: italic">
                        in stock
                    </div></div>
                    </div>
                </div>    
                <div class="d-flex align-items-center mt-4">
                    <div style="font-size: 20px;font-weight: bold; margin-right: 50px">Color:</div>
                    <div class="list-color">
                        ${listcolor}
                    </div>
                </div>
                <input type="text" hidden="" name="color" value class="inputColor">
                <input type="text" value="${data.product.product_id}" hidden="" name="productID">
                <div class="d-flex mt-4">
                    <div style="font-size: 20px;font-weight: bold; margin-right: 50px">Quantity:</div>
                    <div>
                        <input type="number" id="quantity" name="quantity" min="1" value="1">
                        <input type="text" id="inventory" name="inventory" hidden="">
                    </div>
                    <div class="list-quantity">
                        ${listQuantiyproduct}
                    </div>
                </div>
                <div class="d-flex mt-3" style="gap: 30px">
                    <button id="submitBtn" type="button" style="text-decoration: none; color: #ee4d2d; background-color: rgba(255,87,34,0.1); border: 1px solid #ee4d2d; padding: 15px 40px">Add to cart</button>
                    <button id="buyNow" type="button" style="background-color: rgb(238, 77, 45); color: rgb(255, 255, 255);border: 1px solid #ee4d2d; padding: 15px 40px">
                        <i class="fa-solid fa-money-bills"></i>
                        BUY NOW
                    </button>
                </div>`
                    rightSide.innerHTML = htmlRightSide;
                    const listImg = document.querySelectorAll(".list-img span");
                    const img = document.querySelector(".img-wrap img");
                    const prevBtn = document.querySelector(".prev");
                    const nextBtn = document.querySelector(".next");
                    let currentIndex = 0;
                    const colors = document.querySelectorAll(".color");
                    const colorActiveDefault = document.querySelector(".list-color .active");
                    const colorDefault = document.querySelector(".inputColor");
                    colorDefault.value = colorActiveDefault.value;
                    colors.forEach((value, index) => {
                        value.addEventListener("click", function() {
                            const colorActive = document.querySelector(".list-color .active");
                            const color = document.querySelector(".inputColor");
                            color.value = value.value;
                            colorActive.classList.remove("active");
                            value.classList.add("active");
                            let dup = true;
                            listImg.forEach(function(img,index) {
                                if (img.querySelector('img').className == value.name && dup ==true) {
                                    currentIndex = index;
                                    dup =false;
                                }
                            })
                            display(currentIndex);
                            displayInformation(index);
                        });
                    });
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
                                value.classList.add("active");
                                const x = document.querySelector(`#image${currentIndex}`);
                                img.src = `images/${x.alt}`;
                            } else {
                                value.classList.remove("active");
                            }
                        });
                    };
                    const listPrice = document.querySelectorAll(".list-price h2");
                    const listQuantiy = document.querySelectorAll(".list-quantity p");
                    const displayInformation = function(currentIndex) {
                        listPrice.forEach(function(value, index) {
                            if (currentIndex === index) {
                                value.classList.remove("d-none");
                            } else {
                                value.classList.add("d-none");
                            }
                        });
                        listQuantiy.forEach(function(value, index) {
                            if (currentIndex === index) {
                                value.classList.remove("d-none");
                                const numberInput = document.getElementById('quantity');
                                numberInput.value = 1;
                                numberInput.max = value.id; // Set the maximum value to 100 
                                const inventory = document.querySelector("#inventory");
                                inventory.value = value.id;
                            } else {
                                value.classList.add("d-none");
                            }
                        });
                    };
                    displayInformation(currentIndex);
                }
            })
        }
        getProduct();
    </script>
</body>

</html>