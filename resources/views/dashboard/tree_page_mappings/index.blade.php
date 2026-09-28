@extends('layouts.dashboard.app')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-1">Tree Page Mappings</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item active">Tree Page Mappings</li>
                </ol>
            </nav>
        </div>

        <a href="{{ route('admin.tree-page-mappings.create') }}"
           class="btn btn-primary">
            <i class="bi bi-plus-lg"></i>
            Add Mapping
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="wg-box">

        <div class="table-responsive">

            <table class="table table-hover align-middle">

                <thead>
                    <tr>
                        <th>#</th>
                        <th>Tree Value</th>
                        <th>Tree Node</th>
                        <th>Page</th>
                        <th>Route</th>
                        <th>Status</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>

                <tbody>

                @forelse($mappings as $mapping)

                    @php
                        $node = $nodes->first(
                            fn ($item) =>
                                (string) $item->value ===
                                (string) $mapping->tree_value
                        );
                    @endphp

                    <tr>

                        <td>
                            {{ $mapping->id }}
                        </td>

                        <td>
                            <strong>
                                {{ $mapping->tree_value }}
                            </strong>
                        </td>

                        <td>
                            @if($node)
                                <div>
                                    {{ $node->label }}
                                </div>

                                @if($node->label_eng)
                                    <small class="text-muted">
                                        {{ $node->label_eng }}
                                    </small>
                                @endif
                            @else
                                <span class="text-danger">
                                    Node not found
                                </span>
                            @endif
                        </td>

                        <td>
                            <strong>
                                {{ $mapping->page?->name }}
                            </strong>

                            <br>

                            <small class="text-muted">
                                {{ $mapping->page?->slug }}
                            </small>
                        </td>

                        <td>
                            <code>
                                {{ $mapping->page?->route_path }}
                            </code>
                        </td>

                        <td>
                            @if($mapping->page?->status === 'active')
                                <span class="badge bg-success">
                                    Active
                                </span>
                            @else
                                <span class="badge bg-secondary">
                                    Inactive
                                </span>
                            @endif
                        </td>

                        <td class="text-end">

                            <a href="{{ route('admin.tree-page-mappings.show', ['tree_page_mapping' => $mapping->id]) }}"
                               class="btn btn-sm btn-light">
                                View
                            </a>

                            <a href="{{ route('admin.tree-page-mappings.edit', ['tree_page_mapping' => $mapping->id]) }}"
                               class="btn btn-sm btn-primary">
                                Edit
                            </a>

                            <form action="{{ route('admin.tree-page-mappings.destroy', ['tree_page_mapping' => $mapping->id]) }}"
                                  method="POST"
                                  class="d-inline"
                                  onsubmit="return confirm('Are you sure you want to delete this mapping?');">

                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        class="btn btn-sm btn-danger">
                                    Delete
                                </button>

                            </form>

                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="7"
                            class="text-center text-muted py-4">
                            No mappings found.
                        </td>
                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection