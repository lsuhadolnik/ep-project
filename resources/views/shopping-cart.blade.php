@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12">

            <h3 class="cart-title">Košarica</h3>
            <h5 class="cart-total">Skupaj: {{$price}} $</h5>
            <br><br>
            @if (isset($empty))
                <h6>{{$empty}}</h6>
            @endif
            @foreach ($products as $product)
                @include('shared.list')
            @endforeach
            <br><br>
            @if (!isset($empty))
                <form action="/order/{{$id}}/active" method="POST">
                    {{ csrf_field() }}
                    <button type="submit" class="btn btn-primary right" >Oddaj naročilo</button>
                </form>
            @endif
        </div>
    </div>
</div>
@endsection