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
            <br>
            
            
            @if (!isset($empty))
                <div class="container-fluid" >
                    <div class="row justify-content-end">
                        <div style="margin:5px;">
                            <form action="/invoice" method="POST">
                                {{ csrf_field() }}
                                <button type="submit" class="btn btn-primary right" >Ogled predračuna</button>
                            </form>
                        </div>
                        <div style="margin:5px;">
                            <form action="/order/{{$id}}" method="POST">
                                {{ csrf_field() }}
                                <button type="submit" class="btn btn-primary right" >Oddaj naročilo</button>
                            </form>
                        </div>
                        
                    </div>
                </div>    
            @endif
        </div>
    </div>
</div>
@endsection