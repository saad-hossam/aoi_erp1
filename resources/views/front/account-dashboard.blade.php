@extends('layouts.front.app')
@section('content')
<ul class='account-nav'>
    {{-- <li><a href='{{route('user.account.dashboard')}}' class='menu-link menu-link_us-s {{Route::is('user.account.dashboard') ? 'menu-link_active':''}}'>Dashboard</a></li>
    <li><a href='{{route('user.account.orders')}}' class='menu-link menu-link_us-s {{Route::is('user.account.orders') ? 'menu-link_active':''}}'>Orders</a></li>
    <li><a href='{{route('user.account.addresses')}}' class='menu-link menu-link_us-s {{Route::is('user.account.addresses') ? 'menu-link_active':''}}'>Addresses</a></li>
    <li><a href='{{route('user.account.details')}}' class='menu-link menu-link_us-s {{Route::is('user.account.details') ? 'menu-link_active':''}}'>Account Details</a></li>
    <li><a href='{{route('user.account.wishlists')}}' class='menu-link menu-link_us-s {{Route::is('user.account.wishlists') ? 'menu-link_active':''}}'>Wishlist</a></li> --}}
    <li>
       <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>

<a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
    Logout
</a>

    </li>
</ul>
@endsection
