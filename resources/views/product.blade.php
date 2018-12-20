@extends('layouts.app')

@section('content')
<div class="container product">
    <div class="row justify-content-center">
        <div class="col-lg-12">

            <h3>Artikelj</h3>
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
                    <h5>Ime artikla</h5>
                    <p><strong>Proizvajalec: </strong>Ime proizvajalca</p>
                    <p><strong>Opis: </strong>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                    <h5><strong>Cena: </strong>58.00$</h5>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="row justify-content-end">
        <div class="col-lg-12">
        <div class="quantity right">
            <label for="quantity">Količina:</label>
            <input type="text" name="quantity" class="product-quantity-number" value="0">
        </div>
        <br><br>
        <button class="btn btn-primary right">Dodaj v košarico</button>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ocenjevanje izdelka</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        @include('shared.stars')
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Zapri</button>
        <button type="button" class="btn btn-primary">Shrani oceno</button>
      </div>
    </div>
  </div>
</div>
@endsection