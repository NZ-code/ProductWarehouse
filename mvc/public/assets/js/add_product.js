const productTypeSwitcher = document.getElementById("product-type");
const productForm = document.getElementById("product-form");

const saveButton = document.getElementById("save-button");
saveButton.addEventListener('click', handleSave);
const cancelButton = document.getElementById("cancel-button");
cancelButton.addEventListener('click', handleCancel);

const skuInput = document.getElementById("sku");
const nameInput = document.getElementById("name");
const priceInput = document.getElementById("price");

const sizeInput = document.getElementById("size");
const heightInput = document.getElementById("height");
const widthInput = document.getElementById("width");
const lengthInput = document.getElementById("length");
const weightInput = document.getElementById("weight");


const productTypeToOptionsDivId = {
    "dvd":"dvd-options",
    "furniture":"furniture-options",
    "book":"book-options"
}
handleChangeProductType();



function handleSave(){
    productForm.submit();
}
function handleCancel(){
    history.back();
}
productTypeSwitcher.onchange = (event) =>{
    handleChangeProductType();
}
function handleChangeProductType(){
    clearAllOptionsDiv();
    let productType = productTypeSwitcher.value;
    let optionsDivId = productTypeToOptionsDivId[productType];
    showElementWithId(optionsDivId);
}
function clearAllOptionsDiv(){
    for(var key in productTypeToOptionsDivId){
        let optionsDivId = productTypeToOptionsDivId[key];
        let optionsDiv =  document.getElementById(optionsDivId);
        optionsDiv.style.display="none";
    }
}
function showElementWithId(id){
    let element =  document.getElementById(id);
    element.style.display="block";
}