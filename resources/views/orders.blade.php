@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12">

            <h3 class="orders-title">Naročila</h3>
            <select class="form-control orders-select">
                <option>Pretekla</option>
                <option>V obdelavi</option>
                <option>Stornirana</option>
            </select>
            <br><br><br>
            @include('shared.orders-table')

        </div>
    </div>
</div>
@endsection