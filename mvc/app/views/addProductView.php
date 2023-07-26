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
        <h1>Product Add:</h1>
        <div class="buttons-section">
            <div class="button" id="save-button">SAVE</div>
            <div class="button"  id="cancel-button">CANCEL</div>
        </div>
        <hr>
        <div class="form-section">
            <form id="product-form" method="post" action="">
                <label>SKU</label>
                <input type="text" id="sku" name="sku"><br>
                <label>NAME</label>
                <input type="text" id="name" name="name"><br>
                <label>PRICE($)</label>
                <input type="number" id="price" name="price"><br>
                <label>Type Switcher:</label>
                <select name="type" id="product-type">
                    <option value="dvd">DVD</option>
                    <option value="furniture">Furniture</option>
                    <option value="book">Book</option>
                </select>
                <div id="changing-options">
                    <div id="dvd-options">
                        <label>SIZE(MP)</label>
                        <input type="number" id="size" name="size"><br>
                    </div>
                    <div id="furniture-options">
                        <label>Height (CM)</label>
                        <input type="number" id="height" name="height"><br>
                        <label>Width (CM)</label>
                        <input type="number" id="width" name="width"><br>
                        <label>Length (CM)</label>
                        <input type="number" id="length" name="length"><br>
                    </div>
                    <div id="book-options">
                        <label>Weight(KG)</label>
                        <input type="number" id="weight" name="weight"><br>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script src="../../mvc/public/assets/js/add_product.js">

    </script>
</body>
</html>
