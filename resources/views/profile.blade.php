@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12">

            <h3>Profil</h3>
            <form class="user-profile" method="post" action="">
                <table>
                    <tr>
                        <th><label for="name">Ime</label><th>
                        <td><input type="text" name="name"><td>
                    </tr>
                    
                    <tr>
                        <th><label for="surname">Priimek</label><th>
                        <td><input type="text" name="surname"><td>
                    </tr>
                    
                    <tr>
                        <th><label for="email">Email</label><th>
                        <td><input type="text" name="email" disabled><td>
                    </tr>

                     <tr>
                        <th><label for="phone">Telefon</label><th>
                        <td><input type="text" name="phone"><td>
                    </tr>
                    
                    <tr>
                        <th><label for="address">Naslov</label><th>
                        <td><input type="text" name="address" ><td>
                    </tr>
                    
                </table>
                <br>
                <button type="submit" class="btn btn-primary">Shrani</button>
            </form>
            <form class="user-password" method="post" action="">
                <table>
                    <tr>
                        <th><label for="oldpassword">Staro geslo</label><th>
                        <td><input type="text" name="oldpassword"><td>
                    </tr>
                    
                    <tr>
                        <th><label for="password1">Novo geslo</label><th>
                        <td><input type="text" name="password1"><td>
                    </tr>
                    
                    <tr>
                        <th><label for="password2">Ponovi novo geslo</label><th>
                        <td><input type="text" name="password2" ><td>
                    </tr>

                    
                </table>
                <br>
                <button type="submit" class="btn btn-primary">Posodobi geslo</button>
            </form>
        </div>
    </div>
</div>
@endsection