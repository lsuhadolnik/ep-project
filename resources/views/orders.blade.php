@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12">

            <h3 class="orders-title">Naročila</h3>
            <div class=" dropdown">
                <button id="orderDropdown" class="btn btn-secondary dropdown-toggle right" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    Izberi tip naročil <span class="caret"></span>
                </button>

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="orderDrowdown">
                    <!-- <a class="dropdown-item" href="/orders">
                        {{ __('Vsa') }}
                    </a> -->
                    <a class="dropdown-item" href="{{ preg_match( '#^secure/#', Request::path() ) ? '/secure/orders/active' : '/orders/active' }}">
                        {{ __('V obdelavi') }}
                    </a>
                    <a class="dropdown-item" href="{{ preg_match( '#^secure/#', Request::path() ) ? '/secure/orders/fulfilled' : '/orders/fulfilled' }}">
                        {{ __('Potrjena') }}
                    </a>
                    <a class="dropdown-item" href="{{ preg_match( '#^secure/#', Request::path() ) ? '/secure/orders/cancelled' : '/orders/cancelled' }}">
                        {{ __('Stornirana') }}
                    </a>
                    <!-- <form id="all" action="/orders" method="POST" style="display: none;">
                        @csrf
                    </form> -->
                    <form id="cart-navbar" action="{{ preg_match( '#^secure/#', Request::path() ) ? '/secure/orders/active' : '/orders/active' }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    <form id="cart-navbar" action="{{ preg_match( '#^secure/#', Request::path() ) ? '/secure/orders/fulfilled' : '/orders/fulfilled' }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    <form id="profile-navbar" action="{{ preg_match( '#^secure/#', Request::path() ) ? '/secure/orders/cancelled' : '/orders/cancelled' }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    
                </div>

            </div>
            <br><br><br>
            @include('shared.orders-table')

        </div>
    </div>
</div>
@endsection