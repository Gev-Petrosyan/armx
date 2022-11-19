<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/auth.css">
    <title>Login</title>
</head>
<body>
    
    <header>
        @include('layouts/navabar')
    </header>
    <main>
        <form method="POST" action="{{route("login")}}">
            @csrf
            <h2>Вход в личный кабинет</h2>
            <input type="text" name="login" value="{{old("login")}}" placeholder="Логин или почта" required>
            <input type="password" name="password" minlength="8" placeholder="Пароль" required>
            <div class="links">
                <a href="{{route("forgot-password")}}" class="forgot-password">Забыли пароль?</a>
                <a href="{{route("register")}}" class="auth">Зарегистрироваться</a>
            </div>
            <button type="submit">ВОЙТИ</button>
            @if ($errors)
                <div class="errors">
                    @foreach ($errors->all() as $error)
                        <p>{{$error}}</p>
                    @endforeach
                </div>
            @endif
        </form>
    </main>

</body>
</html>