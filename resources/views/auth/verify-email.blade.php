<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Email</title>
    <style>
        :root {
            --bg: #f8fafc;
            --card: #ffffff;
            --text: #0f172a;
            --muted: #64748b;
            --primary: #0ea5e9;
            --primary-dark: #0284c7;
            --success-bg: #dcfce7;
            --success-text: #166534;
            --border: #e2e8f0;
            --danger: #dc2626;
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            background: radial-gradient(circle at top left, #dbeafe 0%, var(--bg) 50%, #e2e8f0 100%);
            color: var(--text);
            display: grid;
            place-items: center;
            padding: 24px;
        }

        .card {
            width: 100%;
            max-width: 480px;
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 14px;
            box-shadow: 0 12px 28px rgba(15, 23, 42, 0.08);
            padding: 28px;
        }

        h1 {
            margin: 0 0 8px;
            font-size: 1.6rem;
        }

        .sub {
            margin: 0 0 20px;
            color: var(--muted);
            font-size: 0.95rem;
            line-height: 1.5;
        }

        .success {
            margin-bottom: 14px;
            border: 1px solid #86efac;
            background: var(--success-bg);
            color: var(--success-text);
            border-radius: 10px;
            padding: 10px 12px;
            font-size: 0.9rem;
        }

        .actions {
            display: flex;
            gap: 10px;
            margin-top: 10px;
        }

        button {
            border: 0;
            border-radius: 10px;
            padding: 10px 14px;
            color: #fff;
            font-weight: 700;
            cursor: pointer;
            background: var(--primary);
        }

        button:hover { background: var(--primary-dark); }

        .btn-danger {
            background: var(--danger);
        }
    </style>
</head>
<body>
    <div class="card">
        <h1>Verify Your Email</h1>
        <p class="sub">
            Thanks for signing up. Please click the verification link sent to your email address before continuing.
            If you did not receive it, request another link below.
        </p>

        @if (session('status'))
            <div class="success">{{ session('status') }}</div>
        @endif

        <div class="actions">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <button type="submit">Resend Verification Email</button>
            </form>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="btn-danger" type="submit">Logout</button>
            </form>
        </div>
    </div>
</body>
</html>
