<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
        :root {
            --bg: #f8fafc;
            --card: #ffffff;
            --text: #0f172a;
            --muted: #64748b;
            --primary: #14b8a6;
            --primary-dark: #0f766e;
            --danger-bg: #fee2e2;
            --danger-text: #991b1b;
            --border: #e2e8f0;
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(160deg, #ecfeff 0%, var(--bg) 45%, #f0fdfa 100%);
            color: var(--text);
            display: grid;
            place-items: center;
            padding: 24px;
        }

        .auth-card {
            width: 100%;
            max-width: 520px;
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

        .field { margin-bottom: 14px; }

        label {
            display: block;
            font-size: 0.9rem;
            margin-bottom: 6px;
            font-weight: 600;
        }

        input[type="text"],
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
            box-shadow: 0 0 0 3px rgba(20, 184, 166, 0.18);
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

        .checkbox-row {
            display: flex;
            gap: 8px;
            align-items: flex-start;
            margin: 6px 0 16px;
            color: var(--muted);
            font-size: 0.9rem;
        }

        .checkbox-row input {
            margin-top: 2px;
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
        <h1>Create Account</h1>
        <p class="sub">Register with your details to access the app.</p>

        {{-- Show all errors in same div --}}
        {{-- @if ($errors->any())
            <ul class="global-errors">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif --}}

        <form method="POST" action="{{ route('registerSave') }}">
            @csrf

            <div class="field">
                <label for="name">Full Name</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" autofocus>
                @error('name')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="field">
                <label for="email">Email Address</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}">
                @error('email')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="field">
                <label for="password">Password</label>
                <input id="password" type="password" name="password">
                @error('password')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="field">
                <label for="password_confirmation">Confirm Password</label>
                <input id="password_confirmation" type="password" name="password_confirmation">
            </div>

            <label class="checkbox-row" for="terms">
                <input id="terms" type="checkbox" name="terms" value="1" {{ old('terms') ? 'checked' : '' }}>
                <span>I agree to the terms and conditions.</span>
            </label>
            @error('terms')
                <div class="error">{{ $message }}</div>
            @enderror

            <button type="submit">Register</button>
        </form>

        <p class="bottom">
            Already have an account? <a href="{{ url('/login') }}">Login here</a>
        </p>
    </div>
</body>
</html>
