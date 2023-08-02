@extends('layouts.admin.main')

@section('content')
    <div class="w-2/5 grid grid-cols-1 gap-8 m-auto justify-items-center text-2xl border-2 border-black bg-[#ffffffdd] py-8 px-10 my-2">
        <img class="w-80 h-72" src="{{asset('storage/teams/'. $team->image)}}" alt="" />
        <p class="font-bold"><i class="fa-solid fa-id-card pr-2"></i> {{$team->name}}</p>
        <div>
            <a href="{{route('team.edit', ['id'=>$team->id])}}">
                <button type="submit" class="text-white bg-yellow-500 rounded-xl py-2 px-4 text-base">
                    Edytuj
                </button>
            </a>

            <form class="contents" action="{{route('team.delete', ['id'=>$team->id])}}" method="POST">
                @csrf
                <button class="text-white bg-red-500 rounded-xl py-2 px-4 text-base" type="submit">
                    Usuń
                </button>
            </form>

    </div>
@endsection