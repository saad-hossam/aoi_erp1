@extends('layouts.dashboard.app')
@section('content')
<div class="main-content-inner">
    <div class="main-content-wrap">
        <h3>Create Permission</h3>

        <form action="{{ route('permissions.store') }}" method="POST" class="wg-box">
            @csrf
            <fieldset class="name mb-3">
                <label>Name</label>
                <input type="text" name="name" value="{{ old('name') }}" class="form-control">
                @error('name') <span class="alert alert-danger">{{ $message }}</span> @enderror
            </fieldset>


            <button type="submit" class="tf-button style-1 w208">Create</button>
        </form>
    </div>
</div>
@endsection
