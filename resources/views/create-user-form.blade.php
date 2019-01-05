@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12">

            <h3>Ustvarjanje uporabnika</h3>
            @if ($errors->any())
                <div class="alert alert-danger" role="alert">
                    {{ $errors->first()}}
                </div>
            @endif
            <form class="user-profile" method="post" action="/secure/user">
                
                {{ csrf_field() }}
                <table>
                    <tr class="{{ $errors->has('name') ? ' has-error' : '' }}" > 
                        <th><label for="name" style="width:200px">Ime</label></th>
                        <td><input type="text" name="name" ></td>
                    </tr>

                    
                    <tr >
                        <th><label for="email">Email</label></th>
                        <td><input type="text" name="email"></td>
                    </tr>

                    <tr class="{{ $errors->has('password') ? ' has-error' : '' }}" >
                        <th><label for="password" style="width:200px">Geslo</label></th>
                        <td><input type="password" name="password"></td>
                    </tr>
                    @if(Auth::user()->role_id == 1)
                    <tr>
                        <th><label for="role">Izberite vlogo:</label></th>
                        <td>
                            <select class="" name="role">
                                <option value="Prodajalec" >Prodajalec</option>
                                <option value="Stranka" selected>Stranka</option>
                            </select>
                        </td>
                    </tr>
                    @endif
                </table>
                <br>
                <button type="submit" class="btn btn-primary">Ustvari</button>
            </form>
            
            
        </div>
    </div>
</div>
@endsection