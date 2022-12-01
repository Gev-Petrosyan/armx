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
    <title>Company Settings</title>
</head>
<body>
    
    <header>
        @include('layouts/navabar')
    </header>
    <main>
        <div class="links-group">
            <a href="#" class="active">Мои товары</a>
            <a href="{{route("settings")}}">Настройки компании</a>
        </div>
        <div class="best-goods">
            <div class="products">
                @php
                    $city = Auth::user()->city;
                @endphp
                @if (count(Auth::user()->products))
                    <style>.product{height:370px!important}@media(max-width:1141px){.product{width:48%!important}}@media(max-width:630px){.product{width:100%!important;height:auto!important}}</style>
                    @foreach (Auth::user()->products as $product)
                        <div class="product">
                            <a href="{{route("productShow", $product->id)}}" class="image">
                                @if (isset($product->images[0]->image) && file_exists(public_path() . "/storage/product/" . $product->images[0]->image))
                                    <img src="{{asset("storage/product/" . $product->images[0]->image)}}" alt="image">
                                @else
                                    <svg class="bd-placeholder-img card-img-top" width="100%" height="180" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#868e96"></rect></svg>
                                @endif
                            </a>
                            <div class="text">
                                <h4>{{$product->name}}</h4>
                                <p>{{$product->category}}</p>
                                <i>
                                    @if ($city)
                                        {{$city}}
                                    @else
                                        Не указан
                                    @endif
                                </i>
                                <h5>{{$product->price}} ₽/м³</h5>
                                <div class="actions" id="{{"$product->id"}}">
                                    <a href="{{route("productEdit", $product->id)}}" class="edit">
                                        <img src="{{asset("images/edit.png")}}" alt="action">
                                    </a>
                                    <button type="button" class="delete">
                                        <img src="{{asset("images/x2.png")}}" alt="action">
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
                <a href="#add-new-product" id="add-new-product-alert" class="product alert">
                    <div class="image">
                        <img src="https://www.computerhope.com/jargon/p/plus.png" style="width: 75px; height: auto" alt="image">
                    </div>
                    <div class="text">
                        <h4>Добавить товар</h4>
                    </div>
                </a>
            </div>
        </div>
        <div class="company-info">
            <form id="add-new-product" method="POST" action="{{route("productCreate")}}" enctype="multipart/form-data">
                @csrf
                <div class="product-image">
                    <label class="input-logo" for="product_image" tabIndex="0" style="margin-bottom: 25px">
                        <img src="{{asset("images/camera-create.png")}}" id="product_img" alt="img">
                        <input type="file" id="product_image" name="images[]" accept="image/jpg, image/jpeg, image/png" multiple required>
                    </label>
                    @if ($errors)
                        <div class="errors" style="margin-bottom: 5px">
                            @foreach ($errors->all() as $error)
                                <p style="margin-bottom: 1px; font-size: 14px">{{$error}}</p>
                            @endforeach
                        </div>
                    @endif
                    <button type="submit" style="margin-top: 25px">Добавить товар</button>
                </div>
                <div class="product-inputs">
                    <div class="input-group">
                        <label for="name">Название товара</label>
                        <input type="name" id="name" name="name" value="{{old("name")}}" required>
                    </div>
                    <div class="input-group">
                        <label for="subcategory">Категория</label>
                        <select id="subcategory" class="form-select" name="subcategory" aria-label="Default select example" required>
                            <option value="" selected></option>
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
                        <label for="category">Подкатегории</label>
                        <select id="category" class="form-select" name="category" aria-label="Default select example" required>
                            <option value="" selected>Выберите категорию для начало</option>
                        </select>
                    </div>
                    <div class="input-group">
                        <label for="price">Цена</label>
                        <input type="number" id="price" name="price" value="{{old("price")}}" required>
                    </div>
                    <div class="input-group">
                        <label for="description">Описание</label>
                        <textarea name="description" id="description" maxlength="500" style="margin-top: 10px" onkeyup="textAreaAdjust(this)" required>{{old("description")}}</textarea>
                    </div>
                </div>
            </form>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <script src="{{asset("js/subcategory.js")}}"></script>
    <script src="{{asset("js/add_products.js")}}"></script>
</body> 
</html>