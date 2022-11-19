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
            <a href="{{route("adminIndex")}}" class="active">компании</a>
            <a href="{{route("adminProducts")}}">товары</a>
            <a href="{{route("adminCity")}}">города</a>
            <a href="{{route("adminCategory")}}">категории</a>
        </div>
        <div class="company-info">
            <table class="table" style="background: #FFFFFF">
                <thead>
                  <tr>
                    <th scope="col">Название</th>
                    <th scope="col">город</th>
                    <th scope="col">имя</th>
                    <th scope="col">телефон</th>
                    <th scope="col">почта</th>
                    <th scope="col">активность</th>
                    <th scope="col">лого</th>
                    <th scope="col">фото1</th>
                    <th scope="col">фото2</th>
                    <th scope="col">фото3</th>
                    <th scope="col">фото4</th>
                  </tr>
                </thead>
                <tbody>
                  @if (count($companies))
                    @foreach ($companies as $company)
                        <tr>
                            <td>{{$company->name}}</td>
                            <td>{{$company->city}}</td>
                            <td>{{$company->login}}</td>
                            <td>{{$company->phone}}</td>
                            <td>{{$company->email}}</td>
                            <td>{{$company->status}}</td>
                            @if (isset($company->logo))
                                <td><img src="{{asset("storage/company/" . $company->logo)}}" alt="logo"></td>
                            @else
                                <td>Пусто</td>
                            @endif
                            @for ($i = 0; $i < 4; $i++)
                                @if (isset($company->images[$i]))
                                    <td><img src="{{asset("storage/company/" . $company->images[$i]->image)}}" alt="image"></td>
                                @else
                                    <td></td>
                                @endif
                            @endfor
                        </tr>
                        {{-- <td><a href="#"></a></td> --}}
                    @endforeach
                  @endif
                </tbody>
              </table>
              {{$companies->links()}}
        </div>
    </main>

    <script src="{{asset("js/upload.js")}}"></script>
</body> 
</html>