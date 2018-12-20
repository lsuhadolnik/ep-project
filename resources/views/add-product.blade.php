@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12">

            <h3>Dodajanje artikla</h3>
            <br>
            <form class="add-product" method="post" action="">
                <table class="add-product-table">
                    <tr>
                        <th><label for="name">Ime</label><th>
                        <td><input type="text" name="name"><td>
                    </tr>
                    
                    <tr>
                        <th><label for="producer">Proizvajalec</label><th>
                        <td><input type="text" name="producer"><td>
                    </tr>
                    
                    <tr>
                        <th><label for="description">Opis</label><th>
                        <td><textarea type="text" rows="7" name="description"></textarea><td>
                    </tr>
                    
                </table>
                <br>
                <button type="submit" class="btn btn-primary">Dodaj</button>
            </form>
        </div>
    </div>
</div>
@endsection