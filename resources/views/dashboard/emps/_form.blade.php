@php $isEdit = $emp->exists; @endphp

@if ($errors->any() && ! $errors->hasAny(['EMP_NO','USER_NAME','EMP_NAME','PASS_WORD','EMP_STATUS','DEPT_CODE','FILE_NO','SIGN_TYPE','REAL_DEPT','MGR','ADMIN','roles']))
    <div class='alert alert-danger'>{{ $errors->first() }}</div>
@endif

@if (! $isEdit)
<fieldset class='name'>
    <div class='body-title'>Emp No <span class='text-tiny'>(leave empty = next free number)</span></div>
    <input class='flex-grow' type='number' name='EMP_NO' value='{{ old('EMP_NO') }}' placeholder='Auto'>
</fieldset>
@error('EMP_NO') <span class='alert alert-danger text-center'>{{ $message }}</span> @enderror
@endif

<fieldset class='name'>
    <div class='body-title'>User name (shown on login) <span class='tf-color-1'>*</span></div>
    <input class='flex-grow' type='text' name='USER_NAME' maxlength='255' value='{{ old('USER_NAME', $emp->USER_NAME) }}'>
</fieldset>
@error('USER_NAME') <span class='alert alert-danger text-center'>{{ $message }}</span> @enderror

<fieldset class='name'>
    <div class='body-title'>Employee name</div>
    <input class='flex-grow' type='text' name='EMP_NAME' maxlength='256' value='{{ old('EMP_NAME', $emp->EMP_NAME) }}'>
</fieldset>
@error('EMP_NAME') <span class='alert alert-danger text-center'>{{ $message }}</span> @enderror

<fieldset class='name'>
    <div class='body-title'>Password @if($isEdit)<span class='text-tiny'>(leave blank to keep the current one)</span>@else<span class='tf-color-1'>*</span>@endif</div>
    <input class='flex-grow' type='password' name='PASS_WORD' maxlength='50' autocomplete='new-password'>
</fieldset>
@error('PASS_WORD') <span class='alert alert-danger text-center'>{{ $message }}</span> @enderror

<fieldset class='name'>
    <div class='body-title'>Unit (EMP_STATUS) <span class='tf-color-1'>*</span></div>
    @if ($units->isNotEmpty())
        <select name='EMP_STATUS'>
            <option value=''>-- choose unit --</option>
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

@foreach (['DEPT_CODE' => 'Dept code', 'FILE_NO' => 'File no', 'SIGN_TYPE' => 'Sign type', 'REAL_DEPT' => 'Real dept', 'MGR' => 'Manager (MGR)'] as $field => $label)
    <fieldset class='name'>
        <div class='body-title'>{{ $label }}</div>
        <input class='flex-grow' type='number' name='{{ $field }}' value='{{ old($field, $emp->{$field}) }}'>
    </fieldset>
    @error($field) <span class='alert alert-danger text-center'>{{ $message }}</span> @enderror
@endforeach

<fieldset class='name'>
    <div class='body-title'>Administrator (EMP.ADMIN)</div>
    <label><input type='checkbox' name='ADMIN' value='1' @checked(old('ADMIN', (int) $emp->ADMIN) == 1)> Full access to the admin area</label>
</fieldset>
@error('ADMIN') <span class='alert alert-danger text-center'>{{ $message }}</span> @enderror

<fieldset class='Role'>
    <div class='body-title'>Assign Roles</div>
    <div class='flex flex-wrap gap-3'>
        @forelse ($roles as $role)
            <label class='body-title px-5'>
                <input type='checkbox' name='roles[]' value='{{ $role->id }}'
                    @checked(in_array($role->id, array_map('intval', old('roles', $selectedRoleIds))))>
                {{ $role->name }}
            </label>
        @empty
            <span class='text-tiny'>No roles yet – create some under Roles.</span>
        @endforelse
    </div>
</fieldset>
@error('roles') <span class='alert alert-danger text-center'>{{ $message }}</span> @enderror
@error('roles.*') <span class='alert alert-danger text-center'>{{ $message }}</span> @enderror

<div class='bot'>
    <div></div>
    <button class='tf-button w208' type='submit'>{{ $submit }}</button>
</div>
