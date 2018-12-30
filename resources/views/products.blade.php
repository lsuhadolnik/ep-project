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
                        <th></th>
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
                        @if($product->status == "active")
                            <td> Da </td>
                        @else 
                            <td> Ne </td>
                        @endif
                        <form action="/secure/product/{{$product->id}}/changeStatus" method="POST">
                            @csrf
                            @if( $product->status == "active")
                                <td><button class="btn btn-primary btn-sm">Deaktiviraj</button></td>
                            @else
                                <td><button class="btn btn-primary btn-sm">Aktiviraj</button></td>
                            @endif
                        </form>
                        <td><a href="/secure/updateProduct/{{$product->id}}" class="link">Uredi</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection