@extends('layouts.dashboard.app')
@section('content')
<div class="main-content-inner">
    <div class="main-content-wrap">
        <h3>Edit Permission</h3>

        <form action="{{ route('permissions.update', $permission->id) }}" method="POST" class="wg-box">
            @csrf
            @method('PUT')
            <fieldset class="name mb-3">
                <label>Name</label>
                <input type="text" name="name" value="{{ old('name', $permission->name) }}" class="form-control">
                @error('name') <span class="alert alert-danger">{{ $message }}</span> @enderror
            </fieldset>



            <button type="submit" class="tf-button style-1 w208">Update</button>
        </form>
    </div>
</div>
@endsection
