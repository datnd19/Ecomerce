<?php
include '../config.php';

if (isset($_GET['action']) && $_GET['action'] == 'view') {
    $sqlCategory = "SELECT * FROM category ";
    $dataCategory = Query($sqlCategory, $connection);
    $response = array();
    $response['dataCategory'] = $dataCategory;

    $sqlProduct = "SELECT
    product.product_id,
    product.product_name,
    product.rate,
    product_color.price,
    SUM(product_color.sold_quantity) AS total_sold_quantity
FROM
    product
JOIN
    product_color ON product.product_id = product_color.product_id
GROUP BY
    product.product_id, product.product_name, product.rate;";
    $dataProduct = Query($sqlProduct, $connection);
    $response['dataProduct'] = $dataProduct;

    $sqlImage = "SELECT pc.product_id, pc.product_color_id, pc.color, MIN(pi.image) AS image
    FROM product_color pc
    JOIN product_image pi ON pc.product_color_id = pi.product_color_id
    GROUP BY pc.product_color_id, pc.color;";

    $dataImage = Query($sqlImage, $connection);
    $response['dataImage'] = $dataImage;

    if (empty($response)) {
        echo json_encode("No data found");
    } else {
        echo json_encode($response);
    }
}



