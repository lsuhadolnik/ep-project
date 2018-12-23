@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="title">
                <h4> Najbolje ocenjeno </h4>
            </div>
            <div class="container-fluid">
                <div class="row justify-content-around">
                    @foreach ($topProducts as $product)
                    <a href="{{ route('showproduct', ['id' => $product->id]) }}" class="product-link">
                        <div class="bestseller ">
                            <div>
                                <img src=" {{ ($product->images->first() !== null) ? $product->images->first()->path : asset('svg/no-image.png') }}" alt="slika izdelka" class="rounded">
                            </div>
                            <p style="padding-bottom:10px;">{{$product->name}}
                                <br>
                                {{$product->price}}$
                            </p>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
            @foreach ($products as $product)
                <div class="">
                    @include('shared.list')
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection