@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12">

            <h3>Produkti</h3>
            <br>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID artikla </th>
                        <th>Naziv</th>
                        <th>Proizvajalec</th>
                        <th>Cena</th>
                        <th>Aktiven</th>
                        <th>Več</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                    <tr>
                        <td> {{$product->id}} </td>
                        <td> {{$product->name}} </td>
                        <td> {{$product->producer->name}}</td>
                        <td> {{$product->price}} $ </td>
                        <td>  </td>
                        <td><a href="/management/updateProducts" class="link">Uredi</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection