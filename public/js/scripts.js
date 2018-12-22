var addToCart = document.getElementById('add-to-cart');
addToCart.addEventListener("click", function() {
    event.preventDefault(); 
    var val = parseInt(document.getElementById('list-quantity-number').value)+1;
    document.getElementById('list-quantity-number').value = val;
    console.log(val);
    document.getElementById('cart-form').submit();
});

var inputQuantity = document.getElementById('list-quantity-number');
inputQuantity.addEventListener('keypress', function(e){
    if(e.which == 13){
        document.getElementById('cart-form').submit();
    }
});