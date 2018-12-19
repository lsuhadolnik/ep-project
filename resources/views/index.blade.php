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
                    <div class="bestseller ">
                        <div>
                            <img src=" {{ asset('svg/test-image.png') }}" alt="slika izdelka" class="rounded">
                        </div>
                        <p>Ime izdelka
                            <br>
                            24.25$
                        </p>
                    </div>
                    <div class="bestseller ">
                        <div>
                            <img src=" {{ asset('svg/test-image.png') }}" alt="slika izdelka" class="rounded">
                        </div>
                        <p>Ime izdelka
                            <br>
                            24.25$
                        </p>
                    </div>
                    <div class="bestseller ">
                        <div>
                            <img src=" {{ asset('svg/test-image.png') }}" alt="slika izdelka" class="rounded">
                        </div>
                        <p>Ime izdelka
                            <br>
                            24.25$
                        </p>
                    </div>
                    <div class="bestseller ">
                        <div>
                            <img src=" {{ asset('svg/test-image.png') }}" alt="slika izdelka" class="rounded">
                        </div>
                        <p>Ime izdelka
                            <br>
                            24.25$
                        </p>
                    </div>
                    <div class="bestseller ">
                        <div>
                            <img src=" {{ asset('svg/test-image.png') }}" alt="slika izdelka" class="rounded">
                        </div>
                        <p>Ime izdelka
                            <br>
                            24.25$
                        </p>
                    </div>
                </div>
            </div>
            <div class="">
                @include('shared.list')
            </div>
            <div class="">
                @include('shared.list')
            </div>
        </div>
    </div>
</div>
@endsection