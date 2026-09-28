
@extends('layouts.dashboard.app')

@section('content')

<style>
    .tree-node-value {
        width: 100px;
    }

    .tree-node-label {
        width: 220px;
    }

    .tree-node-label-eng {
        width: 220px;
    }

    .tree-node-parent {
        width: 120px;
    }

    .tree-node-level {
        width: 80px;
    }

    .tree-node-type {
        width: 120px;
    }

    .tree-node-actions {
        width: 220px;
        white-space: nowrap;
    }
</style>

<div class="main-content-inner">
    <div class="main-content-wrap">

        {{-- Page Header --}}
        <div class="flex items-center flex-wrap justify-between gap20 mb-27">

            <h3>Tree Nodes</h3>

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
                    <div class="text-tiny">Tree Nodes</div>
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
                        action="{{ route('admin.tree-nodes.index') }}"
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
                    href="{{ route('admin.tree-nodes.create') }}"
                >
                    <i class="icon-plus"></i>
                    Add New Node
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
                                <th class="tree-node-value">VALUE</th>
                                <th class="tree-node-label">LABEL</th>
                                {{-- <th class="tree-node-label-eng">LABEL ENG</th> --}}
                                <th class="tree-node-parent">PARENT VALUE</th>
                                <th class="tree-node-level">LEVEL</th>
                                {{-- <th class="tree-node-type">TYPE</th> --}}
                                <th class="tree-node-actions">ACTIONS</th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse($nodes as $node)

                                <tr>
                                    {{-- VALUE --}}
                                    <td>{{ $node->value }}</td>

                                    {{-- LABEL --}}
                                    <td>{{ $node->label }}</td>

                                    {{-- LABEL ENG --}}
                                    {{-- <td>{{ $node->label_eng }}</td> --}}

                                    {{-- PARENT VALUE --}}
                                    <td>{{ $node->parent_value ?? '-' }}</td>

                                    {{-- LEVEL --}}
                                    <td>{{ $node->ilevel }}</td>

                                    {{-- TYPE --}}
                                    {{-- <td>{{ $node->node_type ?? '-' }}</td> --}}

                                    {{-- ACTIONS --}}
                                    <td>

                                        {{-- View --}}
                                        <a
                                            href="{{ route('admin.tree-nodes.show', ['tree_node' => $node->value]) }}"
                                            class="btn btn-sm btn-info"
                                        >
                                            View
                                        </a>

                                        {{-- Edit --}}
                                        <a
                                            href="{{ route('admin.tree-nodes.edit', ['tree_node' => $node->value]) }}"
                                            class="tf-button style-1"
                                        >
                                            Edit
                                        </a>

                                        {{-- Delete --}}
                                        @if($node->parent_value !== null)

                                            <form
                                                action="{{ route('admin.tree-nodes.destroy', ['tree_node' => $node->value]) }}"
                                                method="POST"
                                                class="d-inline"
                                                onsubmit="return confirm('Are you sure you want to delete this node?')"
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

                                        @endif

                                    </td>
                                </tr>

                            @empty

                                <tr>
                                    <td colspan="7" class="text-center">
                                        No tree nodes found.
                                    </td>
                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

                {{-- Pagination --}}
                @if(method_exists($nodes, 'links'))
                    <div class="divider">
                        {{ $nodes->links('pagination::bootstrap-5') }}
                    </div>
                @endif

            </div>

        </div>

    </div>
</div>

@endsection