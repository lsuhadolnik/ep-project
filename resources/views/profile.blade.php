@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12">

            <h3>Profil</h3>
            @if ($errors->any())
                <div class="alert alert-danger" role="alert">
                    {{ $errors->first()}}
                </div>
            @endif
            <form class="user-profile" method="post" action="{{ preg_match( '#^secure/#', Request::path() ) ? '/secure/user/'.$user->id : '/profile' }}">
                
                {{ csrf_field() }}
                <table>
                    <tr class="{{ $errors->has('name') ? ' has-error' : '' }}" > 
                        <th><label for="name" style="width:200px">Ime</label></th>
                        <td><input type="text" name="name" value="{{ $user->name}}"></td>
                    </tr>
                    <tr class="{{ $errors->has('surname') ? ' has-error' : '' }}">
                        <th><label for="surname">Priimek</label></th>
                        <td><input type="text" name="surname" value="{{$user->surname}}"></td>
                    </tr>
                    
                    <tr >
                        <th><label for="email">Email</label></th>
                        <td><input type="text" name="email" value="{{$user->email}}" disabled></td>
                    </tr>

                    <tr class="{{ $errors->has('phone') ? ' has-error' : '' }}" >   
                        <th><label for="phone" style="width:200px">Telefon</label></th>
                        <td><input type="text" name="phone" value="{{ $user->phone}}"></td>
                    </tr>
                    
                    <tr class="{{ $errors->has('address') ? ' has-error' : '' }}">
                        <th><label for="address">Naslov (ulica in hišna številka)</label></th>
                        <td><input type="text" name="address" value="{{$user->address}}"></td>
                    </tr>
                    <tr class="{{ $errors->has('postal') ? ' has-error' : '' }}" >
                        <th><label for="postal" style="width:200px">Poštna številka</label></th>
                        <td><input type="text" name="postal" value="{{  $user->postal_code}}"></td>
                    </tr>
                    
                </table>
                <br>
                <button type="submit" class="btn btn-primary">Shrani</button>
            </form>
            @if(Auth::user() == $user)
            <form class="user-password" method="POST" action="/resetPassword">
                @if( (session()->get( 'message' )) !== null )
                    <div class="alert alert-success" role="alert" style="margin-right:50px">
                        {{ session()->get( 'message' )}}
                    </div>
                @endif
                {{ csrf_field() }}
                <table>
                    <!-- <tr>
                        <th><label for="oldpassword">Staro geslo</label><th>
                        <td><input type="text" name="oldpassword"><td>
                    </tr> -->
                    
                    <tr>
                        <th><label for="password1">Novo geslo</label><th>
                        <td><input type="password" name="password1"><td>
                    </tr>
                    
                    <tr>
                        <th><label for="password2">Ponovi novo geslo</label><th>
                        <td><input type="password" name="password2" ><td>
                    </tr>

                    
                </table>
                <br>
                <button type="submit" class="btn btn-primary">Posodobi geslo</button>
            </form>
            @endif
            @if(Auth::user()->role_id == 1 and preg_match( '#^secure/#', Request::path() ))
            <form class="user-password" method="POST" action="/secure/changeRole/{{$user->id}}">
                @if( (session()->get( 'message' )) !== null )
                    <div class="alert alert-success" role="alert" style="margin-right:50px">
                        {{ session()->get( 'message' )}}
                    </div>
                @endif
                {{ csrf_field() }}
                <table>
                    
                    <tr>
                        <th><label for="role">Izberite vlogo:</label><th>
                        <td>
                            <select class="role-change" name="role">
                                @if($user->role_id == 2)
                                    <option value="Prodajalec" selected>Prodajalec</option>
                                    <option value="Stranka">Stranka</option>
                                @else if($user->role_id == 3)
                                    <option value="Prodajalec" >Prodajalec</option>
                                    <option value="Stranka" selected>Stranka</option>
                                @endif
                            </select>
                        <td>
                    </tr>

                    
                </table>
                <br>
                <button type="submit" class="btn btn-primary">Spremeni vlogo</button>
            </form>
            @endif
        </div>
    </div>
</div>
@endsection