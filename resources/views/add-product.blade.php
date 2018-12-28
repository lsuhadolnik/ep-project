@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12">

            <h3>Dodajanje artikla</h3>
            <br>
            @if ($errors->any())
                <div class="alert alert-danger" role="alert">
                    {{ $errors->first()}}
                </div>
            @endif
            <form class="add-product" method="POST" action="/management/addProduct">
                @csrf
                <table class="add-product-table">
                    <tr>
                        <th><label for="name">Ime</label></th>
                        <td><input type="text" name="name"></td>
                    </tr>
                    
                    <tr>
                        <th><label for="price">Cena</label></th>
                        <td><input type="text" name="price"></td>
                    </tr>

                    <tr>
                        <th><label for="producer">Proizvajalec</label></th>
                        <td>
                            <select class="js-example-basic-single" name="producer">
                                @foreach($producers as $producer)
                                    <option value="{{$producer->name}}">{{$producer->name}}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>

                    
                    <tr>
                        <th><label for="description">Opis</label></th>
                        <td><textarea type="text" rows="7" name="description"></textarea></td>
                    </tr>
                    
                </table>
                <br>
                <button type="submit" class="btn btn-primary">Dodaj</button>
            </form>
        </div>
    </div>
</div>
@endsection