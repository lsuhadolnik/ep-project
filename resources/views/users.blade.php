@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12">

            <h3>Uporabniki</h3>
            <br>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID uporabnika </th>
                        <th>Ime</th>
                        <th>Priimek</th>
                        <th>Email</th>
                        <th>Vloga</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td> 1548795 </td>
                        <td> Janez </td>
                        <td> Novak</td>
                        <td>neki@gmail.com</td>
                        <td> Uporabnik </td>
                        <td><button class="btn btn-primary btn-sm">Izbriši</button></td>
                    </tr>
                    <tr>
                        <td> 15487956 </td>
                        <td> Micka </td>
                        <td> Sosedova </td>
                        <td>micka@gmail.com</td>
                        <td> Prodajalec </td>
                        <td><button class="btn btn-primary btn-sm">Izbriši</button></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection