@extends('layouts.admin.main')

@section('content')
    <div class="w-2/5 m-auto">
        <a class="contents" href="{{route('player.new')}}">
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
            </div>

    </div>
@endsection