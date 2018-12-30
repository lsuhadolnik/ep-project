@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12">

            @if(preg_match( '#^secure/#', Request::path() ))
                <h3>Pregled naročila</h3>
            @else
                <h3>Hvala za naročilo!</h3>
            @endif
            <br>
            @include('shared.order-table')
            <h5> Naročilo številka {{$order->id}}, oddano {{\Carbon\Carbon::parse($order->submitted_at)->format('d. m. Y')}} </h5>
            <h5> Stanje: {{$order->opisniStatus}} </h5>
            <br>
            <div class="contrainer-fluid">
                <div class="row">
                    <div style="margin:5px;">
                        <button class="btn btn-primary" onclick="location.href='{{ URL::previous() }}';"> Nazaj na pregled naročil</button>
                    </div>
            @if(preg_match( '#^secure/#', Request::path() ))
                @if($order->status == "active")
                    <div style="margin:5px;">
                    <form action="/secure/order/{{$order->id}}/fulfilled" method="POST">
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-primary" >Preglej in izpolni</button>
                    </form>
                    </div>
                @endif
                @if($order->status == "fulfilled" or $order->status == "active")
                    <div style="margin:5px;">
                    <form action="/secure/order/{{$order->id}}/cancelled" method="POST">
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-primary" >Storno</button>
                    </form>
                    </div>
                @endif
               
            @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection