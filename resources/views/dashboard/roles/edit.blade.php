@extends('layouts.dashboard.app')
@section('content')
<div class='main-content-inner'>
    <div class='main-content-wrap'>
        <div class='flex items-center flex-wrap justify-between gap20 mb-27'>
            <h3>Edit role</h3>
            <ul class='breadcrumbs flex items-center flex-wrap justify-start gap10'>
                <li><a href='{{ route('dashboard') }}'><div class='text-tiny'>Dashboard</div></a></li>
                <li><i class='icon-chevron-right'></i></li>
                <li><a href='{{ route('roles.index') }}'><div class='text-tiny'>Roles</div></a></li>
                <li><i class='icon-chevron-right'></i></li>
                <li><div class='text-tiny'>Edit role</div></li>
            </ul>
        </div>
        <div class='wg-box'>
            <form method='POST' action="{{ route('roles.update', $role->id) }}" class='form-new-product form-style-1'>
                @csrf
                @method('PUT')
                @include('dashboard.roles._form', ['submit' => 'Update Role'])
            </form>
        </div>
    </div>
</div>
@endsection
