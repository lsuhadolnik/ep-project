@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12">

            <h3>Dnevnik uporabnikov</h3>
            <br>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID uporabnika </th>
                        <th>Ime</th>
                        <th>Vloga</th>
                        <th>Tip akcije</th>
                        <th>Čas</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($logs as $log)
                        <tr>
                            <td> {{ $log->user->id }} </td>
                            <td> {{ $log->user->name }} </td>
                            <td> {{ $log->user->role->name }}</td>
                            <td> {{ $log->type }}</td>
                            <td> {{ $log->created_at }} </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection