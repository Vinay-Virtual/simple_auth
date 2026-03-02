<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
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
            --danger-text: #991b1b;
            --border: #e2e8f0;
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

        .auth-card {
            width: 100%;
            max-width: 440px;
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

        .field { margin-bottom: 14px; }

        label {
            display: block;
            font-size: 0.9rem;
            margin-bottom: 6px;
            font-weight: 600;
        }

        input[type="password"] {
            width: 100%;
            border: 1px solid var(--border);
            border-radius: 10px;
            padding: 11px 12px;
            font-size: 0.95rem;
            outline: none;
            transition: border-color .18s, box-shadow .18s;
        }

        input:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(14, 165, 233, 0.18);
        }

        .error {
            margin-top: 5px;
            color: var(--danger-text);
            font-size: 0.82rem;
        }

        button {
            width: 100%;
            border: 0;
            border-radius: 10px;
            padding: 12px;
            background: var(--primary);
            color: #fff;
            font-weight: 700;
            font-size: 0.95rem;
            cursor: pointer;
            transition: background .2s;
        }

        button:hover { background: var(--primary-dark); }

        .bottom {
            margin-top: 16px;
            text-align: center;
            color: var(--muted);
            font-size: 0.9rem;
        }

        a {
            color: var(--primary-dark);
            text-decoration: none;
            font-weight: 600;
        }

        a:hover { text-decoration: underline; }
    </style>
</head>
<body>
    <div class="auth-card">
        <h1>Change Password</h1>
        <p class="sub">Update your account password securely.</p>

        @if (session('success'))
            <div class="success">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ route('password.change.update') }}">
            @csrf

            <div class="field">
                <label for="current_password">Current Password</label>
                <input id="current_password" type="password" name="current_password" required>
                @error('current_password')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="field">
                <label for="password">New Password</label>
                <input id="password" type="password" name="password" required>
                @error('password')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="field">
                <label for="password_confirmation">Confirm New Password</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required>
            </div>

            <button type="submit">Change Password</button>
        </form>

        <p class="bottom">
            Back to <a href="{{ route('dashboard') }}">Dashboard</a>
        </p>
    </div>
</body>
</html>
