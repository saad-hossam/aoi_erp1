@extends('layouts.dashboard.app')
@section('content')
<div class='main-content-inner'>
    <div class='main-content-wrap'>
        <div class='flex items-center flex-wrap justify-between gap20 mb-27'>
            <h3>New Employee</h3>
            <ul class='breadcrumbs flex items-center flex-wrap justify-start gap10'>
                <li><a href='{{ route('dashboard') }}'><div class='text-tiny'>Dashboard</div></a></li>
                <li><i class='icon-chevron-right'></i></li>
                <li><a href='{{ route('emps.index') }}'><div class='text-tiny'>Employees</div></a></li>
                <li><i class='icon-chevron-right'></i></li>
                <li><div class='text-tiny'>New</div></li>
            </ul>
        </div>
        <div class='wg-box'>
            <form action='{{ route('emps.store') }}' method='POST' class='form-new-product form-style-1'>
                @csrf
                @include('dashboard.emps._form', ['submit' => 'Create Employee'])
            </form>
        </div>
    </div>
</div>
@endsection
