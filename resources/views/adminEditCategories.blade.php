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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset("css/product.css")}}">
    <title>Editig "{{$category->category}}"</title>
</head>
<body>
    
    <header>
        @include('layouts/navabar')
    </header>
    <main>
        <div class="links-group">
            <a href="{{route("adminIndex")}}">компании</a>
            <a href="{{route("adminProducts")}}">товары</a>
            <a href="{{route("adminCity")}}">города</a>
            <a href="{{route("adminCategory")}}" class="active">категории</a>
        </div>
        <div class="company-info">
            <form method="POST" action="{{route("updateCategory")}}" enctype="multipart/form-data" style="display:flex">
                @csrf
                <input type="hidden" name="id" value="{{$category->id}}" required>
                <div class="product-image">
                    <label class="input-logo" for="product_image" tabIndex="0" style="margin-bottom: 25px">
                        @if ($category->image)
                            <img src="{{asset("storage/category/" . $category->image)}}" style="width: 100%" id="product_img" alt="img">    
                        @else
                            <img src="{{asset("images/camera-create.png")}}" id="product_img" alt="img">    
                        @endif
                        <input type="file" id="product_image" name="image" accept="image/jpg, image/jpeg, image/png">
                    </label>
                    @if ($errors)
                        <div class="errors" style="margin-bottom: 5px">
                            @foreach ($errors->all() as $error)
                                <p style="margin-bottom: 1px; font-size: 14px">{{$error}}</p>
                            @endforeach
                        </div>
                    @endif
                    <button type="submit" style="margin-top: 25px">Подтвердить изменения</button>
                </div>
                <div class="product-inputs">
                    <div class="input-group">
                        <label for="name">Название категории</label>
                        <input type="name" id="category" name="category" value="{{$category->category}}" required>
                    </div>
                    <div class="input-group">
                        <label for="name">Название города</label>
                        <input type="name" id="type" name="type" value="{{$category->type}}">
                    </div>
                </div>
            </form>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <script src="{{asset("js/add_products.js")}}"></script>
</body> 
</html>