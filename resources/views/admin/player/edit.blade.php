@extends('layouts.admin.main')

@section('content')
    <div class="w-2/5 grid grid-cols-1 gap-8 m-auto justify-items-center border-2 border-black bg-[#ffffffdd] py-8 px-10 my-2">
        <form class="contents" action="{{route('player.update', ['id' => $player->id])}}" method="POST" enctype="multipart/form-data">
            @csrf
            <img class="w-64 h-56 border-2 border-black" src="{{asset('storage/players/' . $player->image)}}" alt="" />
            <input class="w-28" type="file" name="image">
            <input class="w-1/2 h-9 px-2 border border-gray-300 rounded-sm input-shadow text-center" type="text" placeholder="Imię i nazwisko" name="name" value="{{$player->name}}" required>
            <input class="w-1/2 h-9 px-2 border border-gray-300 rounded-sm input-shadow text-center" type="date" placeholder="Data urodzin" name="birthday" value="{{$player->birthday}}" required>

            {{-- <select class="w-1/4 px-2 py-2 border-2 border-black">
                <option>Aktywny</option>
                <option>Nieaktywny</option>
            </select> --}}

            <span class="-mb-12 text-xl">Status:</span>
            <div class="flex text-gray-500">
                <div>
                    <input class="peer hidden" type="radio" id="active" name="status" value='1'
                    @checked($player->active)
                    >
                    <label class="block w-6 h-6 rounded-full outline-offset-2 bg-green-500 peer-checked:outline peer-checked:outline-2" for="active">
                        {{-- <i class="text-2xl fa-solid fa-circle peer-checked:text-green-800 text-green-500"></i> --}}
                    </label>
                </div>
                <div class="pl-6">
                    <input class="peer hidden" type="radio" id="unactive" name="status" value='0'
                    @checked(!$player->active)
                    >
                    <label class="block w-6 h-6 rounded-full outline-offset-2 bg-red-500 peer-checked:outline peer-checked:outline-2" for="unactive">
                        {{-- <i class="text-2xl fa-solid fa-circle peer-checked:text-green-800 text-green-500"></i> --}}
                    </label>
                </div>

                {{-- <label for="unactive">
                    <i class="text-2xl fa-solid fa-circle text-red-500"></i>
                </label>
                <input class="w-6 h-6" type="radio" id="unactive" name="status"> --}}
            </div>

            <button type="submit" class="text-white bg-green-500 rounded-xl py-2 px-4">
                Zaktualizuj
            </button>
        </form>
    </div>
@endsection