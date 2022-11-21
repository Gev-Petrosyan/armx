<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf_token" content="{{csrf_token()}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset("css/style.css")}}">
    <link rel="stylesheet" href="{{asset("css/auth.css")}}">
    <link rel="stylesheet" href="{{asset("css/settings.css")}}">
    <link rel="stylesheet" href="{{asset("css/adminListLayout.css")}}">
    <title>Admin panel</title>
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
            <table class="table table-bordered" style="background: #FFFFFF">
                <thead>
                  <tr>
                    <th scope="col">Название</th>
                    <th scope="col">компания</th>
                    <th scope="col">категория</th>
                    <th scope="col">описание</th>
                    <th scope="col">цена</th>
                    <th scope="col">Фото1</th>
                    <th scope="col">Фото2</th>
                    <th scope="col">Фото3</th>
                    <th scope="col">Фото4</th>
                    <th scope="col">действие</th>
                  </tr>
                </thead>
                <tbody>
                  @if (count($products))
                    @foreach ($products as $product)
                        <tr>
                            <td>{{$product->name}}</td>
                            <td>{{$product->city->name}}</td>
                            <td>{{$product->category}}</td>
                            <td>{{$product->description}}</td>
                            <td>{{$product->price}}</td>
                                @for ($i = 0; $i < 4; $i++)
                                    @if (isset($product->images[$i]))
                                        <td><img src="{{asset("storage/product/" . $product->images[$i]->image)}}" alt="image"></td>
                                    @else
                                        <td>Пусто</td>
                                    @endif
                                @endfor
                            <td>
                                <a href="{{route("editProduct", $product->id)}}" class="edit">
                                    <img src="{{asset("images/edit.png")}}" alt="action">
                                </a>
                            </td>
                        </tr>
                    @endforeach
                  @endif
                </tbody>
              </table>
              <a class="btn btn-primary mb-3" href="{{route("products")}}">Добавить</a>
              {{$products->links()}}
        </div>
    </main>

    <script src="{{asset("js/upload.js")}}"></script>
</body> 
</html>