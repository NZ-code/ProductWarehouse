<div class="product-container">
    <input type="checkbox" class="delete-checkbox">
    <input type="hidden" class="product-id-input" value="<?php echo $product->getId()?>">
    <div class="product-properties">
        <?php
        echo '<p >id : '. $product->getId() .'</p>';
        echo '<p >sku : '. $product->getSku() .'</p>';
        echo '<p >name : '. $product->getName() .'</p>';
        echo '<p >price : '. $product->getPrice() .'</p>';
        foreach ($product->getSpecificProperties() as $key => $value) {
            echo '<p>' . $key .':'. $value .'</p>';
        }
        ?>
    </div>
</div>