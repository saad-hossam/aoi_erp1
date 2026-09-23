@extends('layouts.dashboard.app')
@section('content')
<style>
    .table-striped th:nth-child(1), .table-striped td:nth-child(1) { width: 50px; }
    .table-striped th:nth-child(2), .table-striped td:nth-child(2) { width: 300px; }
</style>



<div class="main-content-inner">
    <div class="main-content-wrap">
        <div class="flex items-center justify-between gap20 mb-27">
            <h3>Permissions</h3>
            <a class="tf-button style-1 w208" href="{{ route('permissions.create') }}">
                <i class="icon-plus"></i> Add new
            </a>
        </div>

        <div class="wg-box">
            <div class="table-responsive">
                @if(session('success'))
                    <p class="alert alert-success">{{ session('success') }}</p>
                @endif
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($permissions as $permission)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $permission->name }}</td>
                            <td>
                                <a href="{{ route('permissions.edit', $permission->id) }}" class="item edit"><i class="icon-edit-3"></i></a>
                                <form action="{{ route('permissions.destroy', $permission->id) }}" method="POST" style="display:inline" onsubmit="return confirm('Are you sure?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="item text-danger" style="border:none; background:none; padding:0;"><i class="icon-trash-2"></i></button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-center">No permissions found</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="divider">{{ $permissions->links('pagination::bootstrap-5') }}</div>
        </div>
    </div>
</div>
@endsection
