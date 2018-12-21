@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="title">
                <h4> Najbolje prodajano </h4>
            </div>
            <div class="container-fluid">
                <div class="row justify-content-around">
                    @foreach ($topProducts as $product)
                        <div class="bestseller ">
                            <div>
                                <img src=" {{ asset('svg/no-image.png') }}" alt="slika izdelka" class="rounded">
                            </div>
                            <p>{{$product->name}}
                                <br>
                                {{$product->price}}$
                            </p>
                        </div>
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