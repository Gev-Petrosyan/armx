<nav class="navabar">
    <a href="{{route("welcome")}}" class="logo">
        <img src="{{asset("images/group_53.png")}}" alt="logo">
    </a>
    @if (isset(Auth::user()->login))
        <div class="buttons">
            <p class="name">{{Auth::user()->login}}</p>
            <a href="{{route("settings")}}" class="button-one">Добавить компанию</a>
            @if (Auth::user()->role == "admin")
                <a href="{{route("adminIndex")}}" class="button-one">Админ панель</a>
            @endif
            <form method="POST" action="{{route("logout")}}">
                @csrf
                <button type="submit" class="button-two">Выйти</button>
            </form>
        </div>
    @else
        <div class="buttons">
            <a href="{{route("settings")}}" class="button-one">Добавить компанию</a>
            <a href="{{route("login")}}" class="button-two">Войти</a>
        </div>
    @endif
    <div class="navabar-button" id="navabarButton">
        <img src="{{asset("images/group_71.png")}}" alt="button">
    </div>
    <div class="buttons-mobile" id="navabarModel">
        @if (isset(Auth::user()->login))
            <div class="buttons">
                <p class="name">{{Auth::user()->login}}</p>
                <a href="{{route("settings")}}" class="button-one">Добавить компанию</a>
                @if (Auth::user()->role == "admin")
                    <a href="{{route("adminIndex")}}" class="button-one">Админ панель</a>
                @endif
                <form method="POST" action="{{route("logout")}}">
                    @csrf
                    <button type="submit" class="button-two">Выйти</button>
                </form>
            </div>
        @else
            <div class="buttons">
                <a href="{{route("settings")}}" class="button-one">Добавить компанию</a>
                <a href="{{route("login")}}" class="button-two">Войти</a>
            </div>
        @endif
    </div>
</nav>
<script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
<script src="{{asset("js/navabar.js")}}"></script>