@extends('layouts.app')

@section('content')

<div style="padding:20px;">
    <h1>Users Management</h1>

    @if (session('status'))
        <p role="status" style="margin-top:12px; padding:10px; background:#ecfdf5; color:#065f46; border-radius:6px;">
            {{ session('status') }}
        </p>
    @endif

    <table style="width:100%; margin-top:20px; border-collapse:collapse;">
        <thead>
            <tr style="text-align:left;">
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Created</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>
            @foreach($users as $user)
                <tr style="border-top:1px solid #e5e7eb;">
                    <td style="padding:10px;">{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->role }}</td>
                    <td>{{ $user->created_at->format('M j, Y') }}</td>
                    <td style="white-space:nowrap;">
                        <a href="{{ route('admin.users.edit', $user) }}">Edit</a>

                        @unless (auth()->user()->is($user))
                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST" style="display:inline; margin-left:12px;"
                                  onsubmit="return confirm('Delete {{ addslashes($user->name) }}? This can\'t be undone.');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="color:#b91c1c; background:none; border:0; cursor:pointer; padding:0;">
                                    Delete
                                </button>
                            </form>
                        @endunless
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
