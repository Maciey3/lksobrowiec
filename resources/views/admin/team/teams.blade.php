@extends('layouts.admin.main')

@section('content')
    <div class="w-4/5 m-auto">
        
        <h1 class="small-shadow rounded-xl w-64 mt-6 mb-4 bg-white m-auto text-center font-bold text-xl py-4 underline decoration-2 decoration-green-500">
            Drużyny
        <h1>
        {{-- <input class="w-1/6 input-shadow" type="text" id="search"/> --}}
        

        <div class="m-auto w-4/5 grid grid-cols-1 gap-4 justify-items-center">
            <div class="flex w-full justify-between">
                <input before="x" class="w-64 h-9 px-4 border border-gray-300 rounded-sm input-shadow text-left font-bold placeholder:font-normal" type="text" placeholder="Szukaj" id="search">
                <a href="{{route('team.create')}}">
                    <button class="h-9 px-4 rounded-xl bg-green-500 text-white font-bold">
                        Dodaj
                    </button>
                </a>
            </div>
            @forelse ($teams as $team)
                <div class="w-full small-shadow rounded-xl bg-[#ffffffdd] hover:bg-[#eeeeeedd] h-10 flex justify-between items-center px-10">
                    <p class="font-bold">
                        {{$team->name}}
                    </p>
                    <div class="flex gap-2">
                        <a href="{{route('team.show', ['id' => $team->id])}}" class="hover:text-sky-500">
                            <i class="text-xl fa-solid fa-pen-to-square"></i>
                        </a>
                    </div>
                </div>
            @empty
                Brak
            @endforelse
            {{ $teams->links() }}
        </div>
    </div>
@endsection