<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../mvc/public/assets/css/store.css">
    <link rel="stylesheet" href="../../mvc/public/assets/css/main.css">
    <title>Store</title>
</head>
<body>
    <div class="page-content">
        <h1>Product List:</h1>
        <div class="buttons-section">
            <div class="button"><a href="addproduct">ADD</a></div>
            <div class="button" id="delete-product-btn">MASS DELETE</div>
        </div>
        <hr>
         
        <div class="products-section">
            <?php
                foreach ($products as $product) {
                    $productViewPath = __DIR__ . '/productView.php';
                    include $productViewPath;
                }
            ?>
        </div>
        <script src="../../mvc/public/assets/js/store.js"></script>
    </div>
</body>
</html>
