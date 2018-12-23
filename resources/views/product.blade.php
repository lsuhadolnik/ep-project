@extends('layouts.app')

@section('content')
<div class="container product">
    <div class="row justify-content-center">
        <div class="col-lg-12">

            <h3>Artikel</h3>
            <br>
            <div>
                <div class="carousel-stars">
                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                            <img class="d-block w-100" src=" {{ asset('svg/test-image.png') }}" alt="First slide">
                            </div>
                            <div class="carousel-item">
                            <img class="d-block w-100" src=" {{ asset('svg/test-image.png') }}" alt="Second slide">
                            </div>
                            <div class="carousel-item">
                            <img class="d-block w-100" src=" {{ asset('svg/test-image.png') }}" alt="Third slide">
                            </div>
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                    <br>
                    <div class="stars" data-toggle="modal" data-target="#exampleModal">
                        @include('shared.stars')
                    </div>
                </div>
                <div class="product-info">
                    <h5>{{ $product->name }}</h5>
                    <p><strong>Proizvajalec: </strong>{{ $product->producer->name }}</p>
                    <p><strong>Opis: </strong>{{ $product->description }} </p>
                    <h5><strong>Cena: </strong> {{ $product->price }} $</h5>
                </div>
            </div>
        </div>
    </div>
    <br>
    @auth
    <div class="row justify-content-end">
        <form id="cart-form{{$product->id}}" action="{{ route('cart') }}" method="POST" >
            {{ csrf_field() }}
            <input type="text" name="product_id" value="{{ $product->id }}" hidden>
            <div class="col-lg-12">
            <div class="quantity right">
                <label for="quantity">Količina:</label>
                <input type="text" name="quantity" class="product-quantity-number" value=" {{ $quantity }} " id="quantity{{$product->id}}">
            </div>
            <br><br>
            <button class="btn btn-primary right quantity-button" id="{{$product->id}}">Dodaj v košarico</button>
        </form>
    </div>
    @endauth
</div>

@auth
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ocenjevanje izdelka</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color:var(--my-middle-blue);">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="/product/{{$product->id}}/rating" method="POST" id="rate-form">
        {{ csrf_field() }}
        <div class="modal-body rating-modal" >
            Izberite oceno:
            
                <select name="rating" class="rating-input">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
            
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Zapri</button>
            <button type="button" class="btn btn-primary" type="submit" onclick="document.getElementById('rate-form').submit();">Shrani oceno</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endauth
@endsection