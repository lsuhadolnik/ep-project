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
                        <th>Aktiven</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td> {{ $user->id }} </td>
                            <td> {{ $user->name }} </td>
                            <td> {{ $user->surname }}</td>
                            <td> {{ $user->email }}</td>
                            <td> {{ $user->role->name }} </td>
                            @if( $user->status == "active")
                                <td> Da </td>
                            @else
                                <td> Ne </td>
                            @endif
                            <form action="/management/user/{{$user->id}}/changeStatus" method="POST">
                                @csrf
                                @if( $user->status == "active")
                                    <td><button class="btn btn-primary btn-sm">Deaktiviraj</button></td>
                                @else
                                    <td><button class="btn btn-primary btn-sm">Aktiviraj</button></td>
                                @endif
                            </form>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection