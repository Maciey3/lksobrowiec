@extends('layouts.admin.main')

@section('content')
    <div class="w-4/5 m-auto">
        
        <h1 class="small-shadow rounded-xl w-64 mt-6 mb-4 bg-white m-auto text-center font-bold text-xl py-4 underline decoration-2 decoration-green-500">
            Mecze
        <h1>
        {{-- <input class="w-1/6 input-shadow" type="text" id="search"/> --}}
        

        <div class="m-auto w-4/5 grid grid-cols-1 gap-4 justify-items-center">
            <div class="flex w-full justify-between">
                <div>
                    <input class="w-32 h-9 px-4 border border-gray-300 rounded-sm input-shadow text-left" type="text" placeholder="Szukaj" id="search">
                    <input class="w-32 h-9 px-4 border border-gray-300 rounded-sm input-shadow text-left" type="text" placeholder="Sezon" id="searchSeason">
                </div>
                <a href="{{route('match.create')}}">
                    <button class="h-9 px-4 rounded-xl bg-green-500 text-white font-bold">
                        Dodaj
                    </button>
                </a>
            </div>
            @forelse ($matches as $match)
                <div class="w-full small-shadow rounded-xl bg-[#ffffffdd] hover:bg-[#eeeeeedd] h-10 flex justify-between items-center px-10">
                    <p class="font-bold">
                        <span
                            @class(['text-sky-500' => $match->homeTeam->name == 'LKS OBROWIEC'])
                        >
                            {{$match->homeTeam->name}}
                        </span>
                        -
                        <span
                            @class(['text-sky-500' => $match->awayTeam->name == 'LKS OBROWIEC'])
                        >
                            {{$match->awayTeam->name}}
                        </span>
                    </p>
                    <div class="flex gap-2">
                        <a href="{{route('match.editGoals', ['id' => $match->id])}}" class="hover:text-sky-500">
                            <i class='text-xl fa-solid fa-futbol'></i>
                        </a>
                        <a href="{{route('match.edit', ['id' => $match->id])}}" class="hover:text-sky-500">
                            <i class="text-xl fa-solid fa-pen-to-square"></i>
                        </a>
                    </div>
                </div>
            @empty
                Brak
            @endforelse
            {{ $matches->links() }}
        </div>
    </div>
@endsection

{{-- @section('content')
    <div class="w-2/5 m-auto">
        <a class="contents" href="{{route('match.create')}}">
            <button class="m-auto block w-10 h-10 rounded-full bg-green-500 text-xl text-white font-bold">
                +
            </button>
        </a>
        <h1 class="small-shadow rounded-xl w-64 mt-6 mb-4 bg-white m-auto text-center font-bold text-xl py-4 underline decoration-2 decoration-green-500">Mecze</h1>
        <div class="max-h-[30rem] overflow-auto">
            @forelse ($matches as $match)
                <div class="border-2 border-black bg-[#ffffffdd] hover:bg-[#eeeeeedd] h-10 flex justify-between items-center px-10 my-2 ">
                    <p class="font-bold">
                        <span
                            @class(['text-sky-500' => $match->homeTeam->name == 'LKS OBROWIEC'])
                        >
                            {{$match->homeTeam->name}}
                        </span>
                        -
                        <span
                            @class(['text-sky-500' => $match->awayTeam->name == 'LKS OBROWIEC'])
                        >
                            {{$match->awayTeam->name}}
                        </span>
                    </p>
                    <div class="flex gap-2">
                        <a href="{{route('match.editGoals', ['id' => $match->id])}}" class="hover:text-sky-500">
                            <i class='text-xl fa-solid fa-futbol'></i>
                        </a>
                        <a href="{{route('match.edit', ['id' => $match->id])}}" class="hover:text-sky-500">
                            <i class="text-xl fa-solid fa-pen-to-square"></i>
                        </a>
                    </div>
                </div>
            @empty
                Brak
            @endforelse
        </div>
    </div>
@endsection --}}