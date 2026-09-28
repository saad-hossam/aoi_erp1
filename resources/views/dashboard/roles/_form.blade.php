<fieldset class='name'>
    <div class='body-title'>Name <span class='tf-color-1'>*</span></div>
    <input class='flex-grow' type='text' name='name' placeholder='Enter Name' value='{{ old('name', $role->name) }}'>
</fieldset>
@error('name') <span class='alert alert-danger text-center'>{{ $message }}</span> @enderror

<fieldset class='Permissions'>
    <div class='body-title'>Assign Permissions</div>
    @php $selected = old('permissions', $role->exists ? $role->permissions->pluck('id')->all() : []); @endphp
    <div class='flex gap-2 flex-wrap'>
        @forelse ($permissions as $permission)
            <label class='body-title px-5'>
                <input type='checkbox' name='permissions[]' value='{{ $permission->id }}'
                    @checked(in_array($permission->id, array_map('intval', $selected)))>
                {{ $permission->name }}
            </label>
        @empty
            <span class='text-tiny'>No permissions yet – create some under Permissions.</span>
        @endforelse
    </div>
</fieldset>
@error('permissions.*') <span class='alert alert-danger text-center'>{{ $message }}</span> @enderror

<div class='bot'>
    <div></div>
    <button class='tf-button w208' type='submit'>{{ $submit }}</button>
</div>
