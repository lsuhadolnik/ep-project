@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12">

            <h3>Hvala za naročilo!</h3>
            <br>
            @include('shared.order-table')
            <h5> Naročilo številka {{$order->id}}, oddano {{\Carbon\Carbon::parse($order->submitted_at)->format('d. m. Y')}} </h5>
            <h5> Stanje: {{$order->status}} </h5>
            <br>
            <button class="btn btn-primary" onclick="location.href='{{ URL::previous() }}';"> Nazaj na pregled naročil</button>
            <button class="btn btn-primary"> Preglej in izpolni </button>
            <button class="btn btn-primary"> Storno </button>
        </div>
    </div>
</div>
@endsection