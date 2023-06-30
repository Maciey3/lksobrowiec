@extends('layouts.admin.main')

@section('content')
    <div class="w-2/5 grid grid-cols-1 gap-8 m-auto justify-items-center text-2xl border-2 border-black bg-[#ffffffdd] py-8 px-10 my-2">
        <img class="border-2 border-black" src="{{asset('storage/profile.png')}}" alt="" />

        <p class="font-bold"><i class="fa-solid fa-id-card pr-2"></i> {{$player->name}}</p>
        <p class=""><i class="fa-solid fa-calendar-days pr-2"></i> {{$player->birthday}}</p>
        <p>Status:
            <i @class([
                'text-2xl',
                'fa-solid',
                'fa-circle',
                'text-green-500' => $player->active == 1,
                'text-red-500' => $player->active == 0,
            ])></i>
        </p>
    </div>
@endsection