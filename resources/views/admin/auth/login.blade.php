<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Giriş – Albus Production</title>
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Inter', -apple-system, sans-serif;
            background: #12102a;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-card {
            background: #fff;
            border-radius: 16px;
            padding: 48px;
            width: 100%;
            max-width: 420px;
        }
        .login-logo {
            font-size: 24px;
            font-weight: 700;
            color: #111;
            text-align: center;
            margin-bottom: 8px;
        }
        .login-logo span { color: #E8001C; }
        .login-sub {
            text-align: center;
            font-size: 13px;
            color: #999;
            margin-bottom: 36px;
        }
        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; font-size: 13px; font-weight: 500; color: #444; margin-bottom: 6px; }
        .form-group input {
            width: 100%;
            padding: 12px 14px;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            font-size: 15px;
            outline: none;
            transition: border-color 0.2s;
        }
        .form-group input:focus { border-color: #111; }
        .btn-login {
            width: 100%;
            padding: 13px;
            background: #E8001C;
            color: #fff;
            border: none;
            border-radius: 8px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: opacity 0.2s;
            margin-top: 8px;
        }
        .btn-login:hover { opacity: 0.85; }
        .alert-error {
            background: #fef2f2;
            border: 1px solid #fca5a5;
            color: #dc2626;
            padding: 12px 16px;
            border-radius: 8px;
            font-size: 14px;
            margin-bottom: 20px;
        }
        .remember-row {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 16px;
        }
        .remember-row label { font-size: 13px; color: #555; margin: 0; }
        .back-link {
            display: block;
            text-align: center;
            margin-top: 20px;
            font-size: 13px;
            color: #999;
            text-decoration: none;
        }
        .back-link:hover { color: #111; }
    </style>
</head>
<body>
    <div class="login-card">
        <div class="login-logo">—<span>A</span>LBUS</div>
        <div class="login-sub">Admin Paneli</div>

        @if($errors->any())
        <div class="alert-error">
            @foreach($errors->all() as $error)
                {{ $error }}
            @endforeach
        </div>
        @endif

        @if(session('error'))
        <div class="alert-error">{{ session('error') }}</div>
        @endif

        <form action="{{ route('admin.login.post') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="email">E-posta</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus placeholder="admin@albusproduction.com">
            </div>
            <div class="form-group">
                <label for="password">Şifre</label>
                <input type="password" id="password" name="password" required placeholder="••••••••">
            </div>
            <div class="remember-row">
                <input type="checkbox" id="remember" name="remember" value="1">
                <label for="remember">Beni hatırla</label>
            </div>
            <button type="submit" class="btn-login">Giriş Yap →</button>
        </form>
        <a href="{{ route('home') }}" class="back-link">← Siteye dön</a>
    </div>
</body>
</html>
