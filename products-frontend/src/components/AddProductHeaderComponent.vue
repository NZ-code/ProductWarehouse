<script>
    export default{
        data(){
            
        },
        methods: {
            onSaveClick() {
                this.$router.push('/');
            },
            onCancelClick() {
                this.$router.push('/');
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
</template>
<style>
    
</style>