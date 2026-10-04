@php
    $selected = old('permissions', $role->exists ? $role->permissions->pluck('id')->all() : []);
@endphp

<div class='perm-grid'>

    {{-- اسم الدور: صف كامل --}}
    <fieldset class='name perm-full'>
        <div class='body-title'>اسم الدور <span class='tf-color-1'>*</span></div>
        <input type='text' name='name' maxlength='255'
               placeholder='مثال: Admin, Manager, HR...'
               value='{{ old('name', $role->name) }}'
               required>
    </fieldset>
    @error('name') <span class='perm-error'>{{ $message }}</span> @enderror

    {{-- الصلاحيات: صف كامل --}}
    <fieldset class='Role perm-full'>
        <div class='body-title'>
            الصلاحيات
            <span class='text-tiny'>(يمكن تحديد أكثر من صلاحية)</span>
        </div>

        {{-- شريط أدوات: العدّاد + أزرار التحكم --}}
        <div class='perm-perms-toolbar'>
            <span class='perm-perms-counter' id='permCounter'>
                <i class='fa-solid fa-key'></i>
                <span>0 محددة</span>
            </span>
            <div class='perm-perms-tools'>
                <button type='button' class='perm-perms-btn' id='permSelectAllPerms'>
                    <i class='fa-solid fa-check-double'></i> تحديد الكل
                </button>
                <button type='button' class='perm-perms-btn' id='permClearAllPerms'>
                    <i class='fa-solid fa-xmark'></i> إلغاء الكل
                </button>
            </div>
        </div>

        {{-- شبكة الصلاحيات --}}
        <div class='perm-perms-box'>
            @forelse ($permissions as $permission)
                <label class='perm-perm-item'>
                    <input type='checkbox'
                           name='permissions[]'
                           value='{{ $permission->id }}'
                           @checked(in_array($permission->id, array_map('intval', $selected)))>
                    <span class='perm-perm-name' title='{{ $permission->name }}'>
                        {{ $permission->name }}
                    </span>
                </label>
            @empty
                <span style='color:#9ca3af;font-size:13px;grid-column:1/-1;text-align:center;padding:20px;'>
                    لا توجد صلاحيات بعد — أنشئ بعضها من صفحة الصلاحيات.
                </span>
            @endforelse
        </div>
        @error('permissions') <span class='perm-error'>{{ $message }}</span> @enderror
        @error('permissions.*') <span class='perm-error'>{{ $message }}</span> @enderror
    </fieldset>

</div>

{{-- زر الحفظ القديم: مخفي لأننا نستخدم زر الفوتر --}}
<div class='bot' style='display:none;'>
    <div></div>
    <button class='tf-button w208' type='submit'>{{ $submit }}</button>
</div>