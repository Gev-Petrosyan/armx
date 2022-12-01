<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset("css/style.css")}}">
    <title>Welcome</title>
</head>
<body>
    
    <header>
        @include('layouts/navabar')
    </header>
    <main>
        <section class="goods-title">
            <div class="goods-title-text">
                <h2>КАО МАРКЕТ</h2>
                <p>Бизнес справочник армянской общины крыма</p>
            </div>
            <div class="goods-title-image">
                <img src="images/stock-vector-online-delivery-service-concept-online-order-tracking-can-use-for-landing-page-template-ui-1186539871.png" alt="image">
            </div>
        </section>
        <section class="popular-goods">
            @php $foreachControll = 1 @endphp
            @foreach ($categories as $category)
                @if ($foreachControll <= 3)
                    <a href="{{route("dashboardWithCategory", $category->category)}}" class="product">
                        <div class="image">
                            @if (is_string($category->image))
                                <img src="{{asset("storage/category/" . $category->image)}}" alt="image">
                            @else
                                <p>Пусто</p>
                            @endif
                        </div>
                        <div class="name">
                            <p>{{$category->category}}</p>
                        </div>
                        <div class="price">
                            <p>{{$category->type}}</p>
                        </div>
                    </a>
                @else
                    <a href="{{route("dashboardWithCategory", $category->category)}}" class="product product-style-two">
                        <div class="image">
                            @if (is_string($category->image))
                                <img src="{{asset("storage/category/" . $category->image)}}" alt="image">
                            @else
                                <p>Пусто</p>
                            @endif
                        </div>
                        <div class="name">
                            <p>{{$category->category}}</p>
                        </div>
                        <div class="price">
                            <p>{{$category->type}}</p>
                        </div>
                    </a>
                @endif
                @php $foreachControll++ @endphp
            @endforeach
        </section>
        <section class="best-goods">
        @if (count($products))
            <h3>Популярные товары</h3>
            <div class="products">
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
            </div>
        @endif
        </section>
        <section class="announcement">
            <div class="announcement-block">
                <h4>Разместить обявленрие на портале као маркет</h4>
            </div>
        </section>
    </main>
    <footer>
        @include("layouts/footer")
    </footer>

</body> 
</html>