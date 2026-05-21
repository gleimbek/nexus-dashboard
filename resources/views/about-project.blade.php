@extends('layouts.app')

@section('title', 'About Nexus Dashboard')

@section('content')

<div style="max-width: 900px; margin: auto; padding: 40px 20px;">

    <h1>Nexus Dashboard SaaS</h1>

    <p style="font-size: 18px; color: #555;">
        Nexus Dashboard is a modern SaaS-style admin panel built with Laravel, designed to simulate real-world business analytics systems used in startups and enterprise platforms.
    </p>

    <h2>🚀 Project Purpose</h2>
    <p>
        This project was created to demonstrate full-stack development skills, including backend logic, authentication, role-based access control, and dynamic data visualization.
    </p>

    <h2>🧠 Key Features</h2>
    <ul>
        <li>User authentication system (login/register/logout)</li>
        <li>Role-based access control (Admin / User)</li>
        <li>Dynamic user management (CRUD)</li>
        <li>Real-time dashboard metrics</li>
        <li>Latest users tracking system</li>
    </ul>

    <h2>🛠 Tech Stack</h2>
    <ul>
        <li>Laravel 12</li>
        <li>PHP 8.2</li>
        <li>MySQL</li>
        <li>Vite</li>
        <li>Blade Templates</li>
    </ul>

    <h2>📊 Business Simulation</h2>
    <p>
        The dashboard simulates SaaS analytics such as total users, revenue, and active sessions, representing a realistic business intelligence system.
    </p>

</div>

@endsection