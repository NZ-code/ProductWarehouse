<script>
import ProductsComponent from '../components/ProductsComponent.vue';
import FooterComponent from '../components/FooterComponent.vue';

export default{
    components: {
      ProductsComponent,
      FooterComponent
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
      <ProductsComponent ref="productsComponentRef"></ProductsComponent>
    </div>
  </main>
  <FooterComponent></FooterComponent>
</template>
<style scoped>
  
</style>