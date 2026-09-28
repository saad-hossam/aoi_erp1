@extends('layouts.dashboard.app')

@section('content')

<style>
    .page-id {
        width: 70px;
    }

    .page-name {
        width: 180px;
    }

    .page-slug {
        width: 160px;
    }

    .page-route {
        width: 180px;
    }

    .page-type {
        width: 120px;
    }

    .page-status {
        width: 100px;
    }

    .page-actions {
        width: 220px;
        white-space: nowrap;
    }
</style>

<div class="main-content-inner">
    <div class="main-content-wrap">

        {{-- Page Header --}}
        <div class="flex items-center flex-wrap justify-between gap20 mb-27">

            <h3>Pages</h3>

            <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">

                <li>
                    <a href="{{ route('admin.index') }}">
                        <div class="text-tiny">Dashboard</div>
                    </a>
                </li>

                <li>
                    <i class="icon-chevron-right"></i>
                </li>

                <li>
                    <div class="text-tiny">Pages</div>
                </li>

            </ul>

        </div>

        {{-- Main Box --}}
        <div class="wg-box">

            {{-- Search + Add --}}
            <div class="flex items-center justify-between gap10 flex-wrap">

                <div class="wg-filter flex-grow">

                    <form
                        class="form-search"
                        method="GET"
                        action="{{ route('admin.pages.index') }}"
                    >

                        <fieldset class="name">
                            <input
                                type="text"
                                placeholder="Search here..."
                                name="search"
                                tabindex="2"
                                value="{{ request('search') }}"
                            >
                        </fieldset>

                        <div class="button-submit">
                            <button type="submit">
                                <i class="icon-search"></i>
                            </button>
                        </div>

                    </form>

                </div>

                <a
                    class="tf-button style-1 w208"
                    href="{{ route('admin.pages.create') }}"
                >
                    <i class="icon-plus"></i>
                    Add New Page
                </a>

            </div>

            {{-- Success Message --}}
            @if(session('success'))
                <p class="alert alert-success">
                    {{ session('success') }}
                </p>
            @endif

            @if(session('status'))
                <p class="alert alert-success">
                    {{ session('status') }}
                </p>
            @endif

            {{-- Error Message --}}
            @if(session('error'))
                <p class="alert alert-danger">
                    {{ session('error') }}
                </p>
            @endif

            {{-- Validation Errors --}}
            @if($errors->any())

                <div class="alert alert-danger">

                    <ul class="mb-0">

                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach

                    </ul>

                </div>

            @endif

            {{-- Table --}}
            <div class="wg-table table-all-user">

                <div class="table-responsive">

                    <table class="table table-striped table-bordered">

                        <thead>

                            <tr>

                                <th class="page-id">
                                    ID
                                </th>

                                <th class="page-name">
                                    NAME
                                </th>

                                <th class="page-slug">
                                    SLUG
                                </th>

                                <th class="page-type">
                                    TYPE
                                </th>

                                <th class="page-route">
                                    ROUTE
                                </th>

                                <th class="page-status">
                                    STATUS
                                </th>

                                <th class="page-actions">
                                    ACTIONS
                                </th>

                            </tr>

                        </thead>

                        <tbody>

                            @forelse($pages as $page)

                                <tr>

                                    {{-- ID --}}
                                    <td>
                                        {{ $page->id }}
                                    </td>

                                    {{-- NAME --}}
                                    <td>
                                        {{ $page->name }}
                                    </td>

                                    {{-- SLUG --}}
                                    <td>
                                        {{ $page->slug }}
                                    </td>

                                    {{-- TYPE --}}
                                    <td>
                                        {{ $page->type }}
                                    </td>

                                    {{-- ROUTE --}}
                                    <td>
                                        {{ $page->route_name }}
                                    </td>

                                    {{-- STATUS --}}
                                    <td>

                                        @if($page->status === 'active')

                                            <span class="badge bg-success">
                                                Active
                                            </span>

                                        @else

                                            <span class="badge bg-secondary">
                                                Inactive
                                            </span>

                                        @endif

                                    </td>

                                    {{-- ACTIONS --}}
                                    <td>

                                        {{-- View --}}
                                        <a
                                            href="{{ route('admin.pages.show', ['page' => $page->id]) }}"
                                            class="btn btn-sm btn-info"
                                        >
                                            View
                                        </a>

                                        {{-- Edit --}}
                                        <a
                                            href="{{ route('admin.pages.edit', ['page' => $page->id]) }}"
                                            class="tf-button style-1"
                                        >
                                            Edit
                                        </a>

                                        {{-- Delete --}}
                                        <form
                                            action="{{ route('admin.pages.destroy', ['page' => $page->id]) }}"
                                            method="POST"
                                            class="d-inline"
                                            onsubmit="return confirm('Are you sure you want to delete this page?')"
                                        >

                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="btn btn-sm btn-danger"
                                            >
                                                Delete
                                            </button>

                                        </form>

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td
                                        colspan="7"
                                        class="text-center"
                                    >
                                        No pages found.
                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

                {{-- Pagination --}}
                @if(method_exists($pages, 'links'))

                    <div class="divider">
                        {{ $pages->links('pagination::bootstrap-5') }}
                    </div>

                @endif

            </div>

        </div>

    </div>
</div>

@endsection