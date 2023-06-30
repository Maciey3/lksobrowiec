@extends('layouts.admin.main')

@section('content')
    <div class="w-2/5 m-auto">
        @forelse ($players as $player)
            <div class="border-2 border-black bg-[#ffffffdd] hover:bg-[#eeeeeedd] h-10 flex justify-between items-center px-10 my-2 ">
                <p class="font-bold">{{$player->name}}</p>
                <div>
                    <a href="{{route('player.show', ['id'=>$player->id])}}">
                        <i class="text-xl fa-solid fa-pen-to-square"></i>
                    </a>
                </div>
            </div>
        @empty
            Brak
        @endforelse
    </div>
@endsection