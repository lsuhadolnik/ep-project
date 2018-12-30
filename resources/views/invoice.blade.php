@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12">


            <h3>Predračun</h3>
            <br>
            @include('shared.order-table')
            <br>
            <div class="contrainer-fluid">
                <div class="row">
                    <div style="margin:5px;">
                        <button class="btn btn-primary" onclick="location.href='{{ URL::previous() }}';"> Nazaj na košarico</button>
                    </div>

                    <div style="margin:5px;">
                        <form action="/order/{{$order->id}}" method="POST">
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-primary right" >Oddaj naročilo</button>
                        </form>
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection