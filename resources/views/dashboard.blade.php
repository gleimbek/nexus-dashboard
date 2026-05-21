@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<div style="margin-bottom:30px;">
    <h1 style="font-size:32px;">Welcome back 👋</h1>

    <p style="color:#6b7280;">
        Here is your business analytics overview.
    </p>
</div>

<!-- CARDS -->

<div class="cards">

    <div class="card">
        <h3>Total Users</h3>
        <p>{{ $usersCount }}</p>
    </div>

    <div class="card">
        <h3>Revenue</h3>
        <p>$12.4K</p>
    </div>

    <div class="card">
        <h3>Active Sessions</h3>
        <p>312</p>
    </div>

</div>

<!-- CHART -->

<div class="panel" style="margin-bottom:30px;">

    <h3 style="margin-bottom:20px;">
        User Growth Analytics
    </h3>

    <canvas id="usersChart"></canvas>

</div>

<!-- USERS TABLE -->

<div class="panel">

    <h3>Latest Users</h3>

    <table>

        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
            </tr>
        </thead>

        <tbody>

            @foreach($latestUsers as $user)

                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                </tr>

            @endforeach

        </tbody>

    </table>

</div>


@endsection