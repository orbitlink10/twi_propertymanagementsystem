<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login | Tiwi PMS</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            font-family: "Plus Jakarta Sans", sans-serif;
            background: radial-gradient(circle at top right, rgba(14, 135, 67, 0.16), transparent 42%), #f1f6f2;
            color: #10233b;
        }

        .container {
            min-height: 100vh;
            display: grid;
            place-items: center;
            padding: 1rem;
        }

        .panel {
            width: min(460px, 100%);
            background: #fff;
            border: 1px solid #d9e7dc;
            border-radius: 20px;
            padding: 1.4rem;
            box-shadow: 0 22px 40px rgba(16, 44, 31, 0.12);
        }

        h1 {
            margin: 0;
            font-size: 1.55rem;
        }

        p {
            margin: 0.5rem 0 1.2rem;
            color: #4f647f;
            line-height: 1.55;
        }

        label {
            display: block;
            margin-bottom: 0.32rem;
            font-weight: 700;
            font-size: 0.92rem;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            border: 1px solid #ccdccc;
            border-radius: 10px;
            padding: 0.78rem 0.9rem;
            font: inherit;
            margin-bottom: 0.8rem;
        }

        .check {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin: 0.3rem 0 1rem;
            color: #4f647f;
            font-weight: 600;
        }

        .btn {
            width: 100%;
            border: none;
            border-radius: 999px;
            padding: 0.82rem 1rem;
            font: inherit;
            font-weight: 800;
            color: #fff;
            background: linear-gradient(135deg, #0e8743, #0a6b35);
            cursor: pointer;
        }

        .error {
            margin: 0 0 0.9rem;
            background: #fce7e7;
            border: 1px solid #f4c8c8;
            color: #8f2b2b;
            border-radius: 10px;
            padding: 0.65rem 0.8rem;
            font-weight: 600;
        }

        .help {
            margin-top: 1rem;
            font-size: 0.9rem;
        }

        a {
            color: #0e8743;
            text-decoration: none;
            font-weight: 700;
        }
    </style>
</head>
<body>
    <div class="container">
        <section class="panel">
            <h1>Admin Sign In</h1>
            <p>Use your Tiwi Property Management admin credentials to access the dashboard.</p>

            @if ($errors->any())
                <div class="error">{{ $errors->first() }}</div>
            @endif

            <form method="POST" action="{{ route('admin.login.submit') }}">
                @csrf
                <label for="email">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>

                <label for="password">Password</label>
                <input id="password" type="password" name="password" required>

                <label class="check">
                    <input type="checkbox" name="remember">
                    Keep me signed in
                </label>

                <button class="btn" type="submit">Login to Dashboard</button>
            </form>

            <p class="help">Back to <a href="{{ route('home') }}">homepage</a>.</p>
        </section>
    </div>
</body>
</html>
