<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf_token" content="{{csrf_token()}}">
    <meta name="category" content="{{isset($category) ? $category : 'all'}}">
    <link rel="stylesheet" href="{{asset("css/style.css")}}">
    <link rel="stylesheet" href="{{asset("css/dashboard.css")}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <title>Home</title>
</head>
<body>
    
    <header>
        @include('layouts/navabar')
    </header>
    <main>
        <div class="section-part-one">
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item" aria-current="page">Главная</li>
                  <li class="breadcrumb-item active" id="best-goods-title2" aria-current="page">{{(isset($category)) ? $category : 'Все товары'}}</li>
                  <li class="breadcrumb-item active" id="best-goods-titleSub" aria-current="page"></li>
                </ol>
            </nav>
            <section class="best-goods">
                <h3 id="best-goods-title">{{(isset($category)) ? $category : 'Все товары'}}</h3>
                <div class="selectors">
                    <select class="form-select form-select-sm" id="select-category" aria-label=".form-select-sm example">
                        @if (isset($category))
                            <option selected value="{{$category}}">{{$category}}</option>
                            <option value="all">Категория</option>
                        @else
                            <option selected value="all">Категория</option>
                        @endif
                        @if ($subcategories)
                            @foreach ($subcategories as $category)
                                <option value="{{$category->category}}">{{$category->category}}</option>
                            @endforeach
                        @endif
                    </select>
                    <select class="form-select form-select-sm" id="select-city" aria-label=".form-select-sm example">
                        <option selected value="all">Город</option>
                        @if ($citys)
                            @foreach ($citys as $city)
                                <div class="category-block">
                                    <option value="{{$city->city}}">{{$city->city}}</option>
                                </div>
                            @endforeach
                        @endif
                    </select>
                </div>
                <div class="buttons" id="best-goods-buttons">
                    @if (isset($subcategory))
                        <button type="button" class="active">Все</button>
                        @foreach ($subcategory as $item)
                            <button type="button" class="denied">{{$item->category}}</button>
                        @endforeach
                    @endif
                </div>
                <div class="products" id="products">
                    @if (count($products))
                        @foreach ($products as $product)
                            <a href="{{route("productShow", $product->id)}}" class="product">
                                <div class="image">
                                    @if (isset($product->images[0]->image) && file_exists(public_path() . "/storage/product/" . $product->images[0]->image))
                                        <img src="{{asset("storage/product/" . $product->images[0]->image)}}" alt="image">
                                    @else
                                        <svg class="bd-placeholder-img card-img-top" width="100%" height="180" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#868e96"></rect></svg>
                                    @endif
                                </div>
                                <div class="text">
                                    <h4>{{$product->name}}</h4>
                                    <p>{{$product->category}}</p>
                                    <i>
                                        @if ($product->city->city)
                                            {{$product->city->city}}
                                        @else
                                            Не указан
                                        @endif
                                    </i>
                                    <h5>{{$product->price}} ₽/м³</h5>
                                </div>
                            </a>
                        @endforeach
                    @endif
                </div>
                {{$products->links()}}
            </section>
            <section class="announcement">
                <div class="announcement-block">
                    <h4>Разместить обявленрие на портале као маркет</h4>
                </div>
            </section>
        </div>
        <div class="section-part-two">
            <div class="category">
                <h3>Категория</h3>
                @if ($subcategories)
                    @foreach ($subcategories as $category)
                        <div class="category-block">
                            <p class="category-name">{{$category->category}}</p>
                            <p class="length">{{$category->length}}</p>
                        </div>
                    @endforeach
                @endif
            </div>
            <div class="citys">
                <h3>Город</h3>
                @if ($citys)
                    @foreach ($citys as $city)
                        <div class="category-block">
                            <p class="category-name">{{$city->city}}</p>
                            <p class="length">{{$city->length}}</p>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </main>
    <footer>
        @include("layouts/footer")
    </footer>

    <script src="{{asset("js/product_validate.js")}}"></script>
</body> 
</html>