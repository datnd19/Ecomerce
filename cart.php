<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="./css/style.css">
    <style>
        body {
            background: #eee;
        }

        .ui-w-40 {
            width: 40px !important;
            height: auto;
        }

        .card {
            box-shadow: 0 1px 15px 1px rgba(52, 40, 104, .08);
        }

        .ui-product-color {
            display: inline-block;
            overflow: hidden;
            margin: .144em;
            width: .875rem;
            height: .875rem;
            border-radius: 10rem;
            -webkit-box-shadow: 0 0 0 1px rgba(0, 0, 0, 0.15) inset;
            box-shadow: 0 0 0 1px rgba(0, 0, 0, 0.15) inset;
            vertical-align: middle;
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
    <div class="row mt-5">
        <div class="container" style="background-color: white">
            <div class="container px-3 my-5 clearfix">
                <!-- Shopping cart table -->
                <div class="card">
                    <div class="card-header">
                        <h2>Shopping Cart</h2>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered m-0 table-hover" id="cartTable">
                                <thead>
                                    <tr>
                                        <th class="text-center py-3 px-4" style="min-width: 100px;">Product Name</th>
                                        <th class="text-center py-3 px-4" style="min-width: 100px;">Color</th>
                                        <th class="text-center py-3 px-4" style="min-width: 200px;">Image</th>
                                        <th class="text-right py-3 px-4" style="width: 100px;">Price</th>
                                        <th class="text-center py-3 px-4" style="width: 120px;">Quantity</th>
                                        <th class="text-right py-3 px-4" style="width: 100px;">Total</th>
                                        <th class="text-center align-middle py-3 px-0" style="width: 40px;"><a href="#" class="shop-tooltip float-none text-light" title="" data-original-title="Clear cart"><i class="ino ion-md-trash"></i></a></th>
                                    </tr>
                                </thead>
                                <tbody class="cartTable">

                                </tbody>
                            </table>
                        </div>
                        <!-- / Shopping cart table -->

                        <div class="d-flex flex-wrap justify-content-end align-items-center pb-4">
                            <div class="d-flex">
                                <div class="text-right mt-4">
                                    <label class="text-muted font-weight-normal m-0">Total price</label>
                                    <div class="text-large"><strong></strong></div>
                                </div>
                            </div>
                        </div>

                        <div class="float-right">
                            <a href="home"><button type="button" class="btn btn-lg btn-default md-btn-flat mt-2 mr-3">Back to shopping</button></a>
                            <button type="button" id="checkoutButton" class="btn btn-lg btn-primary mt-2">Checkout</button>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        const doDelete = (id) => {
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
                        type: "post",
                        url: "http://localhost:3000/database/controller/cartController.php",
                        data: {
                            productColorID: id,
                            action: 'removeCartItem',
                        },
                        cache: false,
                        success: function(response) {
                            Swal.fire(
                                'Deleted!',
                                'Your item has been deleted.',
                                'success'
                            )
                            viewCart();
                        }
                    });
                }
            });
        };

        const viewCart = function() {
            $.ajax({
                url: 'http://localhost:3000/database/controller/cartController.php',
                type: 'GET',
                data: {
                    action: 'viewCart',
                },
                success: (response) => {
                    console.log(2);
                    let data = JSON.parse(response);
                    let html = "";
                    data.forEach(function(item, currentIndex) {
                        html += `<tr>
                                    <td class="p-4">${item.dataProduct[0].product_name}</td>
                                    <td class="p-4">${item.dataProductColor[0].color}</td>
                                    <td class="p-2 d-flex flex-wrap">`;
                        item.dataProductImage.forEach(function(item, currentIndex) {
                            html += `<img src="images/${item.image}" alt="alt" style="width: 80px;height: 80px; margin-right:5px;object-fit:cover">`;
                        })
                        html += `</td>
                                    <td class="text-right font-weight-semibold align-middle p-4 price${currentIndex}">${item.dataProductColor[0].price}</td>
                                    <td class="align-middle p-4"><input type="number" id="quantity" class="quantity" name="quantity" data-item="${item.dataProductColor[0].product_color_id}" class="form-control text-center" min="1" max="${item.dataProductColor[0].quantity}" value="${item.quantity}"></td>
                                    <td class="text-right font-weight-semibold align-middle p-4 total${currentIndex}" style="width: 150px">$115.1</td>
                                    <td class="text-center align-middle px-0"><a onclick="doDelete(${item.dataProductColor[0].product_color_id})" class="shop-tooltip close float-none text-danger removeBtn" title="" data-original-title="Remove">×</a></td>
                                    </tr>`;
                    })
                    const cartTable = document.querySelector('.cartTable');
                    cartTable.innerHTML = html;
                    const totalAll = $("strong");
            let totalCart = 0;
                    $(".quantity").each(function(index) {
                        const price = $(".price" + index);
                        const total = $(".total" + index);
                        total.html('$' + Number(price.html()) * Number($(this).val()));
                        totalCart += Number(price.html()) * Number($(this).val());
                    });

                    totalAll.html('$' + totalCart);
                }
            })
        }
        viewCart();
        $(document).on('input', '.quantity', function() {
            if (+$(this).val() > +$(this).attr('max')) {
                $(this).val($(this).attr('max'));
            }
            const totalAll = $("strong");
            let totalCart = 0;
            $(".quantity").each(function(index) {
                const price = $(".price" + index);
                const total = $(".total" + index);
                total.html('$' + Number(price.html()) * Number($(this).val()));
                totalCart += Number(price.html()) * Number($(this).val());
            });

            totalAll.html('$' + totalCart);
            $.ajax({
                type: "post",
                url: "http://localhost:3000/database/controller/cartController.php",
                data: {
                    productColorID: $(this).data('item'),
                    quantity: $(this).val(),
                    action: 'updateCartQuantity',
                },
                cache: false,
                success: function(response) {
                    console.log(response);
                }
            });
        });
    </script>

</body>

</html>