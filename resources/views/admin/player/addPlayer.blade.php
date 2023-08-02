@extends('layouts.admin.main')

@section('content')
    <div class="w-2/5 grid grid-cols-1 gap-8 m-auto justify-items-center border-2 border-black bg-[#ffffffdd] py-8 px-10 my-2">
        <form class="contents" action="{{route('player.create')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <img class="border-2 border-black" src="{{asset('storage/players/profile.png')}}" alt="" />
            <input class="w-28" type="file" name="image">
            <input class="w-1/2 h-9 px-2 border border-gray-300 rounded-sm input-shadow text-center" type="text" placeholder="Imię i nazwisko" name="name" required>
            <input class="w-1/2 h-9 px-2 border border-gray-300 rounded-sm input-shadow text-center placeholder:text-5xl" type="date" placeholder="Data urodzin" name="birthday" required>

            <button type="submit" class="text-white bg-green-500 rounded-xl py-2 px-4">
                Utwórz
            </button>
        </form>
    </div>
@endsection