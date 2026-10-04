@extends('layouts.dashboard.app')
@section('content')

{{-- Font Awesome --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">



<div class="main-content-inner perm-create" dir="rtl">
    <div class="main-content-wrap">

        {{-- رأس الصفحة --}}
        <div class="pc-header">
            <div class="pc-header-left">
                <div class="pc-header-icon">
                    <i class="fa-solid fa-shield-halved"></i>
                </div>
                <div>
                    <h3>إنشاء صلاحية</h3>
                    <p>إضافة صلاحية جديدة إلى النظام</p>
                </div>
            </div>
            <a href="{{ route('permissions.index') }}" class="pc-btn-back">
                <i class="fa-solid fa-arrow-right"></i>
                <span>العودة للقائمة</span>
            </a>
        </div>

        {{-- البطاقة --}}
        <div class="pc-card">

            <div class="pc-card-head">
                <h4><i class="fa-solid fa-plus-circle"></i> تفاصيل الصلاحية الجديدة</h4>
            </div>

            <form action="{{ route('permissions.store') }}" method="POST" class="pc-form" novalidate>
                @csrf

                <div class="pc-field">
                    <label class="pc-label" for="permName">
                        اسم الصلاحية <span class="pc-required">*</span>
                    </label>
                    <div class="pc-input-wrap">
                        <input
                            type="text"
                            id="permName"
                            name="name"
                            value="{{ old('name') }}"
                            placeholder="مثال: users.create"
                            class="pc-input @error('name') is-error @enderror"
                            autocomplete="off"
                            autofocus
                        >
                        <i class="fa-solid fa-key"></i>
                    </div>

                    @error('name')
                        <div class="pc-error">
                            <i class="fa-solid fa-circle-exclamation"></i>
                            <span>{{ $message }}</span>
                        </div>
                    @else
                        <div class="pc-hint">
                            <i class="fa-solid fa-circle-info"></i>
                        </div>
                    @enderror
                </div>

                <div class="pc-actions">
                    <button type="submit" class="pc-btn primary">
                        <i class="fa-solid fa-check"></i>
                        <span>إنشاء الصلاحية</span>
                    </button>
                    <a href="{{ route('permissions.index') }}" class="pc-btn ghost">
                        <i class="fa-solid fa-xmark"></i>
                        <span>إلغاء</span>
                    </a>
                </div>
            </form>

        </div>
    </div>
</div>

@endsection