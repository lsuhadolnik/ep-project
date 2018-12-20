@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12">

            <h3 class="cart-title">Košarica</h3>
            <h5 class="cart-total">Skupaj: 30.00$</h5>
            <br><br>
            @include('shared.list')
            @include('shared.list')
            <br><br>
            <button class="btn btn-primary right">Oddaj naročilo</button>
        </div>
    </div>
</div>
@endsection