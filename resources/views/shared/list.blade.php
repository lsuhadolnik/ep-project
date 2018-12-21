<div style="margin-top:20px">
    <div class="container-fluid list-item-product">
        <div class="row">
            <div class="col-2">
                <img src=" {{ asset('svg/no-image.png') }}" alt="slika izdelka" class="rounded list-img"  />
            </div>
            <div class="col-3 ">
                <div class="list-name">
                    <h3> {{ $product->name }} </h3>
                </div>
                <div class="list-details">
                    <div class="list-producer">
                        <p> {{ $product->producer }}</p>
                    </div>
                    
                </div>
            </div>
            @if( $product->rating->num_ratings > 0)
                <div class="col-2 list-rating">
                    @include('shared.stars')
                    <div class="list-rating-count">
                        <p> {{$product->rating->num_ratings}} ocen</p>
                    </div> 
                </div>
            @else
                <div class="col-2"></div>
            @endif
            <div class="col-2">
                <div class="list-price">
                    <h3>{{ $product->price }} $</h3>
                </div>

                
            </div>
            <div class="col-2">
                <div class="list-quantity">
                    <h6>Količina</h6>
                </div>
                
                <input type="text" class="list-quantity-number" name="quantity" value="0">
                
            </div>
            <div class=col-1>
                <a class="icon-button" href="plus">
                    <i class="fas fa-plus-circle fa-3x add-delete-icon" ></i>
                </a>
            </div>    
        </div>
    </div>
</div>