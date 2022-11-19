<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset("css/style.css")}}">
    <link rel="stylesheet" href="{{asset("css/auth.css")}}">
    <title>Сброс пароля</title>
</head>
<body>
    
    <header>
        @include('layouts/navabar')
    </header>
    <main>
        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            <h2>Менять пороль</h2>
            <input type="hidden" name="token" value="{{ $request->route('token') }}">
            <input type="hidden" name="email" value="{{old('email', $request->email)}}" placeholder="Почта" required>
            <input type="password" name="password" minlength="8" placeholder="Новый пароль" required>
            <input type="password" name="password_confirmation" minlength="8" placeholder="Подтвердите новый пароль" required>
            <button type="submit">Менять пароль</button>
            @if ($errors)
                <div class="errors">
                    @foreach ($errors->all() as $error)
                        <p>{{$error}}</p>
                    @endforeach
                </div>
            @endif
            @if (session('status'))
                <div class="errors">
                    <p style="color: green">{{ session('status') }}</p>
                </div>
            @endif
        </form>
    </main>

</body>
</html>