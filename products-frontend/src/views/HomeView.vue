<script setup>
import ProductComponent from '../components/ProductComponent.vue';
import HomeHeaderComponent from '../components/HomeHeaderComponent.vue';
</script>

<template>
  <HomeHeaderComponent></HomeHeaderComponent>
  <main>
    <div class="page-content">        
        <div class="products-section">
            <ProductComponent></ProductComponent>
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