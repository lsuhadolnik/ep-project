var addToCart = document.getElementById('add-to-cart');
addToCart.addEventListener("click", function() {
    event.preventDefault(); 
    var val = document.getElementById('list-quantity-number').value;
    if(!isPositiveInteger(val)) {
        console.log("ni pozitivno število");
        var errorMessage = document.getElementById('errors-message');
        errorMessage.innerHTML = 'Vnesite celo pozitivno število';
        errorMessage.style.display = "block";

    } else {
        val = parseInt(val);
        document.getElementById('list-quantity-number').value = val+1;
        console.log(val);
        document.getElementById('cart-form').submit();
    }
    
});

var inputQuantity = document.getElementById('list-quantity-number');
inputQuantity.addEventListener('keypress', function(e){
    if(e.which == 13){
        var val = document.getElementById('list-quantity-number').value;
        if(!isPositiveInteger(val)) {
            console.log("ni pozitivno število");
            var errorMessage = document.getElementById('errors-message');
            errorMessage.innerHTML = 'Vnesite celo pozitivno število';
            errorMessage.style.display = "block";
        } else {
            document.getElementById('cart-form').submit();
        }
        
    }
});

var jeStevilo = function(vrednost) {
    return !isNaN(parseFloat(vrednost)) && isFinite(vrednost);
  };

function isPositiveInteger(n) {
    return n >>> 0 === parseFloat(n);
}