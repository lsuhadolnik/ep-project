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
            <form class="add-product" method="POST" action="/management/addProduct" id="add-form">
                <input name="_token" value="{{ csrf_token() }}" type="hidden" id="token">
                <table class="add-product-table">
                    <tr>
                        <th><label for="name">Ime</label></th>
                        <td><input type="text" name="name" id="name"></td>
                    </tr>
                    
                    <tr>
                        <th><label for="price">Cena</label></th>
                        <td><input type="text" name="price" id="price"></td>
                    </tr>

                    <tr>
                        <th><label for="producer">Proizvajalec</label></th>
                        <td>
                            <select class="js-example-basic-single" name="producer" id="producer">
                                @foreach($producers as $producer)
                                    <option value="{{$producer->name}}">{{$producer->name}}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>

                    
                    <tr>
                        <th><label for="description">Opis</label></th>
                        <td><textarea type="text" rows="7" name="description" id="description"></textarea></td>
                    </tr>
                    
                </table>
                
                <div class="dropzone" id="addDropzone"></div>
                <br>
                <button type="submit" class="btn btn-primary" id="submit-form">Dodaj</button>
            </form>
            <!-- <form action="/file-upload"
                class="dropzone"
                id="my-awesome-dropzone"></form> -->
        </div>
    </div>
</div>
@endsection