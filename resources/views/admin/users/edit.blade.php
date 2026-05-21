@extends('layouts.app')

@section('content')

<div style="padding:20px;">
    <h1>Edit User</h1>

    <form method="POST" action="{{ route('admin.users.update', $user) }}">
        @csrf
        @method('PUT')

        <div style="margin-bottom:10px;">
            <input type="text" name="name" value="{{ $user->name }}" style="width:100%; padding:10px;">
        </div>

        <div style="margin-bottom:10px;">
            <input type="email" name="email" value="{{ $user->email }}" style="width:100%; padding:10px;">
        </div>

        <button type="submit" style="padding:10px 20px;">
            Update
        </button>
    </form>
</div>

@endsection