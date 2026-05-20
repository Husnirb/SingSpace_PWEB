<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SingSpace</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body { background-color: #0f172a; color: #fff; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; display: flex; justify-content: center; align-items: center; min-height: 100vh; margin: 0; }
        .auth-card { background-color: #1e293b; border: 1px solid #334155; border-radius: 16px; padding: 40px; width: 100%; max-width: 400px; box-shadow: 0 15px 35px rgba(0,0,0,0.4); }
        .auth-header { text-align: center; margin-bottom: 30px; }
        .auth-header h1 { color: #f97316; margin: 0; font-size: 32px; font-weight: 800; letter-spacing: 1px; }
        .auth-header span { color: #fff; }
        .auth-header p { color: #94a3b8; font-size: 14px; margin-top: 8px; }
        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; margin-bottom: 8px; color: #cbd5e1; font-size: 13px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; }
        .form-control { width: 100%; padding: 14px; border-radius: 10px; background-color: #0f172a; border: 1px solid #334155; color: #fff; box-sizing: border-box; font-size: 15px; transition: all 0.3s; }
        .form-control:focus { outline: none; border-color: #f97316; box-shadow: 0 0 0 2px rgba(249, 115, 22, 0.2); }
        .btn-submit { width: 100%; padding: 14px; border-radius: 10px; background-color: #f97316; color: #fff; border: none; font-weight: bold; font-size: 16px; cursor: pointer; transition: 0.3s; margin-top: 10px; }
        .btn-submit:hover { background-color: #ea580c; transform: translateY(-2px); }
        .auth-links { text-align: center; margin-top: 25px; font-size: 14px; color: #94a3b8; }
        .auth-links a { color: #f97316; text-decoration: none; font-weight: 600; transition: 0.3s; }
        .auth-links a:hover { color: #fb923c; }
        .text-danger { color: #ef4444; font-size: 12px; margin-top: 5px; display: block;}
    </style>
</head>
<body>

    <div class="auth-card">
        <div class="auth-header">
            <h1>Sing<span>Space</span></h1>
            <p>Selamat datang kembali, silakan masuk.</p>
        </div>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-group">
                <label for="email">Email Address</label>
                <input id="email" type="email" name="email" class="form-control" value="{{ old('email') }}" required autofocus autocomplete="username" placeholder="Masukkan email...">
                @error('email') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input id="password" type="password" name="password" class="form-control" required autocomplete="current-password" placeholder="Masukkan password...">
                @error('password') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="form-group" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px;">
                <label for="remember_me" style="margin-bottom: 0; display: flex; align-items: center; cursor: pointer; text-transform: none; letter-spacing: normal;">
                    <input id="remember_me" type="checkbox" name="remember" style="margin-right: 8px; accent-color: #f97316;">
                    <span style="color: #94a3b8;">Ingat Saya</span>
                </label>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" style="color: #f97316; font-size: 13px; text-decoration: none;">Lupa password?</a>
                @endif
            </div>

            <button type="submit" class="btn-submit">
                <i class="fa-solid fa-right-to-bracket" style="margin-right: 5px;"></i> Log In
            </button>
        </form>

        <div class="auth-links">
            Belum punya akun? <a href="{{ route('register') }}">Daftar di sini</a>
        </div>
    </div>

</body>
</html>
