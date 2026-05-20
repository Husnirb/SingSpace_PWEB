<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - SingSpace</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body { background-color: #0f172a; color: #fff; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; display: flex; justify-content: center; align-items: center; min-height: 100vh; margin: 0; padding: 20px 0; }
        .auth-card { background-color: #1e293b; border: 1px solid #334155; border-radius: 16px; padding: 40px; width: 100%; max-width: 450px; box-shadow: 0 15px 35px rgba(0,0,0,0.4); }
        .auth-header { text-align: center; margin-bottom: 25px; }
        .auth-header h1 { color: #f97316; margin: 0; font-size: 30px; font-weight: 800; }
        .auth-header span { color: #fff; }
        .auth-header p { color: #94a3b8; font-size: 14px; margin-top: 8px; }
        .form-group { margin-bottom: 18px; }
        .form-group label { display: block; margin-bottom: 6px; color: #cbd5e1; font-size: 13px; font-weight: 600; text-transform: uppercase; }
        .form-control { width: 100%; padding: 12px; border-radius: 10px; background-color: #0f172a; border: 1px solid #334155; color: #fff; box-sizing: border-box; font-size: 15px; transition: all 0.3s; }
        .form-control:focus { outline: none; border-color: #f97316; box-shadow: 0 0 0 2px rgba(249, 115, 22, 0.2); }
        .btn-submit { width: 100%; padding: 14px; border-radius: 10px; background-color: #f97316; color: #fff; border: none; font-weight: bold; font-size: 16px; cursor: pointer; transition: 0.3s; margin-top: 10px; }
        .btn-submit:hover { background-color: #ea580c; transform: translateY(-2px); }
        .auth-links { text-align: center; margin-top: 20px; font-size: 14px; color: #94a3b8; }
        .auth-links a { color: #f97316; text-decoration: none; font-weight: 600; }
        .text-danger { color: #ef4444; font-size: 12px; margin-top: 5px; display: block;}
    </style>
</head>
<body>

    <div class="auth-card">
        <div class="auth-header">
            <h1>Sing<span>Space</span></h1>
            <p>Buat akun baru untuk mulai reservasi.</p>
        </div>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="form-group">
                <label for="name">Nama Lengkap</label>
                <input id="name" type="text" name="name" class="form-control" value="{{ old('name') }}" required autofocus placeholder="Contoh: Husni Rasyid">
                @error('name') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="email">Email Address</label>
                <input id="email" type="email" name="email" class="form-control" value="{{ old('email') }}" required placeholder="email@contoh.com">
                @error('email') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input id="password" type="password" name="password" class="form-control" required placeholder="Minimal 8 karakter">
                @error('password') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="password_confirmation">Konfirmasi Password</label>
                <input id="password_confirmation" type="password" name="password_confirmation" class="form-control" required placeholder="Ketik ulang password">
            </div>

            <button type="submit" class="btn-submit">
                <i class="fa-solid fa-user-plus" style="margin-right: 5px;"></i> Daftar Sekarang
            </button>
        </form>

        <div class="auth-links">
            Sudah punya akun? <a href="{{ route('login') }}">Masuk di sini</a>
        </div>
    </div>

</body>
</html>
