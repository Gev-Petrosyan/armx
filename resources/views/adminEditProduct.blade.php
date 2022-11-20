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
    <title>Editig {{$product->name}}</title>
</head>
<body>
    
    <header>
        @include('layouts/navabar')
    </header>
    <main>
        <div class="links-group">
            <a href="{{route("adminIndex")}}">компании</a>
            <a href="{{route("adminProducts")}}" class="active">товары</a>
            <a href="{{route("adminCity")}}">города</a>
            <a href="{{route("adminCategory")}}">категории</a>
        </div>
        <div class="company-info">
            <form method="POST" action="{{route("productUpdate")}}" enctype="multipart/form-data" style="display:flex">
                @csrf
                <input type="hidden" name="id" value="{{$product->id}}" required>
                <div class="product-image">
                    <label class="input-logo" for="product_image" tabIndex="0" style="margin-bottom: 25px">
                        @if (isset($product->images[0]->image))
                            <img src="{{asset("storage/product/" . $product->images[0]->image)}}" style="width: 100%;height:100%" id="product_img" alt="image">
                        @else
                            <svg class="bd-placeholder-img card-img-top" width="100%" height="180" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#868e96"></rect></svg>
                        @endif
                        <input type="file" id="product_image" name="images[]" accept="image/jpg, image/jpeg, image/png" multiple>
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
                        <label for="name">Название товара</label>
                        <input type="name" id="name" name="name" value="{{$product->name}}" required>
                    </div>
                    <div class="input-group">
                        <label for="category">Категория</label>
                        <select id="category" class="form-select" name="category" aria-label="Default select example" required>
                            <option value="{{$product->category}}" selected>{{$product->category}}</option>
                            @if ($categories)
                                @foreach ($categories as $category)
                                    <div class="category-block">
                                        <option value="{{$category->category}}">{{$category->category}}</option>
                                    </div>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="input-group">
                        <label for="price">Цена</label>
                        <input type="number" id="price" name="price" value="{{$product->price}}" required>
                    </div>
                    <div class="input-group">
                        <label for="description">Описание</label>
                        <textarea name="description" id="description" maxlength="500" style="margin-top: 10px" onkeyup="textAreaAdjust(this)" required>{{$product->description}}</textarea>
                    </div>
                </div>
            </form>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <script src="{{asset("js/add_products.js")}}"></script>
</body> 
</html>