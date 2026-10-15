@extends('layouts.app')

@section('content')

<div style="padding:20px; max-width:480px;">
    <h1>Edit User</h1>

    <form method="POST" action="{{ route('admin.users.update', $user) }}" style="margin-top:20px;">
        @csrf
        @method('PUT')

        <div style="margin-bottom:14px;">
            <label for="name" style="display:block; margin-bottom:4px;">Name</label>
            <input id="name" type="text" name="name" value="{{ old('name', $user->name) }}" required style="width:100%; padding:10px;">
            @error('name') <p style="color:#b91c1c; margin-top:4px;">{{ $message }}</p> @enderror
        </div>

        <div style="margin-bottom:14px;">
            <label for="email" style="display:block; margin-bottom:4px;">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email', $user->email) }}" required style="width:100%; padding:10px;">
            @error('email') <p style="color:#b91c1c; margin-top:4px;">{{ $message }}</p> @enderror
        </div>

        <button type="submit" style="padding:10px 20px;">Save changes</button>
        <a href="{{ route('admin.users') }}" style="margin-left:12px;">Cancel</a>
    </form>
</div>

@endsection
