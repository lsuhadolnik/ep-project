@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12">

            <h3>Hvala za naročilo!</h3>
            <br>
            @include('shared.order-table')
            <h5> Naročilo številka 1584, oddano 15.4.2018 </h5>
            <h5> Stanje: oddano, čaka ne pregled </h5>
            <br>
            <button class="btn btn-primary"> Preglej in izpolni </button>
            <button class="btn btn-primary"> Storno </button>
        </div>
    </div>
</div>
@endsection