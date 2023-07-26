<script setup>
import AddProductHeaderComponent from '../components/AddProductHeaderComponent.vue';
</script>
<template>
  <AddProductHeaderComponent></AddProductHeaderComponent>
  <main>
    <div class="page-content">
        <div class="form-section">
            <form id="product-form" method="post" action="">
                <div class="options-container stable-options">
                    <label>SKU</label><br>
                    <input type="text" id="sku" name="sku" required><br>
                    <label>NAME</label><br>
                    <input type="text" id="name" name="name" required><br>
                    <label>PRICE($)</label><br>
                    <input type="number" id="price" name="price" required><br>
                </div>

                <div class="options-container changing-options">
                    <label>Type Switcher:</label>
                    <select name="type" id="product-type">
                        <option value="dvd">DVD</option>
                        <option value="furniture">Furniture</option>
                        <option value="book">Book</option>
                    </select>
                    <div id="dvd-options">
                        <label>SIZE(MP)</label><br>
                        <input type="number" id="size" name="size"><br>
                    </div>
                    <div id="furniture-options">
                        <label>Height (CM)</label><br>
                        <input type="number" id="height" name="height"><br>
                        <label>Width (CM)</label><br>
                        <input type="number" id="width" name="width"><br>
                        <label>Length (CM)</label><br>
                        <input type="number" id="length" name="length"><br>
                    </div>
                    <div id="book-options">
                        <label>Weight(KG)</label><br>
                        <input type="number" id="weight" name="weight"><br>
                    </div>
                </div>
            </form>
        </div>
    </div>
  </main>
</template>
<style scoped>
    .form-section{
        border-radius: 16px;
        background: #F2F2F2;
        margin-top:60px;
        margin-left: 140px;
        margin-right: 140px;
        padding: 40px;
    }
    .options-container{
        border-radius: 12px;
        padding: 32px;
        background: #FFF;
        height: fit-content;
    }
    #product-form{
        display: flex;
        gap: 40px;
    }
    label{
        color: #141414;
        font-family: 'Inter',  sans-serif;
        font-size: 20px;
        font-style: normal;
        font-weight: 700;
        line-height: normal;
        
    }
    input{
        margin-top: 16px;
        margin-bottom: 16px;
        width: 400px;
        height: 35px;
        font-size: 16px;
        font-style: normal;
        font-weight: 400;
        border-radius: 8px;
        border: 1px solid #E0E0E0;  
        padding-left: 12px;
    }
</style>