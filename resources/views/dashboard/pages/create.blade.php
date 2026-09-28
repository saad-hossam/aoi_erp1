@extends('layouts.dashboard.app')

@section('content')

<div class="main-content-inner">
    <div class="main-content-wrap">

        {{-- Page Header --}}
        <div class="flex items-center flex-wrap justify-between gap20 mb-27">

            <h3>Create Page</h3>

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
                    <a href="{{ route('admin.pages.index') }}">
                        <div class="text-tiny">Pages</div>
                    </a>
                </li>

                <li>
                    <i class="icon-chevron-right"></i>
                </li>

                <li>
                    <div class="text-tiny">Create Page</div>
                </li>

            </ul>

        </div>

        {{-- Main Box --}}
        <div class="wg-box">

            <form
                action="{{ route('admin.pages.store') }}"
                method="POST"
                class="form-new-product form-style-1"
            >

                @csrf

                {{-- Name --}}
                <fieldset class="name">

                    <div class="body-title">
                        Page Name
                        <span class="tf-color-1">*</span>
                    </div>

                    <input
                        class="flex-grow"
                        type="text"
                        name="name"
                        placeholder="Enter page name"
                        value="{{ old('name') }}"
                        required
                    >

                </fieldset>

                @error('name')
                    <span class="alert alert-danger text-center">
                        {{ $message }}
                    </span>
                @enderror


                {{-- Slug --}}
                <fieldset class="name">

                    <div class="body-title">
                        Slug
                        <span class="tf-color-1">*</span>
                    </div>

                    <input
                        class="flex-grow"
                        type="text"
                        name="slug"
                        placeholder="example-page"
                        value="{{ old('slug') }}"
                        required
                    >

                    <small class="text-muted">
                        Unique identifier for the page.
                    </small>

                </fieldset>

                @error('slug')
                    <span class="alert alert-danger text-center">
                        {{ $message }}
                    </span>
                @enderror


                {{-- Type --}}
                <fieldset class="name">

                    <div class="body-title">
                        Page Type
                        <span class="tf-color-1">*</span>
                    </div>

                    <select
                        class="flex-grow"
                        name="type"
                        required
                    >

                        <option value="">
                            Select Type
                        </option>

                        <option
                            value="application"
                            {{ old('type', 'application') === 'application' ? 'selected' : '' }}
                        >
                            Application
                        </option>

                        <option
                            value="report"
                            {{ old('type') === 'report' ? 'selected' : '' }}
                        >
                            Report
                        </option>

                        <option
                            value="form"
                            {{ old('type') === 'form' ? 'selected' : '' }}
                        >
                            Form
                        </option>

                        <option
                            value="external"
                            {{ old('type') === 'external' ? 'selected' : '' }}
                        >
                            External
                        </option>

                    </select>

                </fieldset>

                @error('type')
                    <span class="alert alert-danger text-center">
                        {{ $message }}
                    </span>
                @enderror


                {{-- Component --}}
                <fieldset class="name">

                    <div class="body-title">
                        Component
                    </div>

                    <input
                        class="flex-grow"
                        type="text"
                        name="component"
                        placeholder="dashboard.pages.example"
                        value="{{ old('component') }}"
                    >

                    <small class="text-muted">
                        Blade view name or component used by the page.
                    </small>

                </fieldset>

                @error('component')
                    <span class="alert alert-danger text-center">
                        {{ $message }}
                    </span>
                @enderror


                {{-- Controller --}}
                <fieldset class="name">

                    <div class="body-title">
                        Controller
                    </div>

                    <input
                        class="flex-grow"
                        type="text"
                        name="controller"
                        placeholder="App\Http\Controllers\ExampleController"
                        value="{{ old('controller') }}"
                    >

                    <small class="text-muted">
                        Optional controller responsible for this page.
                    </small>

                </fieldset>

                @error('controller')
                    <span class="alert alert-danger text-center">
                        {{ $message }}
                    </span>
                @enderror


                {{-- Route Name --}}
                <fieldset class="name">

                    <div class="body-title">
                        Route Name
                        <span class="tf-color-1">*</span>
                    </div>

                    <input
                        class="flex-grow"
                        type="text"
                        name="route_name"
                        placeholder="admin.example"
                        value="{{ old('route_name') }}"
                        required
                    >

                    <small class="text-muted">
                        Laravel route name.
                    </small>

                </fieldset>

                @error('route_name')
                    <span class="alert alert-danger text-center">
                        {{ $message }}
                    </span>
                @enderror


                {{-- Route Path --}}
                <fieldset class="name">

                    <div class="body-title">
                        Route Path
                        <span class="tf-color-1">*</span>
                    </div>

                    <input
                        class="flex-grow"
                        type="text"
                        name="route_path"
                        placeholder="example"
                        value="{{ old('route_path') }}"
                        required
                    >

                    <small class="text-muted">
                        URL path used by the dynamic route.
                    </small>

                </fieldset>

                @error('route_path')
                    <span class="alert alert-danger text-center">
                        {{ $message }}
                    </span>
                @enderror


                {{-- Status --}}
                <fieldset class="name">

                    <div class="body-title">
                        Status
                        <span class="tf-color-1">*</span>
                    </div>

                    <select
                        class="flex-grow"
                        name="status"
                        required
                    >

                        <option
                            value="active"
                            {{ old('status', 'active') === 'active' ? 'selected' : '' }}
                        >
                            Active
                        </option>

                        <option
                            value="inactive"
                            {{ old('status') === 'inactive' ? 'selected' : '' }}
                        >
                            Inactive
                        </option>

                    </select>

                </fieldset>

                @error('status')
                    <span class="alert alert-danger text-center">
                        {{ $message }}
                    </span>
                @enderror


                {{-- Buttons --}}
                <div class="bot">

                    <div>

                        <a
                            href="{{ route('admin.pages.index') }}"
                            class="tf-button style-3 w208"
                        >
                            Cancel
                        </a>

                    </div>

                    <button
                        class="tf-button w208"
                        type="submit"
                    >
                        Create Page
                    </button>

                </div>

            </form>

        </div>

    </div>
</div>

@endsection