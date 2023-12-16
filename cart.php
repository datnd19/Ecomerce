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
                                <tbody>
                                    <c:set var="check" value="0"></c:set>
                                    <c:forEach var="c" items="${listcart}">
                                        <tr>
                                            <c:forEach var="pc" items="${listProdColor}">
                                                <c:if test="${pc.product_color_id == c.product_color_id}">
                                                    <c:forEach var="p" items="${listProd}">
                                                        <c:if test="${pc.product_id == p.product_id}">
                                                            <td class="p-4">${p.name}</td>
                                                        </c:if>
                                                    </c:forEach>
                                                    <td class="p-4">${pc.color}</td>
                                                    <td class="p-2"><img src="images/${pc.image}" alt="alt" style="width: 70px;height: 70px  "></td>
                                                    <td class="text-right font-weight-semibold align-middle p-4 price${check}">${pc.price}</td>
                                                    <td class="align-middle p-4"><input type="number" id="quantity" class="quantity" name="quantity" data-item="${c.product_color_id}" class="form-control text-center" min="1" max="${pc.quantity}" value="${c.quantity}"></td>
                                                </c:if>
                                            </c:forEach>
                                            <td class="text-right font-weight-semibold align-middle p-4 total${check}" style="width: 150px">$115.1</td>
                                            <td class="text-center align-middle px-0"><a onclick="doDelete(${c.product_color_id})" class="shop-tooltip close float-none text-danger removeBtn" title="" data-original-title="Remove">×</a></td>
                                            <c:set var="check" value="${check+1}"></c:set>
                                        </tr>
                                    </c:forEach>
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
</body>

</html>