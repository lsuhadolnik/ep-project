@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12">

            <h3>Upravljanje prodajalne</h3>
            <br>
            <a href="/management/orders/active" class="management">
                <div class="alert alert-primary">Upravljanje z naročili</div>
            </a>
            <a href="/management/products" class="management">
                <div class="alert alert-primary">Upravljanje z izdelki</div>
            </a>

            <a href="/management/addProduct" class="management">
                <div class="alert alert-primary">Dodajanje novega izdelka</div>
            </a>
        </div>
    </div>
</div>
@endsection