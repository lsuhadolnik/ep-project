var addToCart = document.getElementsByClassName('add-to-cart');

var submitQuantityButton = function(ev) {
    event.preventDefault(); 
    var val = document.getElementById("quantity"+ev.target.id).value;
    if(!isPositiveInteger(val)) {
        console.log("ni pozitivno število");
        var errorMessage = document.getElementById('errors-message');
        errorMessage.innerHTML = 'Vnesite celo pozitivno število';
        errorMessage.style.display = "block";

    } else {
        val = parseInt(val);
        document.getElementById("quantity"+ev.target.id).value = val+1;
        document.getElementById('cart-form'+ev.target.id).submit();
    }
    
}

for (var i=0; i<addToCart.length; i++) {
    addToCart[i].addEventListener("click", submitQuantityButton);
}




var inputQuantity = document.getElementsByClassName('list-quantity-number');

var submitQuantityNumber = function(ev){
    if(ev.which == 13){
        event.preventDefault();
        var val = document.getElementById(ev.target.id).value;
        if(!isPositiveInteger(val)) {
            console.log("ni pozitivno število");
            var errorMessage = document.getElementById('errors-message');
            errorMessage.innerHTML = 'Vnesite celo pozitivno število';
            errorMessage.style.display = "block";
        } else {
            document.getElementById('cart-form'+ev.target.id.match(/\d+/)[0]).submit();
        }
        
    }
}

for(var i=0; i<inputQuantity.length; i++) {
    inputQuantity[i].addEventListener('keypress', submitQuantityNumber);
}


function isPositiveInteger(n) {
    return n >>> 0 === parseFloat(n);
}