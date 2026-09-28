@extends('layouts.dashboard.app')
@section('content')
<div class='main-content-inner'>
    <div class='main-content-wrap'>
        <div class='flex items-center flex-wrap justify-between gap20 mb-27'>
            <h3>Employees</h3>
            <ul class='breadcrumbs flex items-center flex-wrap justify-start gap10'>
                <li><a href='{{ route('dashboard') }}'><div class='text-tiny'>Dashboard</div></a></li>
                <li><i class='icon-chevron-right'></i></li>
                <li><div class='text-tiny'>Employees</div></li>
            </ul>
        </div>

        <div class='wg-box'>
            <div class='flex items-center justify-between gap10 flex-wrap'>
                <div class='wg-filter flex-grow'>
                    <form class='form-search' method='GET' action='{{ route('emps.index') }}'>
                        <fieldset class='name'>
                            <input type='text' placeholder='Search by name or employee no...' name='search' value='{{ $search }}'>
                        </fieldset>
                        <div class='button-submit'>
                            <button type='submit'><i class='icon-search'></i></button>
                        </div>
                    </form>
                </div>
                <a class='tf-button style-1 w208' href='{{ route('emps.create') }}'><i class='icon-plus'></i>Add new</a>
            </div>

            <div class='wg-table table-all-user'>
                <div class='table-responsive'>
                    @if (session('success')) <p class='alert alert-success'>{{ session('success') }}</p> @endif
                    @if (session('error'))   <p class='alert alert-danger'>{{ session('error') }}</p> @endif

                    <table class='table table-striped table-bordered'>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Emp No</th>
                                <th>User name</th>
                                <th>Emp name</th>
                                <th class='text-center'>Unit</th>
                                <th class='text-center'>Dept</th>
                                <th class='text-center'>Admin</th>
                                <th>Roles</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($emps as $emp)
                                <tr>
                                    <td>{{ $emps->firstItem() + $loop->index }}</td>
                                    <td>{{ $emp->EMP_NO }}</td>
                                    <td>{{ $emp->USER_NAME }}</td>
                                    <td>{{ $emp->EMP_NAME }}</td>
                                    <td class='text-center'>{{ $emp->EMP_STATUS }}</td>
                                    <td class='text-center'>{{ $emp->DEPT_CODE }}</td>
                                    <td class='text-center'>{{ (int) $emp->ADMIN === 1 ? 'Yes' : '' }}</td>
                                    <td>
                                        @foreach ($emp->roles as $role)
                                            <span class='badge bg-success'>{{ $role->name }}</span>
                                        @endforeach
                                    </td>
                                    <td>
                                        <div class='list-icon-function'>
                                            <a href='{{ route('emps.edit', $emp->EMP_NO) }}' class='item edit'><i class='icon-edit-3'></i></a>
                                            <form action='{{ route('emps.destroy', $emp->EMP_NO) }}' method='POST'
                                                  onsubmit="return confirm('Delete this employee from the EMP table?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type='submit' class='item text-danger' style='background:none;border:none;padding:0;'>
                                                    <i class='icon-trash-2'></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan='9' class='text-center'>No employees found.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class='divider'>{{ $emps->links('pagination::bootstrap-5') }}</div>
            </div>
        </div>
    </div>
</div>
@endsection
