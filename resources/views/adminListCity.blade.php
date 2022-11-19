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
    <style>
        table img {
            height: 40px;
        }
    </style>
    <title>Admin panel</title>
</head>
<body>
    
    <header>
        @include('layouts/navabar')
    </header>
    <main>
        <div class="links-group">
            <a href="{{route("adminIndex")}}">компании</a>
            <a href="{{route("adminProducts")}}">товары</a>
            <a href="{{route("adminCity")}}" class="active">города</a>
            <a href="{{route("adminCategory")}}">категории</a>
        </div>
        <div class="company-info">
            <table class="table" style="background: #FFFFFF">
                <thead>
                  <tr>
                    <th scope="col">Название города</th>
                    <th scope="col">Род города</th>
                    <th scope="col">Фото</th>
                  </tr>
                </thead>
                <tbody>
                  @if (count($citys))
                    @foreach ($citys as $city)
                        <tr>
                            <td>{{$city->city}}</td>
                            <td>{{$city->type}}</td>
                            <td>
                                @if (isset($city->image))
                                    <td><img src="{{asset("storage/city/" . $city->image)}}" alt="image"></td>
                                @else
                                    <td>Пусто</td>
                                @endif
                            </td>
                        </tr>
                        {{-- <td><a href="#"></a></td> --}}
                    @endforeach
                  @endif
                </tbody>
              </table>
              {{$citys->links()}}
        </div>
    </main>

    <script src="{{asset("js/upload.js")}}"></script>
</body> 
</html>