@extends('layouts.front.app')

@section('content')
<main class='pt-90'>
    <div class='mb-4 pb-4'></div>
    <section class='login-register container'>
        <ul class='nav nav-tabs mb-5' id='login_register' role='tablist'>
            <li class='nav-item' role='presentation'>
                <a class='nav-link nav-link_underscore active' id='login-tab' data-bs-toggle='tab' href='#tab-item-login' role='tab' aria-controls='tab-item-login' aria-selected='true'>Login</a>
            </li>
        </ul>
        <div class='tab-content pt-2' id='login_register_tab_content'>
            <div class='tab-pane fade show active' id='tab-item-login' role='tabpanel' aria-labelledby='login-tab'>
                <div class='login-form'>
                    <form method='POST' action='{{ route('login') }}' name='login-form' class='needs-validation' novalidate>
                        @csrf

                        {{-- First dropdown (replaces email/username input) --}}
                     <div class='form-floating mb-3'>
    <select class='form-select form-control_gray @error('email') is-invalid @enderror' name='email' id='email' required>
        <option value='' disabled {{ old('email') ? '' : 'selected' }}>Select Unit *</option>
        @foreach ($units as $unit)
            <option value='{{ $unit->unit_code }}' {{ old('email') == $unit->unit_code ? 'selected' : '' }}>
                {{ $unit->unit_name }}
            </option>
        @endforeach
    </select>
    <label for='email'>Unit *</label>
    @error('email')
        <span class='invalid-feedback' role='alert'>
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>

                        {{-- Second dropdown (new) --}}
                        <div class='form-floating mb-3'>
                            <select class='form-select form-control_gray @error('branch') is-invalid @enderror' name='branch' id='branch' required>
                                <option value='' disabled {{ old('branch') ? '' : 'selected' }}>Select branch *</option>
                                <option value='branch_a' {{ old('branch') == 'branch_a' ? 'selected' : '' }}>Branch A</option>
                                <option value='branch_b' {{ old('branch') == 'branch_b' ? 'selected' : '' }}>Branch B</option>
                                <option value='branch_c' {{ old('branch') == 'branch_c' ? 'selected' : '' }}>Branch C</option>
                            </select>
                            <label for='branch'>Branch *</label>
                            @error('branch')
                                <span class='invalid-feedback' role='alert'>
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class='pb-3'></div>
                        <div class='form-floating mb-3'>
                            <input id='password' type='password' class='form-control form-control_gray @error('password') is-invalid @enderror' name='password' required autocomplete='current-password' >
                            <label for='customerPasswodInput'>Password *</label>
                            @error('password')
                                <span class='invalid-feedback' role='alert'>
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <button class='btn btn-primary w-100 text-uppercase' type='submit'>Log In</button>
                        
                    </form>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection