
@extends('layouts.dashboard.app')

@section('content')
<div class="main-content-inner">
    <div class="main-content-wrap">

        {{-- Page Header --}}
        <div class="flex items-center flex-wrap justify-between gap20 mb-27">
            <h3>Edit Tree Node</h3>

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
                    <a href="{{ route('admin.tree-nodes.index') }}">
                        <div class="text-tiny">System Tree</div>
                    </a>
                </li>

                <li>
                    <i class="icon-chevron-right"></i>
                </li>

                <li>
                    <div class="text-tiny">Edit Tree Node</div>
                </li>
            </ul>
        </div>

        {{-- Form --}}
        <div class="wg-box">

            <form
                action="{{ route('admin.tree-nodes.update', ['tree_node' => $node->value]) }}"
                method="POST"
                class="form-new-product form-style-1"
            >
                @csrf
                @method('PUT')

                {{-- Node Value --}}
                <fieldset class="name">
                    <div class="body-title">
                        Node Value
                    </div>

                    <input
                        class="flex-grow"
                        type="text"
                        value="{{ $node->value }}"
                        disabled
                    >

                    <small class="text-muted">
                        This value is generated and managed by Oracle.
                    </small>
                </fieldset>

                {{-- Arabic Label --}}
                <fieldset class="name">
                    <div class="body-title">
                        Arabic Label <span class="tf-color-1">*</span>
                    </div>

                    <input
                        class="flex-grow"
                        type="text"
                        name="label"
                        placeholder="Enter Arabic label"
                        value="{{ old('label', $node->label) }}"
                        required
                    >
                </fieldset>

                @error('label')
                    <span class="alert alert-danger text-center">
                        {{ $message }}
                    </span>
                @enderror

                {{-- English Label --}}
                <fieldset class="name">
                    <div class="body-title">
                        English Label
                    </div>

                    <input
                        class="flex-grow"
                        type="text"
                        name="label_eng"
                        placeholder="Enter English label"
                        value="{{ old('label_eng', $node->label_eng) }}"
                    >
                </fieldset>

                @error('label_eng')
                    <span class="alert alert-danger text-center">
                        {{ $message }}
                    </span>
                @enderror

                {{-- Parent Node --}}
                <fieldset class="name">
                    <div class="body-title">
                        Parent Node <span class="tf-color-1">*</span>
                    </div>

                    <select
                        class="flex-grow"
                        name="parent_value"
                        required
                    >
                        <option value="">Select Parent</option>

                        @foreach ($parents as $parent)
                            <option
                                value="{{ $parent->value }}"
                                {{ (string) old('parent_value', $node->parent_value) === (string) $parent->value ? 'selected' : '' }}
                            >
                                {{ $parent->label }}
                                ({{ $parent->value }})
                            </option>
                        @endforeach
                    </select>
                </fieldset>

                @error('parent_value')
                    <span class="alert alert-danger text-center">
                        {{ $message }}
                    </span>
                @enderror

                {{-- Level --}}
                <fieldset class="name">
                    <div class="body-title">
                        Level
                    </div>

                    <input
                        class="flex-grow"
                        type="number"
                        value="{{ $node->ilevel }}"
                        disabled
                    >

                    <small class="text-muted">
                        The level is calculated automatically based on the parent.
                    </small>
                </fieldset>

                {{-- Buttons --}}
                <div class="bot">
                    <div>
                        <a
                            href="{{ route('admin.tree-nodes.index') }}"
                            class="tf-button style-3 w208"
                        >
                            Cancel
                        </a>
                    </div>

                    <button class="tf-button w208" type="submit">
                        Update Tree Node
                    </button>
                </div>

            </form>
        </div>

    </div>
</div>
@endsection