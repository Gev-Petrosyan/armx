<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf_token" content="{{csrf_token()}}">
    <link rel="stylesheet" href="{{asset("css/style.css")}}">
    <link rel="stylesheet" href="{{asset("css/showProduct.css")}}">
    <title>{{$product->name}}</title>
</head>
<body>

    <header>
        @include('layouts/navabar')
    </header>
    <main>
        <div class="product-info">
            <a href="{{asset("dashboard")}}" class="close">
                <img src="{{asset("images/X.png")}}" alt="">
            </a>
            <div class="product-images">
                <div class="product-image-one">
                    @if (isset($product->images[0]->image) && file_exists(public_path() . "/storage/product/" . $product->images[0]->image))
                        <img src="{{asset("storage/product/" . $product->images[0]->image)}}" alt="image">
                    @else
                        <svg class="bd-placeholder-img card-img-top" width="100%" height="180" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#868e96"></rect></svg>
                    @endif
                </div>
                <div class="product-image-two">
                    @foreach ($product->images as $image)
                        @if (isset($image->image) && file_exists(public_path() . "/storage/product/" . $image->image))
                            <img src="{{asset("storage/product/" . $image->image)}}" alt="image">
                        @else
                            <svg class="bd-placeholder-img card-img-top" width="100%" height="180" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#868e96"></rect></svg>
                        @endif
                    @endforeach
                </div>
            </div>
            <div class="product-information">
                <h2 class="title">{{$product->name}}</h2>
                <p class="description-title">Описание</p>
                <p class="description-text">{{$product->description}}</p>
                <p class="price">{{$product->price}} ₽/м³</p>

                <div class="footer-block">
                    <p class="category">{{$product->category}}</p>
                    <p class="footer">Город: 
                        @if ($product->city->city)
                            {{$product->city->city}}
                        @else
                            Не указан
                        @endif
                    </p>
                    <p class="footer">Контакты: 
                        @if ($product->city->phone)
                            {{$product->city->phone}}
                        @else
                            Не указан
                        @endif
                    </p>
                </div>
            </div>
        </div>
    </main>

    <script src="{{asset("js/slide.js")}}"></script>
</body> 
</html>