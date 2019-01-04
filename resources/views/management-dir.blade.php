@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12">

            <h3>Upravljanje prodajalne</h3>
            <br>
            <a href="/secure/orders/active" class="management">
                <div class="alert alert-primary">Upravljanje z naročili</div>
            </a>
            <a href="/secure/products" class="management">
                <div class="alert alert-primary">Upravljanje z izdelki</div>
            </a>

            <a href="/secure/addProduct" class="management">
                <div class="alert alert-primary">Dodajanje novega izdelka</div>
            </a>
            <a href="/secure/users" class="management">
                <div class="alert alert-primary">Upravljanje z uporabniki</div>
            </a>
            <a href="/secure/user" class="management">
                <div class="alert alert-primary">Ustvari novega uporabnika</div>
            </a>
            @if(Auth::user()->role_id == 1)
            <a href="/secure/logs" class="management">
                <div class="alert alert-primary">Dnevnik uporabnikov</div>
            </a>
            @endif
        </div>
    </div>
</div>
@endsection