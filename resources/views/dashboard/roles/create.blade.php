@extends('layouts.dashboard.app')
@section('content')
    <div class='main-content-inner'>
        <!-- main-content-wrap -->
        <div class='main-content-wrap'>
            <div class='flex items-center flex-wrap justify-between gap20 mb-27'>
                <h3>Role infomation</h3>
                <ul class='breadcrumbs flex items-center flex-wrap justify-start gap10'>
                    <li>
                        <a href='{{ route('admin.index') }}'>
                            <div class='text-tiny'>Dashboard</div>
                        </a>
                    </li>
                    <li>
                        <i class='icon-chevron-right'></i>
                    </li>
                    <li>
                        <a href='{{ route('roles.index') }}'>
                            <div class='text-tiny'>roles</div>
                        </a>
                    </li>
                    <li>
                        <i class='icon-chevron-right'></i>
                    </li>
                    <li>
                        <div class='text-tiny'>New role</div>
                    </li>
                </ul>
            </div>
            <!-- new-category -->
            <div class="wg-box">


                <form method="POST" action="{{ isset($role) ? route('roles.update', $role->id) : route('roles.store') }}"
                    class='form-new-product form-style-1'>
                    @csrf
                    @if (isset($role))
                        @method('PUT')
                    @endif
                    <fieldset class='name'>
                        <div class='body-title'>Name <span class='tf-color-1'>*</span></div>
                        <input class='flex-grow' type='text' placeholder='Enter Name' name='name' tabindex='0'
                            value='{{ old('name') }}' aria-required='true'>
                    </fieldset>
                    @error('name')
                        <span class='alert alert-danger text-center'>{{ $message }}</span>
                    @enderror

                    <fieldset class='Permissions'>
                        <div class='body-title'>Assign Permissions <span class='tf-color-1'>*</span></div>
                        <div class="flex gap-2 flex-wrap">
                            @foreach ($permissions as $permission)
                                <div class='body-title px-5'>
                                    <input type="checkbox" name="permissions[]" value="{{ $permission->id }}"
                                        {{ isset($role) && $role->permissions->contains($permission->id) ? 'checked' : '' }}>
                                    {{ $permission->name }}
                                </div>
                            @endforeach
                        </div>
                    </fieldset>

                    <div class='bot'>
                        <div></div>
                        <button class='tf-button w208' type='submit'>Save Role</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
