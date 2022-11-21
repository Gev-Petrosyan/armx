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
    <title>Add company</title>
</head>
<body>
    
    <header>
        @include('layouts/navabar')
    </header>
    <main>
        <div class="links-group">
            <a href="{{route("adminIndex")}}" class="active">компании</a>
            <a href="{{route("adminProducts")}}">товары</a>
            <a href="{{route("adminCity")}}">города</a>
            <a href="{{route("adminCategory")}}">категории</a>
        </div>
        <div class="company-info">
            <form id="editProfileForm" method="POST" action="{{route("createCompany")}}" enctype="multipart/form-data">
                @csrf
                <div class="input-group">
                    <label for="name">Название компнаии</label>
                    <input type="text" id="name" name="name" value="{{old("name")}}" required>
                </div>
                <div class="input-group">
                    <label for="city">Город компнаии</label>
                    <input type="text" id="city" name="city" value="{{old("city")}}">
                </div>
                <div class="input-group">
                    <label for="address">Адресс компнаии</label>
                    <input type="text" id="address" name="address" value="{{old("address")}}">
                </div>
                <div class="input-group">
                    <label for="phone">Телефон</label>
                    <input type="text" id="phone" name="phone" value="{{old("phone")}}" required>
                </div>
                <div class="input-group">
                    <label for="email">Почта</label>
                    <input type="email" id="email" name="email" value="{{old("email")}}" required>
                </div>
                <div class="input-group login">
                    <label for="login">Логин</label>
                    <input type="text" id="login" name="login" value="{{old("login")}}" required>
                </div>
                <div class="input-group">
                    <label for="name">Пароль</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <div class="input-group about_us">
                    <label for="about_us">О компнаии</label>
                    <textarea name="about_us" maxlength="1000" style="margin-top: 10px" onkeyup="textAreaAdjust(this)" id="about_us">{{old("about_us")}}</textarea>
                </div>

                <div class="company-image-title">
                    <h3>Логотип компнии</h3>
                    <h3>Фото компании</h3>
                </div>
                <div class="company-image">
                    <div class="logo">
                        <label class="input-logo" for="logoInput" tabIndex="0">
                            <img src="{{asset("images/camera-create.png")}}" id="logoImage" alt="img">   
                            <input type="file" id="logoInput" name="logo" accept="image/jpg, image/jpeg, image/png">
                        </label>
                    </div>
                    <div class="image">
                        <label class="input-logo" for="image1" tabIndex="0">
                            <img src="{{asset("images/camera-create.png")}}" id="image1img" alt="img">
                            <input type="file" id="image1" name="images[]" accept="image/jpg, image/jpeg, image/png">
                        </label>
                        <label class="input-logo" for="image2" tabIndex="0">
                            <img src="{{asset("images/camera-create.png")}}" id="image2img" alt="img">
                            <input type="file" id="image2" name="images[]" accept="image/jpg, image/jpeg, image/png">
                        </label>
                        <label class="input-logo" for="image3" tabIndex="0">
                            <img src="{{asset("images/camera-create.png")}}" id="image3img" alt="img">
                            <input type="file" id="image3" name="images[]" accept="image/jpg, image/jpeg, image/png">
                        </label>
                        <label class="input-logo" for="image4" tabIndex="0">
                            <img src="{{asset("images/camera-create.png")}}" id="image4img" alt="img">
                            <input type="file" id="image4" name="images[]" accept="image/jpg, image/jpeg, image/png">
                        </label>
                    </div>
                </div>
                <button type="submit" id="submitForm">Добавить</button>
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