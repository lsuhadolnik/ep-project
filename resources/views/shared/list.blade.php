<div style="margin-top:20px">
    <div class="container-fluid list-item-product">
        <div class="row">
            <div class="col-2">
                <img src=" {{ asset('svg/test-image.png') }}" alt="slika izdelka" class="rounded list-img"  />
            </div>
            <div class="col-4 ">
                <div class="list-name">
                    <h3>Super izdelek 3.0</h3>
                </div>
                <div class="list-details">
                    <div class="list-producer">
                        <p>Proizvajalec</p>
                    </div>
                    <div class="list-order-count">
                        <p>160 nakupov</p>
                    </div> 
                </div>
            </div>
            <div class="col-2 offset-1">
                <div class="list-price">
                    <h3>24.56$</h3>
                </div>

                @include('shared.stars')
            </div>
            <div class="col-2">
                <div class="list-quantity">
                    <h6>Količina</h6>
                </div>
                <div class="list-quantity-number rounded">
                    <p>1</p>
                </div>
            </div>
            <div class=col-1>
                <a class="icon-button" href="plus">
                    <i class="fas fa-plus-circle fa-3x add-delete-icon" ></i>
                </a>
            </div>    
        </div>
    </div>
</div>