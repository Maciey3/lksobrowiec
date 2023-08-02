@extends('layouts.admin.main')

@section('content')
    <div class="w-2/5 m-auto">
        <a class="contents" href="{{route('team.create')}}">
            <button class="m-auto block w-10 h-10 rounded-full bg-green-500 text-xl text-white font-bold">
                +
            </button>
        </a>
        <h1 class="small-shadow rounded-xl w-64 mt-6 mb-4 bg-white m-auto text-center font-bold text-xl py-4 underline decoration-2 decoration-green-500">Drużyny<h1>
        <div class="max-h-[30rem] overflow-auto">
            @forelse ($teams as $team)
                <div class="border-2 border-black bg-[#ffffffdd] hover:bg-[#eeeeeedd] h-10 flex justify-between items-center px-10 my-2 ">
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
        </div>
    </div>
@endsection