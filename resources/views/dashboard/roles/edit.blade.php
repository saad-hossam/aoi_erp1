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
                        <div class='text-tiny'>Edit role</div>
                    </li>
                </ul>
            </div>
            <!-- new-category -->
            <div class="wg-box">
                <form method="POST" action="{{ isset($role) ? route('roles.update', $role->id) : route('roles.store') }}">
                    @csrf
                    @if (isset($role))
                        @method('PUT')
                    @endif

                    <fieldset class="name">
                        <label>Name</label>
                        <input type="text" name="name" value="{{ old('name', $role->name ?? '') }}" required>
                        @error('name')
                            <span class="alert alert-danger">{{ $message }}</span>
                        @enderror
                    </fieldset>


                    <fieldset class="name mt-3 pt-5">
                        <div class="body-title mb-10">Permissions</div>
                        <div class="flex gap-2 flex-wrap">
                            @foreach ($permissions as $permission)
                                <label class="flex items-center gap-1 px-5">
                                    <input type="checkbox" name="permissions[]" value="{{ $permission->id }}"
                                        {{ isset($role) && $role->permissions->contains($permission->id) ? 'checked' : '' }}>
                                    {{ $permission->name }}
                                </label>
                            @endforeach
                        </div>
                    </fieldset>

                    <div class='bot'>
                        <div></div>
                        <button class='tf-button w208' type='submit'>Edit Role</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
