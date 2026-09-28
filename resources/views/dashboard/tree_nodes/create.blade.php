@extends('layouts.dashboard.app')
@section('content')
    <div class="main-content-inner">
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                <h3>Add User</h3>
                <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                    <li>
                        <a href="{{ route('admin.index') }}">
                            <div class="text-tiny">Dashboard</div>
                        </a>
                    </li>
                    <li><i class="icon-chevron-right"></i></li>
                    <li>
                        <div class="text-tiny">Add User</div>
                    </li>
                </ul>
            </div>

            <div class="wg-box">
                <form action="{{ route('users.store') }}" method="POST" class='form-new-product form-style-1'>
                    @csrf
                    <fieldset class='name'>
                        <div class='body-title'>Name <span class='tf-color-1'>*</span></div>
                        <input class='flex-grow' type='text' placeholder='Enter Name' name='name' tabindex='0'
                            value='{{ old('name') }}' aria-required='true'>
                    </fieldset>
                    @error('name')
                        <span class='alert alert-danger text-center'>{{ $message }}</span>
                    @enderror

                    <fieldset class='email'>
                        <div class='body-title'>Email <span class='tf-color-1'>*</span></div>
                        <input class='flex-grow' type='email' placeholder='Enter email' name='email' tabindex='0'
                            value='{{ old('email') }}' aria-required='true'>
                    </fieldset>
                    @error('email')
                        <span class='alert alert-danger text-center'>{{ $message }}</span>
                    @enderror

                    <fieldset class='password'>
                        <div class='body-title'>Password <span class='tf-color-1'>*</span></div>
                        <input class='flex-grow' type='password' placeholder='Enter password' name='password' tabindex='0'
                            value='{{ old('password') }}' aria-required='true'>
                    </fieldset>
                    @error('password')
                        <span class='alert alert-danger text-center'>{{ $message }}</span>
                    @enderror

                    <fieldset class='password'>
                        <div class='body-title'>Confirm Password <span class='tf-color-1'>*</span></div>
                        <input class='flex-grow' type='password' placeholder='Enter password' name='password_confirmation'
                            tabindex='0' value='{{ old('password') }}' aria-required='true'>
                    </fieldset>
                    @error('password')
                        <span class='alert alert-danger text-center'>{{ $message }}</span>
                    @enderror


                    <fieldset class='Role'>
                        <div class='body-title'>Assign Roles <span class='tf-color-1'>*</span></div>
                        <div class="d-flex flex-wrap gap-3">
                            @foreach ($roles as $role)
                                <div class='body-title'>
                                    <input type="checkbox" name="roles[]" value="{{ $role->id }}">
                                    {{ $role->name }}
                                </div>
                            @endforeach
                        </div>
                    </fieldset>
                        @error('roles')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror

                    <div class='bot'>
                    <div></div>
                    <button class='tf-button w208' type='submit'>Save User</button>
                </div>
                </form>
            </div>
        </div>
    </div>
@endsection
