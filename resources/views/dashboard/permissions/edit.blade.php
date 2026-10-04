@extends('layouts.dashboard.app')
@section('content')

{{-- Font Awesome --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">


<div class="main-content-inner perm-edit" dir="rtl">
    <div class="main-content-wrap">

        {{-- رأس الصفحة --}}
        <div class="pe-header">
            <div class="pe-header-left">
                <div class="pe-header-icon">
                    <i class="fa-solid fa-pen-to-square"></i>
                </div>
                <div>
                    <h3>تعديل الصلاحية</h3>
                    <p>تحديث تفاصيل هذه الصلاحية</p>
                </div>
            </div>
            <a href="{{ route('permissions.index') }}" class="pe-btn-back">
                <i class="fa-solid fa-arrow-right"></i>
                <span>العودة للقائمة</span>
            </a>
        </div>

        {{-- البطاقة --}}
        <div class="pe-card">

            <div class="pe-card-head">
                <h4><i class="fa-solid fa-pen"></i> تفاصيل الصلاحية</h4>
            </div>

            <form action="{{ route('permissions.update', $permission->id) }}"
                  method="POST"
                  class="pe-form"
                  novalidate>
                @csrf
                @method('PUT')

                {{-- شريط التعديل --}}
                {{-- <div class="pe-editing">
                    <i class="fa-solid fa-circle-info"></i>
                    <div>
                        أنت تقوم بتعديل <strong>الصلاحية #{{ $permission->id }}</strong> —
                        <code>{{ $permission->name }}</code>
                    </div>
                </div> --}}

                {{-- حقل الاسم --}}
                <div class="pe-field">
                    <label class="pe-label" for="permName">
                        اسم الصلاحية <span class="pe-required">*</span>
                    </label>
                    <div class="pe-input-wrap">
                        <input
                            type="text"
                            id="permName"
                            name="name"
                            value="{{ old('name', $permission->name) }}"
                            placeholder="مثال: users.create"
                            class="pe-input @error('name') is-error @enderror"
                            autocomplete="off"
                        >
                        <i class="fa-solid fa-key"></i>
                    </div>

                    @error('name')
                        <div class="pe-error">
                            <i class="fa-solid fa-circle-exclamation"></i>
                            <span>{{ $message }}</span>
                        </div>
                    @else
                        <div class="pe-hint">
                            <i class="fa-solid fa-circle-info"></i>
                        </div>
                    @enderror
                </div>

                {{-- معلومات إضافية --}}
                <div class="pe-meta">
                    <div class="pe-meta-item">
                        <span class="pe-meta-label">المعرف</span>
                        <span class="pe-meta-value">
                            <i class="fa-solid fa-hashtag"></i>
                            {{ $permission->id }}
                        </span>
                    </div>
                    <div class="pe-meta-item">
                        <span class="pe-meta-label">الاسم الحالي</span>
                        <span class="pe-meta-value">
                            <i class="fa-solid fa-key"></i>
                            {{ $permission->name }}
                        </span>
                    </div>
                    @if($permission->created_at)
                    <div class="pe-meta-item">
                        <span class="pe-meta-label">تاريخ الإنشاء</span>
                        <span class="pe-meta-value">
                            <i class="fa-solid fa-calendar"></i>
                            {{ $permission->created_at->format('M d, Y') }}
                        </span>
                    </div>
                    @endif
                    @if($permission->updated_at)
                    <div class="pe-meta-item">
                        <span class="pe-meta-label">آخر تحديث</span>
                        <span class="pe-meta-value">
                            <i class="fa-solid fa-clock"></i>
                            {{ $permission->updated_at->diffForHumans() }}
                        </span>
                    </div>
                    @endif
                </div>

                {{-- الإجراءات --}}
                <div class="pe-actions">
                    <button type="submit" class="pe-btn primary">
                        <i class="fa-solid fa-check"></i>
                        <span>تحديث الصلاحية</span>
                    </button>
                    <a href="{{ route('permissions.index') }}" class="pe-btn ghost">
                        <i class="fa-solid fa-xmark"></i>
                        <span>إلغاء</span>
                    </a>
                </div>

            </form>

        </div>
    </div>
</div>

@endsection