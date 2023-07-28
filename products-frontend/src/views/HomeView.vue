<script>
import ProductsComponent from '../components/ProductsComponent.vue';

export default{
    components: {
      ProductsComponent,
    },
    methods: {
      onAddClick() {
        this.$router.push('/addproduct')
      },
      onMassDeleteClick() {
        this.$refs.productsComponentRef.handleMassDelete();
      }
    }
  }

</script>

<template>
    <header>
        <nav class="header-content">
            <p class="header-title">Product List:</p>
            <div class="buttons-section">
                <button class="nav-button black-btn" id="add-product-btn" @click="onAddClick">ADD</button>
                <button class="nav-button white-btn" id="delete-product-btn" @click="onMassDeleteClick">MASS DELETE</button>
            </div>
        </nav>
    </header>
  <main>
    <div class="page-content">        
        <div class="products-section">
            <ProductsComponent ref="productsComponentRef"></ProductsComponent>
        </div>
        
    </div>
  </main>
</template>
<style scoped>
    .products-section{
      margin-top: 60px;
      margin-bottom: 130px;
      margin-left: 140px;
      margin-right: 140px;
      display: grid;
      grid-template-columns: repeat(4,1fr);
      grid-gap: 50px; 
    }
</style>