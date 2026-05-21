@extends('layouts.app')

@section('content')

<div style="padding:20px;">
    <h1>Users Management</h1>

    <table style="width:100%; margin-top:20px; border-collapse:collapse;">
        <thead>
            <tr style="text-align:left;">
                <th>Name</th>
                <th>Email</th>
                <th>Created</th>
            </tr>
        </thead>

        <tbody>
            @foreach($users as $user)
                <tr style="border-top:1px solid #e5e7eb;">
                    <td style="padding:10px;">{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->created_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<form action="{{ route('admin.users.destroy', $user) }}" method="POST" style="display:inline;">
    @csrf
    @method('DELETE')

    <button type="submit" style="color:red;">
        Delete
    </button>
</form>

<a href="{{ route('admin.users.edit', $user) }}">
    Edit
</a>

@endsection