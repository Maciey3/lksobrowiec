@extends('layouts.admin.main')

@section('content')
    <h1 class="small-shadow rounded-xl w-64 mt-6 mb-4 bg-white m-auto text-center font-bold text-xl py-4 underline decoration-2 decoration-green-500">Dodaj sezon<h1>
    <div class="w-3/5 grid grid-cols-1 gap-8 m-auto justify-center justify-items-center border-2 border-black bg-[#ffffffdd] py-8 px-10 my-2">
        <form class="contents" action="{{route('match.markSeasonsLabels')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <input class="w-64 h-9 px-2 border border-gray-300 rounded-sm input-shadow" type="text" name="season" placeholder="Wpisz sezon [xxxx/xxxx]" required>
            <select class="w-64 h-9 px-2 border border-gray-300 rounded-sm input-shadow" name="label" required>
                <option class="text-gray-400" selected disabled>Wybierz klase rozgrywek</option>
                <option value="aklasa">A klasa</option>
                <option value="bklasa">B klasa</option>
            </select>

            <button type="submit" class="text-white bg-green-500 rounded-xl py-2 px-4">
                Utwórz
            </button>
        </form>
    </div>
@endsection

{{-- @section('scripts')
    <script>
        new TomSelect('#select-homeTeam',{
            create: true,
        });

        new TomSelect('#select-awayTeam',{
            create: true,
        });
    </script>

@endsection --}}