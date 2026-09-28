@extends('layouts.dashboard.app')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h1 class="h3 mb-1">Mapping Details</h1>

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.tree-page-mappings.index') }}">
                            Tree Page Mappings
                        </a>
                    </li>
                    <li class="breadcrumb-item active">
                        Details
                    </li>
                </ol>
            </nav>
        </div>

        <div class="d-flex gap-2">

            <a href="{{ route('admin.tree-page-mappings.edit', ['tree_page_mapping' => $mapping->id]) }}"
               class="btn btn-primary">
                Edit
            </a>

            <a href="{{ route('admin.tree-page-mappings.index') }}"
               class="btn btn-secondary">
                Back
            </a>

        </div>

    </div>

    <div class="wg-box">

        <h5 class="mb-4">
            Mapping Information
        </h5>

        <div class="row">

            <div class="col-md-6 mb-4">
                <label class="text-muted d-block">
                    Mapping ID
                </label>

                <strong>
                    {{ $mapping->id }}
                </strong>
            </div>

            <div class="col-md-6 mb-4">
                <label class="text-muted d-block">
                    Tree Value
                </label>

                <strong>
                    {{ $mapping->tree_value }}
                </strong>
            </div>

            <div class="col-md-6 mb-4">
                <label class="text-muted d-block">
                    Tree Node
                </label>

                <strong>
                    {{ $node?->label ?? 'N/A' }}
                </strong>

                @if($node?->label_eng)
                    <small class="text-muted d-block">
                        {{ $node->label_eng }}
                    </small>
                @endif
            </div>

            <div class="col-md-6 mb-4">
                <label class="text-muted d-block">
                    Page
                </label>

                <strong>
                    {{ $mapping->page?->name ?? 'N/A' }}
                </strong>
            </div>

            <div class="col-md-6 mb-4">
                <label class="text-muted d-block">
                    Page Slug
                </label>

                <code>
                    {{ $mapping->page?->slug ?? 'N/A' }}
                </code>
            </div>

            <div class="col-md-6 mb-4">
                <label class="text-muted d-block">
                    Route
                </label>

                <code>
                    {{ $mapping->page?->route_path ?? 'N/A' }}
                </code>
            </div>

        </div>

    </div>

</div>

@endsection