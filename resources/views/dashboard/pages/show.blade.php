@extends('layouts.dashboard.app')

@section('content')

<div class="main-content-inner">
    <div class="main-content-wrap">

        <div class="flex items-center flex-wrap justify-between gap20 mb-27">

            <h3>Page Details</h3>

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
                    <div class="text-tiny">Page Details</div>
                </li>

            </ul>

        </div>

        <div class="wg-box">

            <div class="form-new-product form-style-1">

                <fieldset class="name">
                    <div class="body-title">ID</div>
                    <input
                        type="text"
                        value="{{ $page->id }}"
                        disabled
                    >
                </fieldset>

                <fieldset class="name">
                    <div class="body-title">Name</div>
                    <input
                        type="text"
                        value="{{ $page->name }}"
                        disabled
                    >
                </fieldset>

                <fieldset class="name">
                    <div class="body-title">Slug</div>
                    <input
                        type="text"
                        value="{{ $page->slug }}"
                        disabled
                    >
                </fieldset>

                <fieldset class="name">
                    <div class="body-title">Type</div>
                    <input
                        type="text"
                        value="{{ $page->type }}"
                        disabled
                    >
                </fieldset>

                <fieldset class="name">
                    <div class="body-title">Component</div>
                    <input
                        type="text"
                        value="{{ $page->component ?? '-' }}"
                        disabled
                    >
                </fieldset>

                <fieldset class="name">
                    <div class="body-title">Controller</div>
                    <input
                        type="text"
                        value="{{ $page->controller ?? '-' }}"
                        disabled
                    >
                </fieldset>

                <fieldset class="name">
                    <div class="body-title">Route Name</div>
                    <input
                        type="text"
                        value="{{ $page->route_name }}"
                        disabled
                    >
                </fieldset>

                <fieldset class="name">
                    <div class="body-title">Route Path</div>
                    <input
                        type="text"
                        value="{{ $page->route_path }}"
                        disabled
                    >
                </fieldset>

                <fieldset class="name">
                    <div class="body-title">Status</div>
                    <input
                        type="text"
                        value="{{ ucfirst($page->status) }}"
                        disabled
                    >
                </fieldset>

                <div class="bot">

                    <div>
                        <a
                            href="{{ route('admin.pages.index') }}"
                            class="tf-button style-3 w208"
                        >
                            Back
                        </a>
                    </div>

                    <a
                        href="{{ route('admin.pages.edit', ['page' => $page->id]) }}"
                        class="tf-button w208"
                    >
                        Edit Page
                    </a>

                </div>

            </div>

        </div>

    </div>
</div>

@endsection