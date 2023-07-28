<script>
import { API_URL } from '../utils/constants';
import axios from 'axios';
class ProductForm{
    type="dvd";
    sku="";
    name="";
    price="";
    size="";
    weight="";
    width="";
    height="";
    length="";
}

export default {
  data() {
    return {
        productForm : new ProductForm(),
        selectedType:"dvd",
        invalidFormWasSubmitted:false
    }
  },
  methods:{
    isFormValid(){
        if((this.isSkuValid && this.isNameValid && this.isPriceValid) == false){
            return false;
        }
        return true;
    },
    submitForm(){

        let isFormValid = this.isFormValid();
        if(isFormValid){
            this.postProduct()

            
        }
        else{
            this.invalidFormWasSubmitted = true;
        }
    },
    onSaveClick() {
        this.submitForm();
    },
    postProduct(){
        const formData = new FormData();
        for(var key in this.productForm){
            formData.append(key, this.productForm[key]);
        }
        axios.post(API_URL, formData)
                .then(
                    response =>{
                        this.$router.push('/');
                    }
                )
                .catch(error =>{
                    console.error('Error posting product:', error);
                });
    },
    onCancelClick() {
        this.$router.push('/');
    }
  },
  computed:{
    isSkuValid(){
        const skuLettersCount = this.productForm.sku.length;
        return  skuLettersCount >= 8  && skuLettersCount <= 12;
    },
    isNameValid(){
        const nameLettersCount = this.productForm.name.length;
        return  nameLettersCount >= 1  && nameLettersCount <= 100;
    },
    isPriceValid(){
        return  this.productForm.price >= 0 && typeof this.productForm.price === 'number';
    },
    isSizeValid(){
        return  this.productForm.size >= 0 && typeof this.productForm.size === 'number';
    },
    isWeightValid(){
        return  this.productForm.weight >= 0 && typeof this.productForm.weight === 'number';
    },
    isDimensionsValid(){
        const isWidthValid = this.productForm.width >= 0 && typeof this.productForm.width === 'number';
        const isHeightValid = this.productForm.height >= 0 && typeof this.productForm.height === 'number';
        const isLengthValid = this.productForm.length >= 0 && typeof this.productForm.length === 'number';
        return isHeightValid && isLengthValid && isWidthValid;
    }
  }
}
</script>
<template>
    <header>
        <nav class="header-content">
            <p class="header-title">Add Product:</p>
            <div class="buttons-section">
                <button class="nav-button black-btn" @click="onSaveClick">
                    <p>Save</p>
                </button>
                <button class="nav-button white-btn" @click="onCancelClick">
                    <p>Cancel</p>
                </button>
            </div>
        </nav>
    </header>
    <div class="page-content">
        <div class="form-section">
            <div class="error-messages" v-if="invalidFormWasSubmitted">
                <p>Please, submit required data</p>
            </div>
            <form id="product_form">
                <div class="options-container stable-options">
                    <label>SKU</label><br>
                    <input v-model="productForm.sku" type="text" id="sku" name="sku" required><br>
                    <div class="hint-messages" v-if="!isSkuValid">
                        <p>SKU must be between eight and 12 characters long</p>
                    </div>
                    <label>NAME</label><br>
                    <input v-model="productForm.name" type="text" id="name" name="name" required><br>
                    <div class="hint-messages" v-if="!isNameValid">
                        <p>Name must be between 1 and 100 characters long</p>
                    </div>
                    <label>PRICE($)</label><br>
                    <input v-model.number="productForm.price" type="number" id="price" name="price" required><br>
                    <div class="hint-messages" v-if="!isPriceValid">
                        <p>Price must be greater or equal 0 and be a number</p>
                    </div>
                </div>

                <div class="options-container changing-options">
                    <label>Type Switcher:</label>
                    <select name="type" id="productType" v-model="productForm.type">
                        <option value="dvd">DVD</option>
                        <option value="furniture">Furniture</option>
                        <option value="book">Book</option>
                    </select>
                    <div id="dvd-options" v-if="productForm.type==='dvd'">
                        <p>Please, provide size:</p>
                        <label>SIZE(MP)</label><br>
                        <input v-model="productForm.size" type="number" id="size" name="size"><br>
                    <div class="hint-messages" v-if="!isSizeValid">
                        <p>Size must be greater or equal 0 and be a number</p>
                    </div>
                    </div>
                    <div id="furniture-options" v-if="productForm.type==='furniture'">
                        <p>Please, provide dimensions:</p>
                        <label>Height (CM)</label><br>
                        <input v-model="productForm.height" type="number" id="height" name="height"><br>
                        <label>Width (CM)</label><br>
                        <input v-model="productForm.width" type="number" id="width" name="width"><br>
                        <label>Length (CM)</label><br>
                        <input v-model="productForm.length" type="number" id="length" name="length"><br>
                        <div class="hint-messages" v-if="!isDimensionsValid">
                            <p>Dimensions must be greater or equal 0 and be a number</p>
                        </div>
                    </div>
                    <div id="book-options" v-if="productForm.type==='book'">
                        <p>Please, provide weight:</p>
                        <label>Weight(KG)</label><br>
                        <input v-model="productForm.weight" type="number" id="weight" name="weight"><br>
                        <div class="hint-messages" v-if="!isWeightValid">
                            <p>Weight must be greater or equal 0 and be a number</p>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

</template>
<style scoped>
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
    .hint-messages{
        color:blue;
    }
    .error-messages{
        color:red;
    }
    #product_form{
        display: flex;
        gap: 40px;
    }

</style>
