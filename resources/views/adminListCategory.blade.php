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
            <a href="{{route("adminProducts")}}">товары</a>
            <a href="{{route("adminCity")}}">города</a>
            <a href="{{route("adminCategory")}}" class="active">категории</a>
        </div>
        <div class="company-info">
            <table class="table table-bordered" style="background: #FFFFFF">
                <thead>
                  <tr>
                    <th scope="col">Название категория</th>
                    <th scope="col">род категория</th>
                    <th scope="col">фото</th>
                    <th scope="col">действие</th>
                  </tr>
                </thead>
                <tbody>
                  @if (count($categories))
                    @foreach ($categories as $category)
                        <tr>
                            <td>{{$category->category}}</td>
                            <td>{{$category->type}}</td>
                            <td>
                                @if (isset($category->image))
                                    <img src="{{asset("storage/category/" . $category->image)}}" alt="image">
                                @else
                                    Пусто
                                @endif
                            </td>
                            <td>
                                <a href="{{route("editCategory", $category->id)}}" class="edit">
                                    <img src="{{asset("images/edit.png")}}" alt="action">
                                </a>
                            </td>
                        </tr>
                    @endforeach
                  @endif
                </tbody>
              </table>
              <a class="btn btn-primary mb-3" href="#">Добавить</a>
              {{$categories->links()}}
        </div>
    </main>

    <script src="{{asset("js/upload.js")}}"></script>
</body> 
</html>