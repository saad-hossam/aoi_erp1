@extends('layouts.dashboard.app')
@section('content')
<style>
    .table-striped th:nth-child(1), .table-striped td:nth-child(1) { width: 50px; }
    .table-striped th:nth-child(2), .table-striped td:nth-child(2) { width: 300px; }
</style>


<div class='main-content-inner'>
    <div class='main-content-wrap'>
        <div class='flex items-center flex-wrap justify-between gap20 mb-27'>
            <h3>Roles</h3>
            <ul class='breadcrumbs flex items-center flex-wrap justify-start gap10'>
                <li><a href='{{ route('dashboard') }}'><div class='text-tiny'>Dashboard</div></a></li>
                <li><i class='icon-chevron-right'></i></li>
                <li><div class='text-tiny'>Roles</div></li>
            </ul>
        </div>

        <div class='wg-box'>
            <div class='flex items-center justify-between gap10 flex-wrap'>
                <div class='wg-filter flex-grow'>
                    <form class='form-search' method="GET" action="{{ route('roles.index') }}">
                        <fieldset class='name'>
                            <input type='text' placeholder='Search here...' name='name' value="{{ $search }}">
                        </fieldset>
                        <div class='button-submit'>
                            <button type='submit'><i class='icon-search'></i></button>
                        </div>
                    </form>
                </div>
                <a class='tf-button style-1 w208' href="{{ route('roles.create') }}">
                    <i class='icon-plus'></i> Add new
                </a>
            </div>

            <div class='table-responsive mt-3'>
                @if(session('success'))
                    <p class="alert alert-success">{{ session('success') }}</p>
                @endif
                <table class='table table-striped table-bordered'>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Permissions</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($roles as $role)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $role->name }}</td>
                            <td>
                                @foreach($role->permissions as $permission)
                                    <span class="badge bg-success">{{ $permission->name }}</span>
                                @endforeach
                            </td>
                            <td>
                                <div class='list-icon-function d-flex gap-2'>
                                    <a href="{{ route('roles.edit', $role->id) }}" class="item edit"><i class='icon-edit-3'></i></a>
                                    <form action="{{ route('roles.destroy', $role->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this role?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="item text-danger" style="border:none; background:none; padding:0;">
                                            <i class='icon-trash-2'></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center">No roles found</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class='divider'>
                {{ $roles->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>
@endsection
