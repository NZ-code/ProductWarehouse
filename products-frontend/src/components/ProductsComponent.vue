<script>
    import axios from 'axios';
    import { API_URL } from '../utils/constants';
    import { deleteProductsByIds, getProducts } from '../services/ProductService';
    export default{
        data(){
            return {
                products:[]
            }
        },
        mounted(){
            this.fetchProducts();
        }
        ,
        methods: {
            getProductToDelete(){
                const productsToDelete = this.products.filter(product => product.toDelete);
                return productsToDelete;
            },
            onProductClick(product) {
                product.toDelete = !product.toDelete;
            },
            fetchProducts(){
                getProducts()
                .then(
                    response =>{
                        this.products = response.data;
                    }
                )
                .catch(error =>{
                    console.error('Error fetching products:', error);
                });
            },
            handleMassDelete(){
                const productsIds = this.getProductToDelete().map(product => product.id);
                deleteProductsByIds(productsIds)
                .then(
                    ()=>{
                        this.fetchProducts()
                    }
                )
                .catch(error =>{
                    console.error('Error fetching products:', error);
                });
            },
        }
    }
</script>
<template>
    <div class="product-container" v-for="product in products" @click="onProductClick(product)" >
        <input type="checkbox" class="delete-checkbox" v-model="product.toDelete">
        <input type="hidden" class="product-id-input" :value="product.id">
        <div class="product-properties">
            <div id="product-name"><p>{{ product.name }}</p></div>
            <div id="product-sku"><p>{{ product.sku }}</p></div>
            <div id = "product-price"><p>{{ product.price }} $</p></div>
            <div class="specific-properties">
                <div v-if="product.type =='furniture'">
                    Dimesions:{{product.properties['height']}}x{{product.properties['width']}}x{{product.properties['length']}}
                </div>
                <div v-else class="property-container" v-for="propertyName in Object.keys(product.properties)">
                    {{ propertyName }} : {{ product.properties[propertyName] }}
                </div>
            </div>
        </div>

    </div>
</template>
<style scoped>
  
    .product-container{
        border-radius: 12px;
        border: 3px solid #EDEDED;
        width: 250px;
        min-height: 200px;
        padding: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .product-properties{
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }
    #product-name{
        font-size: 20px;
        font-weight: 600;
    }
    #product-sku{
        opacity: 0.4000000059604645;
    }
    #product-price{
        font-size: 36px;
        font-weight: 700;
    }
</style>
