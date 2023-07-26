<script>
    export default{
        data(){
            return {
                products: [
                    {id: 0, sku: 'JVC2001123', name: 'Table', price:34.5, toDelete:false},
                    {id: 1, sku: 'JVC2001123', name: 'Table', price:34.5, toDelete:false},
                    {id: 2, sku: 'JVC2001123', name: 'Table', price:34.5, toDelete:false},
                    {id: 3, sku: 'JVC2001123', name: 'Table', price:34.5, toDelete:false},
                    {id: 4, sku: 'JVC2001123', name: 'Table', price:34.5, toDelete:false},
                ]
            }
        },
        methods: {
            onProductClick(product) {
                product.toDelete = !product.toDelete;
            }
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
            <div id = "product-price"><p>{{ product.price }}</p></div>  
        </div>
    </div>
</template>
<style scoped>
  
    .product-container{
        border-radius: 12px;
        border: 3px solid #EDEDED;
        width: 250px;
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
