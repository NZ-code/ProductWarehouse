const deleteButton = document.getElementById("delete-product-btn");
deleteButton.addEventListener('click', handleMassDelete);


function handleMassDelete(){
    const productsIds = [];
    const productContainers = document.getElementsByClassName('product-container');
    for (let i = 0; i < productContainers.length; i++) {
        const productContainer = productContainers[i];
        if(isDeleteChecked(productContainer)){
            const productId = getProductId(productContainer);
            productsIds.push(productId);
        }
    }
    sendDeleteRequest(productsIds);
}
function isDeleteChecked(productContainer){
    return productContainer.getElementsByClassName('delete-checkbox')[0].checked;
}
function getProductId(productContainer){
    return productContainer.getElementsByClassName('product-id-input')[0].value;
}
function sendDeleteRequest(productsIds){
    const data = {
        "productsIds":productsIds 
    };
    $phpUrl = 'index.php';
    fetch($phpUrl, {
        method: 'DELETE',
        headers: {
            'Content-Type':'application/json',
        },
        body: JSON.stringify(data)
    })
    .then(function(response) {
        if (!response.ok) {
          throw new Error('Delete request failed');
        }
      })
      .then(function(data) {
        console.log('Delete request was successful');
        console.log(data);
        location.reload()
      })
      .catch(function(error) {
        console.error(error);
      });

}