@php $isEdit = $emp->exists; @endphp

@if ($errors->any() && ! $errors->hasAny(['EMP_NO','USER_NAME','EMP_NAME','PASS_WORD','EMP_STATUS','DEPT_CODE','FILE_NO','SIGN_TYPE','REAL_DEPT','MGR','ADMIN','roles']))
    <div class='alert alert-danger'>{{ $errors->first() }}</div>
@endif

<div class='perm-grid'>

    @if (! $isEdit)
    <fieldset class='name'>
        <div class='body-title'>رقم الموظف <span class='text-tiny'>(اتركه فارغاً = الرقم الحر التالي)</span></div>
        <input class='flex-grow' type='number' name='EMP_NO' value='{{ old('EMP_NO') }}' placeholder='تلقائي'>
    </fieldset>
    @error('EMP_NO') <span class='alert alert-danger text-center'>{{ $message }}</span> @enderror
    @endif

    <fieldset class='name'>
        <div class='body-title'>اسم المستخدم (يظهر عند تسجيل الدخول) <span class='tf-color-1'>*</span></div>
        <input class='flex-grow' type='text' name='USER_NAME' maxlength='255' value='{{ old('USER_NAME', $emp->USER_NAME) }}'>
    </fieldset>
    @error('USER_NAME') <span class='alert alert-danger text-center'>{{ $message }}</span> @enderror

    <fieldset class='name'>
        <div class='body-title'>اسم الموظف</div>
        <input class='flex-grow' type='text' name='EMP_NAME' maxlength='256' value='{{ old('EMP_NAME', $emp->EMP_NAME) }}'>
    </fieldset>
    @error('EMP_NAME') <span class='alert alert-danger text-center'>{{ $message }}</span> @enderror

    <fieldset class='name'>
        <div class='body-title'>كلمة المرور @if($isEdit)<span class='text-tiny'>(اتركها فارغة للإبقاء على الحالية)</span>@else<span class='tf-color-1'>*</span>@endif</div>
        <input class='flex-grow' type='password' name='PASS_WORD' maxlength='50' autocomplete='new-password'>
    </fieldset>
    @error('PASS_WORD') <span class='alert alert-danger text-center'>{{ $message }}</span> @enderror

    <fieldset class='name'>
        <div class='body-title'>الوحدة (EMP_STATUS) <span class='tf-color-1'>*</span></div>
        @if ($units->isNotEmpty())
            <select name='EMP_STATUS'>
                <option value=''>-- اختر الوحدة --</option>
                @foreach ($units as $unit)
                    <option value='{{ $unit->UNIT_CODE }}' @selected((string) old('EMP_STATUS', $emp->EMP_STATUS) === (string) $unit->UNIT_CODE)>
                        {{ $unit->UNIT_NAME }} ({{ $unit->UNIT_CODE }})
                    </option>
                @endforeach
            </select>
        @else
            <input class='flex-grow' type='number' name='EMP_STATUS' value='{{ old('EMP_STATUS', $emp->EMP_STATUS) }}'>
        @endif
    </fieldset>
    @error('EMP_STATUS') <span class='alert alert-danger text-center'>{{ $message }}</span> @enderror

    @foreach (['DEPT_CODE' => 'رمز القسم', 'FILE_NO' => 'رقم الملف', 'SIGN_TYPE' => 'نوع التوقيع', 'REAL_DEPT' => 'القسم الفعلي', 'MGR' => 'المدير (MGR)'] as $field => $label)
        <fieldset class='name'>
            <div class='body-title'>{{ $label }}</div>
            <input class='flex-grow' type='number' name='{{ $field }}' value='{{ old($field, $emp->{$field}) }}'>
        </fieldset>
        @error($field) <span class='alert alert-danger text-center'>{{ $message }}</span> @enderror
    @endforeach

    {{-- Administrator: صف كامل --}}
    <fieldset class='name perm-full'>
        <div class='body-title'>المدير (EMP.ADMIN)</div>
        <label><input type='checkbox' name='ADMIN' value='1' @checked(old('ADMIN', (int) $emp->ADMIN) == 1)> وصول كامل إلى منطقة الإدارة</label>
    </fieldset>
    @error('ADMIN') <span class='alert alert-danger text-center'>{{ $message }}</span> @enderror

    {{-- Roles: صف كامل --}}
    <fieldset class='Role perm-full'>
        <div class='body-title'>تعيين الأدوار</div>
        <div class='flex flex-wrap gap-3'>
            @forelse ($roles as $role)
                <label class='body-title px-5'>
                    <input type='checkbox' name='roles[]' value='{{ $role->id }}'
                        @checked(in_array($role->id, array_map('intval', old('roles', $selectedRoleIds))))>
                    {{ $role->name }}
                </label>
            @empty
                <span class='text-tiny'>لا توجد أدوار بعد – أنشئ بعضها من قسم الأدوار.</span>
            @endforelse
        </div>
    </fieldset>
    @error('roles') <span class='alert alert-danger text-center'>{{ $message }}</span> @enderror
    @error('roles.*') <span class='alert alert-danger text-center'>{{ $message }}</span> @enderror

</div>

{{-- زر الحفظ القديم: أبقيه لكن مخفي إن كنت تستخدم زر الفوتر --}}
<div class='bot' style='display:none;'>
    <div></div>
    <button class='tf-button w208' type='submit'>{{ $submit }}</button>
</div>