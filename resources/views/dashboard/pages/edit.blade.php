@extends('layouts.dashboard.app')

@section('content')

<div class="container-fluid">

    {{-- Page Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-1">Edit Page</h1>

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.pages.index') }}">Pages</a>
                    </li>
                    <li class="breadcrumb-item active">
                        Edit
                    </li>
                </ol>
            </nav>
        </div>

        <a href="{{ route('admin.pages.index') }}"
           class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i>
            Back
        </a>
    </div>

    {{-- Validation Errors --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Please fix the following errors:</strong>

            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Edit Form --}}
    <div class="wg-box">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h5 class="mb-1">Edit Page</h5>
                <p class="text-muted mb-0">
                    Update page information
                </p>
            </div>

            <span class="badge bg-light text-dark">
                ID: {{ $page->id }}
            </span>
        </div>

        <form action="{{ route('admin.pages.update', ['page' => $page->id]) }}"
              method="POST">

            @csrf
            @method('PUT')

            <div class="row">

                {{-- Page Name --}}
                <div class="col-md-6 mb-4">
                    <label class="form-label">
                        Page Name <span class="text-danger">*</span>
                    </label>

                    <input type="text"
                           name="name"
                           class="form-control @error('name') is-invalid @enderror"
                           value="{{ old('name', $page->name) }}"
                           placeholder="Enter page name">

                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- Slug --}}
                <div class="col-md-6 mb-4">
                    <label class="form-label">
                        Slug <span class="text-danger">*</span>
                    </label>

                    <input type="text"
                           name="slug"
                           class="form-control @error('slug') is-invalid @enderror"
                           value="{{ old('slug', $page->slug) }}"
                           placeholder="production-orders">

                    @error('slug')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- Page Type --}}
                <div class="col-md-6 mb-4">
                    <label class="form-label">
                        Page Type <span class="text-danger">*</span>
                    </label>

                    <select name="type"
                            class="form-select @error('type') is-invalid @enderror">

                        <option value="application"
                            {{ old('type', $page->type) === 'application' ? 'selected' : '' }}>
                            Application
                        </option>

                        <option value="report"
                            {{ old('type', $page->type) === 'report' ? 'selected' : '' }}>
                            Report
                        </option>

                        <option value="form"
                            {{ old('type', $page->type) === 'form' ? 'selected' : '' }}>
                            Form
                        </option>

                        <option value="external"
                            {{ old('type', $page->type) === 'external' ? 'selected' : '' }}>
                            External
                        </option>

                    </select>

                    @error('type')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- Status --}}
                <div class="col-md-6 mb-4">
                    <label class="form-label">
                        Status <span class="text-danger">*</span>
                    </label>

                    <select name="status"
                            class="form-select @error('status') is-invalid @enderror">

                        <option value="active"
                            {{ old('status', $page->status) === 'active' ? 'selected' : '' }}>
                            Active
                        </option>

                        <option value="inactive"
                            {{ old('status', $page->status) === 'inactive' ? 'selected' : '' }}>
                            Inactive
                        </option>

                    </select>

                    @error('status')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- Component --}}
                <div class="col-md-6 mb-4">
                    <label class="form-label">
                        Component
                    </label>

                    <input type="text"
                           name="component"
                           class="form-control @error('component') is-invalid @enderror"
                           value="{{ old('component', $page->component) }}"
                           placeholder="dashboard.pages.production_orders">

                    @error('component')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- Controller --}}
                <div class="col-md-6 mb-4">
                    <label class="form-label">
                        Controller
                    </label>

                    <input type="text"
                           name="controller"
                           class="form-control @error('controller') is-invalid @enderror"
                           value="{{ old('controller', $page->controller) }}"
                           placeholder="App\Http\Controllers\...">

                    @error('controller')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- Route Name --}}
                <div class="col-md-6 mb-4">
                    <label class="form-label">
                        Route Name <span class="text-danger">*</span>
                    </label>

                    <input type="text"
                           name="route_name"
                           class="form-control @error('route_name') is-invalid @enderror"
                           value="{{ old('route_name', $page->route_name) }}"
                           placeholder="admin.production-orders">

                    @error('route_name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- Route Path --}}
                <div class="col-md-6 mb-4">
                    <label class="form-label">
                        Route Path <span class="text-danger">*</span>
                    </label>

                    <input type="text"
                           name="route_path"
                           class="form-control @error('route_path') is-invalid @enderror"
                           value="{{ old('route_path', $page->route_path) }}"
                           placeholder="production-orders">

                    @error('route_path')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

            </div>

            {{-- Actions --}}
            <div class="d-flex justify-content-end gap-2 pt-3 border-top">

                <a href="{{ route('admin.pages.index') }}"
                   class="btn btn-light">
                    Cancel
                </a>

                <button type="submit"
                        class="btn btn-primary">
                    <i class="bi bi-check-lg"></i>
                    Update Page
                </button>

            </div>

        </form>

    </div>

</div>

@endsection