@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12">

            <h3>Posodabljanje artikla</h3>
            <br>
            @if ($errors->any())
                <div class="alert alert-danger" role="alert">
                    {{ $errors->first()}}
                </div>
            @endif
            <form class="add-product" method="POST" action="/management/updateProduct/{{$product->id}}" id="update-form"> 
                <input name="_token" value="{{ csrf_token() }}" type="hidden" id="token" >
                <table class="add-product-table">
                    <tr>
                        <th><label for="name">Ime</label></th>
                        <td><input type="text" name="name" id="name" value="{{$product->name}}"></td>
                    </tr>
                    
                    <tr>
                        <th><label for="price">Cena</label></th>
                        <td><input type="text" name="price" id="price" value="{{$product->price}}"></td>
                    </tr>

                    <tr>
                        <th><label for="producer">Proizvajalec</label></th>
                        <td>
                            <select class="js-example-basic-single" name="producer" id="producer">
                                @foreach($producers as $producer)
                                    @if($producer == $product->producer->first()->name)
                                        <option value="{{$producer->name}}" selected>{{$producer->name}}</option>
                                    @else
                                        <option value="{{$producer->name}}">{{$producer->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </td>
                    </tr>

                    
                    <tr>
                        <th><label for="description">Opis</label></th>
                        <td><textarea type="text" rows="7" name="description" id="description">{{$product->description}}</textarea></td>
                    </tr>
                    
                </table>
                
                <div class="dropzone" id="updateDropzone"></div>
                <br>
                <button type="submit" class="btn btn-primary" id="submit-form">Posodobi</button>
            </form>
            <div class="update-product-images">
                @foreach($product->images as $image)
                    <form id="delete-form{{$image->id}}" action="/management/deleteProductImage/{{$product->id}}/{{$image->id}}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <div>
                            <img src="{{$image->path}}" class="update-image" id="$image->id">
                            <i class="fas fa-times delete-image-icon" onclick="document.getElementById('delete-form{{$image->id}}').submit();"></i>
                        </div>
                    </form>
                    <br>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection