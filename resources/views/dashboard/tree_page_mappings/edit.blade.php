@extends('layouts.dashboard.app')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-1">Edit Tree Page Mapping</h1>

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.tree-page-mappings.index') }}">
                            Tree Page Mappings
                        </a>
                    </li>
                    <li class="breadcrumb-item active">
                        Edit
                    </li>
                </ol>
            </nav>
        </div>

        <a href="{{ route('admin.tree-page-mappings.index') }}"
           class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i>
            Back
        </a>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="wg-box">

        <h5 class="mb-1">Edit Mapping</h5>

        <p class="text-muted mb-4">
            Change the page connected to this tree node.
        </p>

        <form action="{{ route('admin.tree-page-mappings.update', ['tree_page_mapping' => $mapping->id]) }}"
              method="POST">

            @csrf
            @method('PUT')

            <div class="row">

                {{-- Tree Node --}}
                <div class="col-md-6 mb-4">

                    <label class="form-label">
                        Tree Node <span class="text-danger">*</span>
                    </label>

                    <select name="tree_value"
                            class="form-select @error('tree_value') is-invalid @enderror">

                        @foreach($nodes as $node)

                            <option value="{{ $node->value }}"
                                {{ old('tree_value', $mapping->tree_value) == $node->value ? 'selected' : '' }}>

                                {{ $node->value }} - {{ $node->label }}

                            </option>

                        @endforeach

                    </select>

                    @error('tree_value')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

                {{-- Page --}}
                <div class="col-md-6 mb-4">

                    <label class="form-label">
                        Page <span class="text-danger">*</span>
                    </label>

                    <select name="page_id"
                            class="form-select @error('page_id') is-invalid @enderror">

                        @foreach($pages as $page)

                            <option value="{{ $page->id }}"
                                {{ old('page_id', $mapping->page_id) == $page->id ? 'selected' : '' }}>

                                {{ $page->name }} - {{ $page->slug }}

                            </option>

                        @endforeach

                    </select>

                    @error('page_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

            </div>

            <div class="d-flex justify-content-end gap-2 pt-3 border-top">

                <a href="{{ route('admin.tree-page-mappings.index') }}"
                   class="btn btn-light">
                    Cancel
                </a>

                <button type="submit"
                        class="btn btn-primary">
                    <i class="bi bi-check-lg"></i>
                    Update Mapping
                </button>

            </div>

        </form>

    </div>

</div>

@endsection