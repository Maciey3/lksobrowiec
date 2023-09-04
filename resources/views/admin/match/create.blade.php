@extends('layouts.admin.main')

@section('content')
    <h1 class="small-shadow rounded-xl w-64 mt-6 mb-4 bg-white m-auto text-center font-bold text-xl py-4 underline decoration-2 decoration-green-500">Dodaj mecz<h1>
    <div class="w-3/5 grid grid-cols-1 gap-8 m-auto justify-center justify-items-center border-2 border-black bg-[#ffffffdd] py-8 px-10 my-2">
        <form class="contents" action="{{route('match.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="w-full flex justify-evenly gap-12">
                <img class="w-20" src="{{asset('storage/default-team.png')}}" />
                <img class="w-20" src="{{asset('storage/default-team.png')}}" />
            </div>
            <div class="flex gap-6">
                <select class="w-64 h-9 whitespace-nowrap input-shadow" id="select-homeTeam" placeholder="Wybierz drużynę gospodarzy" name="homeTeam" required>
                    <option></option>
                    @foreach ($teams as $team)
                        <option value='{{$team->name}}'>{{$team->name}}</option>
                    @endforeach
                </select>

                <select class="w-64 h-9 whitespace-nowrap input-shadow" id="select-awayTeam" placeholder="Wybierz drużynę gości" name="awayTeam" required>
                    <option></option>
                    @foreach ($teams as $team)
                        <option value='{{$team->name}}'>{{$team->name}}</option>
                    @endforeach
                </select>
            </div>

            <select class="w-64 h-9 px-2 border border-gray-300 rounded-sm input-shadow" name="type" required>
                <option class="text-gray-400" selected disabled>Wybierz rodzaj meczu</option>
                <option value="sparing">Sparing</option>
                <option value="puchar">Puchar</option>
                <option value="liga">Liga</option>
            </select>

            <input class="w-64 h-9 px-2 border border-gray-300 rounded-sm input-shadow" type="date" name="date" required>

            <input class="w-64 h-9 px-2 border border-gray-300 rounded-sm input-shadow" type="time" name="time" required>

            <button type="submit" class="text-white bg-green-500 rounded-xl py-2 px-4">
                Utwórz
            </button>
        </form>
    </div>
@endsection

@section('scripts')
    <script>
        new TomSelect('#select-homeTeam',{
            create: true,
        });

        new TomSelect('#select-awayTeam',{
            create: true,
        });
    </script>

@endsection