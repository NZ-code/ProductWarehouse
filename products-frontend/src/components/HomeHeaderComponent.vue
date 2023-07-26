
<script>
    export default{
        data(){
            
        },
        methods: {
            onAddClick() {
                this.$router.push('/addproduct')
            },
            onMassDeleteClick() {
                
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
</template>
<style>
</style>
