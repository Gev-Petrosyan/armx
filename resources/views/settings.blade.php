<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf_token" content="{{csrf_token()}}">
    <link rel="stylesheet" href="{{asset("css/style.css")}}">
    <link rel="stylesheet" href="{{asset("css/auth.css")}}">
    <link rel="stylesheet" href="{{asset("css/settings.css")}}">
    <title>Company Settings</title>
</head>
<body>
    
    <header>
        @include('layouts/navabar')
    </header>
    <main>
        <div class="links-group">
            <a href="{{route("products")}}">Мои товары</a>
            <a href="#" class="active">Настройки компании</a>
        </div>
        <div class="company-info">
            <form id="editProfileForm" method="POST" action="{{route("settingsEdit")}}" enctype="multipart/form-data">
                @csrf
                <div class="input-group">
                    <label for="name">Название компнаии</label>
                    <input type="text" id="name" name="name" value="{{Auth::user()->name}}" required>
                </div>
                <div class="input-group">
                    <label for="city">Город компнаии</label>
                    <input type="text" id="city" name="city" value="{{Auth::user()->city}}">
                </div>
                <div class="input-group">
                    <label for="address">Адресс компнаии</label>
                    <input type="text" id="address" name="address" value="{{Auth::user()->address}}">
                </div>
                <div class="input-group">
                    <label for="phone">Телефон</label>
                    <input type="text" id="phone" name="phone" value="{{Auth::user()->phone}}" required>
                </div>
                <div class="input-group">
                    <label for="email">Почта</label>
                    <input type="email" id="email" name="email" value="{{Auth::user()->email}}" required>
                </div>
                <div class="input-group login">
                    <label for="login">Логин</label>
                    <input type="text" id="login" name="login" value="{{Auth::user()->login}}" required>
                </div>
                <div class="input-group">
                    <label for="name">Пароль</label>
                    <input type="password" id="password" name="password">
                </div>
                <div class="input-group about_us">
                    <label for="about_us">О компнаии</label>
                    <textarea name="about_us" maxlength="1000" style="margin-top: 10px" onkeyup="textAreaAdjust(this)" id="about_us">{{Auth::user()->about_us}}</textarea>
                </div>

                <div class="company-image-title">
                    <h3>Логотип компнии</h3>
                    <h3>Фото компании</h3>
                </div>
                <div class="company-image">
                    <div class="logo">
                        <label class="input-logo" for="logoInput" tabIndex="0">
                            @if (isset(Auth::user()->logo))
                                <img src="{{asset("storage/company/" . Auth::user()->logo)}}" style="width: 100%" id="logoImage" alt="img">    
                            @else
                                <img src="{{asset("images/camera-create.png")}}" id="logoImage" alt="img">    
                            @endif
                            <input type="file" id="logoInput" name="logo" accept="image/jpg, image/jpeg, image/png">
                        </label>
                    </div>
                    <div class="image">
                        @php
                            $length = 0;
                        @endphp
                        @for ($a = 0; $a < count(Auth::user()->images); $a++)
                            @php
                             $image = Auth::user()->images[$a];
                             $length = $a + 1;
                             $a2 = $a + 1;
                            @endphp
                            <label class="input-logo" for="{{ "image" . $a2 }}" tabIndex="0">
                                <img src="{{asset("storage/company/" . $image->image)}}" style="width: 100%; height: 100%" id="{{ "image" . $a2 . "img" }}" alt="img">
                                <input type="file" id="{{ "image" . $a2 }}" name="images[{{$a}},]" value="{{asset("storage/company/" . $image->image)}}" accept="image/jpg, image/jpeg, image/png">
                            </label>
                        @endfor
                        @for ($a = $length + 1; $a <= 4; $a++)
                            <label class="input-logo" for="{{ "image" . $a }}" tabIndex="0">
                                <img src="{{asset("images/camera-create.png")}}" id="{{ "image" . $a . "img" }}" alt="img">
                                <input type="file" id="{{ "image" . $a }}" name="images[{{$a-1}},]" accept="image/jpg, image/jpeg, image/png">
                            </label>
                        @endfor
                    </div>
                </div>
                <button type="submit" id="submitForm">Сохранить</button>
                @if ($errors)
                    <div class="errors">
                        @foreach ($errors->all() as $error)
                            <p>{{$error}}</p>
                        @endforeach
                    </div>
                @endif
            </form>
        </div>
    </main>
    <footer>
        @include("layouts/footer")
    </footer>

    <script src="{{asset("js/upload.js")}}"></script>
</body> 
</html>