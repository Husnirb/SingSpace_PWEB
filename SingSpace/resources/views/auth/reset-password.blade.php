<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - SingSpace</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        /* Background Utama: Pakai foto landing page dengan overlay gelap estetik */
        body {
            margin: 0;
            padding: 0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #0f172a;
            background-image: linear-gradient(rgba(15, 23, 42, 0.8), rgba(15, 23, 42, 0.8)), url('{{ asset('img/landing-page.jpg') }}');
            background-size: cover;
            background-position: center;
            font-family: 'Figtree', sans-serif;
        }

        /* Kotak Glassmorphism Premium */
        .auth-card {
            background: rgba(30, 41, 59, 0.7);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 24px;
            padding: 3rem 2.5rem;
            width: 90%;
            max-width: 450px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
        }

        /* Logo Text SingSpace */
        .auth-logo {
            text-align: center;
            font-size: 2.2rem;
            font-weight: 900;
            color: #ffffff;
            margin-bottom: 0.2rem;
            letter-spacing: -0.5px;
        }
        .auth-logo span { color: #f97316; }

        .auth-subtitle {
            text-align: center;
            color: #94a3b8;
            font-size: 0.95rem;
            margin-bottom: 2.5rem;
        }

        /* Styling Input Form */
        .input-group { margin-bottom: 1.5rem; }
        .input-group label {
            display: block;
            color: #cbd5e1;
            font-size: 0.9rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }
        .input-group input {
            width: 100%;
            background: rgba(15, 23, 42, 0.6);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: #ffffff;
            border-radius: 12px;
            padding: 0.85rem 1rem;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            box-sizing: border-box;
        }
        .input-group input:focus {
            border-color: #f97316;
            box-shadow: 0 0 0 4px rgba(249, 115, 22, 0.15);
            outline: none;
        }

        /* Tombol Call to Action */
        .btn-glow {
            background: linear-gradient(135deg, #f97316 0%, #ea580c 100%);
            border: none;
            border-radius: 12px;
            color: #ffffff;
            font-weight: 700;
            font-size: 1rem;
            padding: 14px 24px;
            width: 100%;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 10px 20px rgba(249, 115, 22, 0.3);
            margin-top: 1rem;
        }
        .btn-glow:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 25px rgba(249, 115, 22, 0.4);
        }

        /* Pesan Error */
        .error-text {
            color: #ef4444;
            font-size: 0.85rem;
            margin-top: 0.5rem;
            display: block;
        }
    </style>
</head>
<body>
    <div class="auth-card">
        <div class="auth-logo">Sing<span>Space</span></div>
        <p class="auth-subtitle">Buat password baru untuk akunmu</p>

        <form method="POST" action="{{ route('password.store') }}">
            @csrf

            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <div class="input-group">
                <label for="email">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email', $request->email) }}" required autocomplete="username" readonly style="opacity: 0.6; cursor: not-allowed; pointer-events: none;">
                <x-input-error :messages="$errors->get('email')" class="error-text" />
            </div>

            <div class="input-group">
                <label for="password">Password Baru</label>
                <input id="password" type="password" name="password" required autocomplete="new-password">
                <x-input-error :messages="$errors->get('password')" class="error-text" />
            </div>

            <div class="input-group">
                <label for="password_confirmation">Konfirmasi Password Baru</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password">
                <x-input-error :messages="$errors->get('password_confirmation')" class="error-text" />
            </div>

            <button type="submit" class="btn-glow">
                <i class="fa-solid fa-lock mr-2"></i> Simpan Password Baru
            </button>
        </form>
    </div>
</body>
</html>
