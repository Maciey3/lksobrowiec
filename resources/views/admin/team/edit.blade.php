@extends('layouts.admin.main')

@section('content')
    <div class="w-2/5 grid grid-cols-1 gap-8 m-auto justify-items-center border-2 border-black bg-[#ffffffdd] py-8 px-10 my-2">
        <form class="contents" action="{{route('team.update', ['id' => $team->id])}}" method="POST" enctype="multipart/form-data">
            @csrf
            <img class="w-64 h-56" src="{{asset('storage/teams/' . $team->image)}}" alt="" />
            <input class="w-28" type="file" name="image">
            <input class="w-1/2 h-9 px-2 border border-gray-300 rounded-sm input-shadow text-center" type="text" placeholder="Nazwa" name="name" value="{{$team->name}}" required>

            <button type="submit" class="text-white bg-green-500 rounded-xl py-2 px-4">
                Zaktualizuj
            </button>
        </form>
    </div>
@endsection