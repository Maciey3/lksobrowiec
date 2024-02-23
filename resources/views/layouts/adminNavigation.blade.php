<div class="fixed h-8 w-full top-0 left-0 px-12 flex bg-zinc-900/70 text-white items-center justify-between z-50">
    <div>
        <a class="px-2" href="{{route('home')}}"><i class="text-sm pr-1 fa-solid fa-house"></i> Strona główna</a>
        <a class="px-2" href="#"><i class="text-sm pr-1 fa-solid fa-newspaper"></i> Posty</a>
        <a class="px-2" href="#"><i class="text-sm pr-1 fa-solid fa-medal"></i> Tabela</a>
        <a class="px-2" href="{{route('player.index')}}"><i class="text-sm pr-1 fa-solid fa-users"></i> Zawodnicy</a>
        <a class="px-2" href="{{route('match.index')}}"><i class="text-sm pr-1 fa-solid fa-futbol"></i> Mecze</a>
        <a class="px-2" href="{{route('team.index')}}"><i class="text-sm pr-1 fa-solid fa-users"></i> Drużyny</a>
        <a class="px-2" href="{{route('update')}}"><i class="text-sm pr-1 fa-solid fa-download"></i></i> Uzupełnij</a>
        <a class="px-2" href="{{route('user.index')}}"><i class="text-sm pr-1 fa-solid fa-user"></i></i> Użytkownicy</a>
    </div>
    <div>
        <form class="" method="POST" action="{{ route('logout') }}">
            @csrf
            {{Auth::user()->name}}
            <p class="inline text-sm cursor-pointer text-pink-300" onclick="event.preventDefault();this.closest('form').submit();">[Wyloguj]</p>
        </form>
    </div>
</div>