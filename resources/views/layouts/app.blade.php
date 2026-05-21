<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
        }

        body{
            font-family: Arial, Helvetica, sans-serif;
            background:#f5f7fb;
            color:#111827;
        }

        .layout{
            display:flex;
            min-height:100vh;
        }

        /* SIDEBAR */

        .sidebar{
            width:260px;
            background:#111827;
            color:white;
            padding:30px 20px;
        }

        .logo{
            font-size:24px;
            font-weight:700;
            margin-bottom:40px;
        }

        .nav-links{
            display:flex;
            flex-direction:column;
            gap:12px;
        }

        .nav-links a{
            color:#d1d5db;
            text-decoration:none;
            padding:12px 14px;
            border-radius:10px;
            transition:0.2s;
        }

        .nav-links a:hover{
            background:#1f2937;
            color:white;
        }

        /* CONTENT */

        .main{
            flex:1;
            padding:40px;
        }

        /* TOPBAR */

        .topbar{
            display:flex;
            justify-content:space-between;
            align-items:center;
            margin-bottom:30px;
        }

        .topbar h2{
            font-size:28px;
        }

        .logout-btn{
            background:#ef4444;
            color:white;
            border:none;
            padding:10px 16px;
            border-radius:8px;
            cursor:pointer;
        }

        /* CARDS */

        .cards{
            display:grid;
            grid-template-columns:repeat(auto-fit, minmax(250px,1fr));
            gap:20px;
            margin-bottom:30px;
        }

        .card{
            background:white;
            padding:25px;
            border-radius:18px;
            box-shadow:0 4px 15px rgba(0,0,0,0.05);
        }

        .card h3{
            color:#6b7280;
            margin-bottom:10px;
            font-size:15px;
        }

        .card p{
            font-size:32px;
            font-weight:700;
        }

        /* PANEL */

        .panel{
            background:white;
            padding:25px;
            border-radius:18px;
            box-shadow:0 4px 15px rgba(0,0,0,0.05);
        }

        table{
            width:100%;
            border-collapse:collapse;
            margin-top:20px;
        }

        table th{
            text-align:left;
            padding:14px;
            border-bottom:1px solid #e5e7eb;
        }

        table td{
            padding:14px;
            border-bottom:1px solid #f3f4f6;
        }

        .badge-admin{
            background:#dcfce7;
            color:#166534;
            padding:6px 10px;
            border-radius:999px;
            font-size:12px;
            font-weight:700;
        }

        .badge-user{
            background:#e0e7ff;
            color:#3730a3;
            padding:6px 10px;
            border-radius:999px;
            font-size:12px;
            font-weight:700;
        }

    </style>

</head>
<body>

<div class="layout">

    <!-- SIDEBAR -->
    <aside class="sidebar">

        <div class="logo">
            Nexus Dashboard
        </div>

        <nav class="nav-links">
            <a href="/dashboard">Dashboard</a>
            <a href="/admin/users">Users</a>
            <a href="#">Analytics</a>
            <a href="#">Reports</a>
            <a href="#">Settings</a>
        </nav>

    </aside>

    <!-- MAIN -->
    <main class="main">

        <div class="topbar">

            <h2>@yield('title')</h2>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="logout-btn">
                    Logout
                </button>
            </form>

        </div>

        @yield('content')

    </main>

</div>

</body>
</html>