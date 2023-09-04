@extends('layouts.admin.main')

@section('content')
    <h1 class="small-shadow rounded-xl w-64 mt-6 mb-4 bg-white m-auto text-center font-bold text-xl py-4 underline decoration-2 decoration-green-500">Edytuj mecz<h1>
    <div class="w-3/5 grid grid-cols-1 gap-8 m-auto justify-center justify-items-center border-2 border-black bg-[#ffffffdd] py-8 px-10 my-2">
        <form class="contents" action="{{route('match.update', ['id' => $match->id])}}" method="POST">
            @csrf
            <div class="w-full flex justify-evenly gap-12">
                <img class="w-20" src="{{asset('storage/teams/' . $match->homeTeam->image)}}" />
                <img class="w-20" src="{{asset('storage/teams/' . $match->awayTeam->image)}}" />
            </div>
            <div class="flex gap-6">
                <select class="w-64 h-9 whitespace-nowrap input-shadow" id="select-homeTeam" placeholder="Wybierz drużynę gospodarzy" name="homeTeam" required>
                    <option></option>
                    @foreach ($teams as $team)
                        <option value='{{$team->name}}'
                            @selected($match->homeTeam->name == $team->name)
                        >
                            {{$team->name}}
                        </option>
                    @endforeach
                </select>

                <select class="w-64 h-9 whitespace-nowrap input-shadow" id="select-awayTeam" placeholder="Wybierz drużynę gości" name="awayTeam" required>
                    <option></option>
                    @foreach ($teams as $team)
                    <option value='{{$team->name}}'
                        @selected($match->awayTeam->name == $team->name)
                    >
                        {{$team->name}}
                    </option>
                    @endforeach
                </select>
            </div>

            <div class="flex gap-2">
                <input class="w-16 h-9 px-2 border border-gray-300 rounded-sm input-shadow text-center" type="number" name="homeGoals" value={{$match->homeGoals}}>
                <span class="flex items-center h-9 px-2 font-bold">:</span>
                <input class="w-16 h-9 px-2 border border-gray-300 rounded-sm input-shadow text-center" type="number" name="awayGoals" value={{$match->awayGoals}}>
            </div>

            <select class="w-64 h-9 px-2 border border-gray-300 rounded-sm input-shadow text-center" name="type" required>
                <option class="text-gray-400" selected disabled>Wybierz rodzaj meczu</option>
                <option  
                @if ($match->type == 'sparing')
                    {{'selected'}}
                @endif
                value="sparing">Sparing</option>
                <option
                @if ($match->type == 'puchar')
                    {{'selected'}}
                @endif
                value="puchar">Puchar</option>
                <option
                @if ($match->type == 'liga')
                    {{'selected'}}
                @endif
                value="liga">Liga</option>
            </select>

            <input class="w-64 h-9 px-2 border border-gray-300 rounded-sm input-shadow text-center" type="date" value="{{$date['day']}}" name="date" required>

            <input class="w-64 h-9 px-2 border border-gray-300 rounded-sm input-shadow text-center" type="time" value="{{$date['time']}}" name="time" required>

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