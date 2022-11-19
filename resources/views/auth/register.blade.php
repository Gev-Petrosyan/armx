<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset("css/style.css")}}">
    <link rel="stylesheet" href="{{asset("css/auth.css")}}">
    <title>Register</title>
</head>
<body>
    
    <header>
        @include('layouts/navabar')
    </header>
    <main>
        <form method="POST" action="{{route("register")}}">
            @csrf
            <h2>Регистарция</h2>
            <input type="text" name="name" value="{{old("name")}}" placeholder="Название компнаии" required>
            <input type="email" name="email" value="{{old("email")}}" placeholder="Почта" required>
            <input type="phone" name="phone" value="{{old("phone")}}" minlength="4" placeholder="Телефон" required>
            <input type="password" name="password" minlength="8" placeholder="Пароль" required>
            <input type="password" name="password_confirmation" minlength="8" placeholder="Подтвердите пароль" required>
            <div class="links">
                <a href="{{route("login")}}" class="auth">Вход в личный кабинет</a>
            </div>
            <button type="submit">Регистарция</button>
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