<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset("css/style.css")}}">
    <link rel="stylesheet" href="{{asset("css/auth.css")}}">
    <title>Forgot Password</title>
</head>
<body>
    
    <header>
        @include('layouts/navabar')
    </header>
    <main>
        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <h2>Забыли пароль?</h2>
            <input type="email" name="email" value="{{old("email")}}" placeholder="Почта" required>
            <button type="submit">Сбросить пароль</button>
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