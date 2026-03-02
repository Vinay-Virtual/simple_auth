<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        :root {
            --bg: #f8fafc;
            --card: #ffffff;
            --text: #0f172a;
            --muted: #64748b;
            --primary: #0ea5e9;
            --danger: #dc2626;
            --border: #e2e8f0;
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(150deg, #dbeafe 0%, var(--bg) 45%, #ecfeff 100%);
            color: var(--text);
            display: grid;
            place-items: center;
            padding: 24px;
        }

        .card {
            width: 100%;
            max-width: 560px;
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 14px;
            box-shadow: 0 12px 28px rgba(15, 23, 42, 0.08);
            padding: 28px;
        }

        h1 {
            margin: 0 0 8px;
            font-size: 1.75rem;
        }

        .sub {
            margin: 0 0 18px;
            color: var(--muted);
        }

        .meta {
            margin: 0;
            padding: 0;
            list-style: none;
            border: 1px solid var(--border);
            border-radius: 12px;
            overflow: hidden;
        }

        .meta li {
            display: grid;
            grid-template-columns: 130px 1fr;
            gap: 12px;
            padding: 12px 14px;
            border-bottom: 1px solid var(--border);
        }

        .meta li:last-child { border-bottom: 0; }

        .label {
            color: var(--muted);
            font-weight: 600;
        }

        .value {
            word-break: break-word;
            font-weight: 500;
        }

        .actions {
            margin-top: 18px;
            display: flex;
            gap: 10px;
            justify-content: flex-end;
        }

        .success {
            margin: 0 0 14px;
            border: 1px solid #86efac;
            background: #dcfce7;
            color: #166534;
            border-radius: 10px;
            padding: 10px 12px;
            font-size: 0.9rem;
        }

        .btn {
            display: inline-block;
            text-decoration: none;
            border: 0;
            border-radius: 10px;
            padding: 10px 14px;
            color: #fff;
            font-weight: 700;
            cursor: pointer;
        }

        .btn-primary { background: var(--primary); }
        .btn-danger { background: var(--danger); }
    </style>
</head>
<body>
    <div class="card">
        <h1>Dashboard</h1>
        <p class="sub">Welcome, you are logged in.</p>

        @if (session('verified'))
            <div class="success">{{ session('verified') }}</div>
        @endif

        <ul class="meta">
            <li>
                <span class="label">User ID</span>
                <span class="value">{{ auth()->user()->id }}</span>
            </li>
            <li>
                <span class="label">Full Name</span>
                <span class="value">{{ auth()->user()->name }}</span>
            </li>
            <li>
                <span class="label">Email</span>
                <span class="value">{{ auth()->user()->email }}</span>
            </li>
            <li>
                <span class="label">Logged In At</span>
                <span class="value">{{ now()->format('d M Y, h:i A') }}</span>
            </li>
        </ul>

        <div class="actions">
            <a class="btn btn-primary" href="{{ route('password.change') }}">Change Password</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="btn btn-danger" type="submit">Logout</button>
            </form>
        </div>
    </div>
</body>
</html>
