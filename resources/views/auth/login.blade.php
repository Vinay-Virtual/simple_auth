<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        :root {
            --bg: #f1f5f9;
            --card: #ffffff;
            --text: #0f172a;
            --muted: #64748b;
            --primary: #0ea5e9;
            --primary-dark: #0284c7;
            --danger-bg: #fee2e2;
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
            font-size: 1.7rem;
        }

        .sub {
            margin: 0 0 20px;
            color: var(--muted);
            font-size: 0.95rem;
        }

        .field {
            margin-bottom: 14px;
        }

        label {
            display: block;
            font-size: 0.9rem;
            margin-bottom: 6px;
            font-weight: 600;
        }

        input[type="email"],
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

        .global-errors {
            list-style: none;
            margin: 0 0 16px;
            padding: 10px 12px;
            border-radius: 10px;
            background: var(--danger-bg);
            color: var(--danger-text);
            font-size: 0.9rem;
        }

        .row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 16px;
            gap: 12px;
        }

        .remember {
            display: flex;
            align-items: center;
            gap: 8px;
            color: var(--muted);
            font-size: 0.9rem;
        }

        .remember input {
            accent-color: var(--primary);
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
        <h1>Welcome Back</h1>
        <p class="sub">Login with your registered account details.</p>

        {{-- @if ($errors->any())
            <ul class="global-errors">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif --}}
        {{-- Show Error message if credential didn't match --}}
        @error('credError')
            <div class="global-errors">
                {{ $message }}
            </div>
        @enderror

        {{-- Show Success message after registration --}}
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('loginMatch') }}">
            @csrf

            <div class="field">
                <label for="email">Email Address</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
                @error('email')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="field">
                <label for="password">Password</label>
                <input id="password" type="password" name="password" required>
                @error('password')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="row">
                <label class="remember" for="remember">
                    <input id="remember" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                    Remember me
                </label>

                <a href="{{ url('/register') }}">Create account</a>
            </div>

            <button type="submit">Login</button>
        </form>

        <p class="bottom">
            New here? <a href="{{ url('/register') }}">Register now</a>
        </p>
    </div>
</body>
</html>
