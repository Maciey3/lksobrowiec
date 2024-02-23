@extends('layouts.admin.main')

@section('content')
    <div class="w-4/5 m-auto">  
        <div class="m-auto w-4/5 flex justify-between">
            <form action="{{route('player.index')}}" method="GET">
                <input class="w-64 h-9 px-4 border border-gray-300 rounded-sm input-shadow text-left font-bold placeholder:font-normal" type="text" placeholder="Szukaj" name="search" id="search" value="{{$search}}">
            </form>
            <a href="{{route('player.new')}}">
                <button class="h-9 px-4 rounded-xl bg-green-500 text-white font-bold">
                    Dodaj
                </button>
            </a>
        </div>
        <h1 class="small-shadow rounded-xl w-64 mt-6 mb-4 bg-white m-auto text-center font-bold text-xl py-4 underline decoration-2 decoration-green-500">
            Aktywni zawodnicy
        <h1>
        {{-- <input class="w-1/6 input-shadow" type="text" id="search"/> --}}
        

        <div class="m-auto w-4/5 grid grid-cols-1 gap-4 justify-items-center">
            @forelse ($playersActive as $player)
                <div class="w-full small-shadow rounded-xl bg-[#ffffffdd] hover:bg-[#eeeeeedd] h-10 flex justify-between items-center px-10">
                    <p class="font-bold">
                        {{$player->name}}
                    </p>
                    <div class="flex gap-2">
                        <a href="{{route('player.show', ['id' => $player->id])}}" class="hover:text-sky-500">
                            <i class="text-xl fa-solid fa-pen-to-square"></i>
                        </a>
                    </div>
                </div>
            @empty
                Brak
            @endforelse
            {{ $playersActive->links() }}
        </div>

        <h1 class="small-shadow rounded-xl w-64 mt-12 mb-4 bg-white m-auto text-center font-bold text-xl py-4 underline decoration-2 decoration-red-500">
            Niekatywni zawodnicy
        <h1>
        
        <div class="m-auto w-4/5 grid grid-cols-1 gap-4 justify-items-center">
            @if(count($playersUnactive))
                {{-- <div class="flex w-full justify-between">
                    <input before="x" class="w-64 h-9 px-4 border border-gray-300 rounded-sm input-shadow text-left font-bold placeholder:font-normal" type="text" placeholder="Szukaj" id="search">
                </div> --}}
            @endif
            @forelse ($playersUnactive as $player)
                <div class="w-full small-shadow rounded-xl bg-[#eaeaeadd] hover:bg-[#eeeeeedd] h-10 flex justify-between items-center px-10">
                    <p class="font-bold">
                        {{$player->name}}
                    </p>
                    <div class="flex gap-2">
                        <a href="{{route('player.show', ['id' => $player->id])}}" class="hover:text-sky-500">
                            <i class="text-xl fa-solid fa-pen-to-square"></i>
                        </a>
                    </div>
                </div>
            @empty
                Brak
            @endforelse
            {{ $playersUnactive->links() }}
        </div>

    </div>
    {{-- <a class="contents" href="{{route('player.new')}}">
        <button class="m-auto block w-10 h-10 rounded-full bg-green-500 text-xl text-white font-bold">
            +
        </button>
    </a>
    <h1 class="small-shadow rounded-xl w-64 mt-6 mb-4 bg-white m-auto text-center font-bold text-xl py-4 underline decoration-2 decoration-green-500">Aktywni gracze<h1>
    <div class="max-h-[30rem] overflow-auto">
        @forelse ($playersActive as $player)
            <div class="border-2 border-black bg-[#ffffffdd] hover:bg-[#eeeeeedd] h-10 flex justify-between items-center px-10 my-2 ">
                <p class="font-bold">{{$player->name}}</p>
                <div>
                    <a class="hover:text-sky-500" href="{{route('player.show', ['id'=>$player->id])}}">
                        <i class="text-xl fa-solid fa-pen-to-square"></i>
                    </a>
                </div>
            </div>
        @empty
            Brak
        @endforelse
    </div>

    <h1 class="small-shadow rounded-xl w-64 mt-10 mb-4 bg-white m-auto text-center font-bold text-xl py-4 underline decoration-2 decoration-red-500">Nieaktywni gracze<h1>
        <div class="max-h-[9rem] overflow-auto">
            @forelse ($playersUnactive as $player)
                <div class="border-2 border-black bg-[#d7d7d7dd] hover:bg-[#b4b4b4dd] h-10 flex justify-between items-center px-10 my-2 ">
                    <p class="font-bold">{{$player->name}}</p>
                    <div>
                        <a class="hover:text-sky-500" href="{{route('player.show', ['id'=>$player->id])}}">
                            <i class="text-xl fa-solid fa-pen-to-square"></i>
                        </a>
                    </div>
                </div>
            @empty
                Brak
            @endforelse
        </div> --}}
@endsection