<div style="margin-top:20px">
    <div class="container-fluid list-item-product">
            <div class="row">
                

                <a href="{{ route('showproduct', ['id' => $product->id]) }}" class="product-link col-9">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-3">
                                <img src=" {{ asset('svg/no-image.png') }}" alt="slika izdelka" class="rounded list-img"  />
                            </div>
                            <div class="col-4 ">
                                <div class="list-name">
                                    <h3> {{ $product->name }} </h3>
                                </div>
                                <div class="list-details">
                                    <div class="list-producer">
                                        <p> {{ $product->producer->name }}</p>
                                    </div>
                                    
                                </div>
                            </div>
                            @if( $product->rating->num_ratings > 0)
                                <div class="col-3 list-rating">
                                    @include('shared.stars')
                                    <div class="list-rating-count">
                                        <p> {{$product->rating->num_ratings}} ocen</p>
                                    </div> 
                                </div>
                            @else
                                <div class="col-3"></div>
                            @endif
                            <div class="col-2">
                                <div class="list-price">
                                    <h3>{{ $product->price }} $</h3>
                                </div>

                                
                            </div>
                        </div>
                    </div>
                </a>
                @guest
                    <div class="col-3"></div>
                @else
                    @if(Route::currentRouteName() == 'showcart')
                        <div class="col-3">
                            <form id="cart-form{{$product->id}}" action="{{ route('cart') }}" method="POST" >
                                {{ csrf_field() }}
                                
                                <input type="text" name="product_id" value="{{ $product->id }}" hidden>
                                <div style="width:60%; float:left">
                                    <div class="list-quantity">
                                        <h6>Količina</h6>
                                    </div>
                                    
                                    <input type="text" class="list-quantity-number" id="quantity{{$product->id}}" name="quantity" value=" {{  $product->quantity  }}">
                                </div>    
                                
                                <div style="width:40%; float:left;">
                                    <a class="icon-button add-to-cart" href="{{ route('cart') }}" >
                                        <i class="fas fa-plus fa-3x add-icon " id="{{$product->id}}"></i>
                                    </a>
                                </div>
                                
                            </form> 
                            <form action="/cart/{{ $product->id }}" method="POST" id="delete-form{{$product->id}}">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <i class="far fa-times-circle fa-2x delete-icon" onclick="document.getElementById('delete-form{{$product->id}}').submit();"></i>
                            </form>
                        </div>

                    @endif
                @endguest 
                   
            </div>

    </div>
</div>