@extends('layouts.admin.main')

@section('content')
    @php
        $i = 1;
    @endphp
    {{-- @dd($match) --}}
    <h1 class="small-shadow rounded-xl w-64 mt-6 mb-6 bg-white m-auto text-center font-bold text-xl py-4 underline decoration-2 decoration-green-500">Dodaj strzelców</h1>

    <div class="w-2/5 pt-12 gap-8 m-auto justify-center justify-items-center border-2 border-black bg-[#ffffffdd] py-8 px-10 my-2 text-center">
    {{-- <div class="mt-24 pb-24 w-1/2 bg-[#c3c3c3b2] m-auto text-center"> --}}
        <div class="grid grid-cols-[2fr_1fr] justify-center justify-items-center items-center text-center gap-y-6">
            <form action="{{route('match.updateGoals', ['id' => $id])}}" id='goalsForm' class='contents' method="POST" enctype="multipart/form-data">
                @method('POST')
                @csrf
                @foreach ($goals as $goal)
                    <select id='select-player-{{$i}}' class="searchPlayer w-64 justify-self-end" autocomplete="off" name="players[]">
                        <option></option>
                        @foreach ($players as $player)
                            <option
                            @if ($goal->player->id == $player->id)
                                {{'selected'}}
                            @endif
                            >{{$player->name}}</option>
                        @endforeach
                    </select>

                    <select class="w-10 h-8 ml-10 input-shadow border-gray-300 rounded-sm" name="quantities[]">
                        <option default></option>
                        @for($j=1; $j<13; $j++)
                            <option
                            @if ($goal->quantity == $j)
                                {{'selected'}}
                            @endif
                            >{{$j}}</option>
                        @endfor
                    </select>
                    @php
                        $i++;
                    @endphp
                @endforeach
                @for($k=$i; $k<9; $k++)
                    <select id='select-player-{{$k}}' class="searchPlayer w-64 text-red-500 justify-self-end input-shadow" autocomplete="off" name="players[]">
                        <option></option>
                        @foreach ($players as $player)
                            <option>{{$player->name}}</option>
                        @endforeach
                    </select>

                    <select class="w-10 h-8 ml-10 input-shadow" name="quantities[]">
                        <option default></option>
                        @for($j=1; $j<13; $j++)
                            <option>{{$j}}</option>
                        @endfor
                    </select>
                @endfor
            </form>
        </div>
        <button onclick="document.getElementById('goalsForm').submit();" type="submit" class="text-white bg-green-500 rounded-xl py-2 px-4 mt-12">
            Zaktualizuj
        </button>
        {{-- <button  type="submit" class="mt-12 h-12 w-1/3 m-auto bg-red-300">Wykonaj<button> --}}
        {{-- <button onclick="addInput()" class="w-10 h-10 mt-10 rounded-full bg-green-500 text-xl text-white">+</button> --}}
    </div>

    <div class="w-1/3 m-auto mt-12 rounded-xl big-shadow uppercase bg-white">
        <div class="w-full flex justify-between py-2 px-4 bg-gray-200 rounded-t-xl font-bold text-left text-2xl">
            <p>&nbsp;</p>
            {{-- @auth
                <a href="{{route('match.edit', ['id' => $match->id])}}" class="hover:text-sky-400">
                    <i class="fa-solid fa-pen-to-square"></i>
                </a>
            @endauth --}}
        </div>
        <div class="w-56 relative m-auto top-12 font-bold text-md">
            {{$match->strDate['day']}},
            <span @class([
                'text-green-500' => $match->state == 'WYGRANA',
                'text-red-500' => $match->state == 'PRZEGRANA',
                'text-yellow-500' => $match->state == 'REMIS',
            ])>
            {{$match->strDate['date']}}
            </span> {{$match->strDate['time']}}
        </div>
        <div class="w-full px-4 grid grid-cols-3 justify-center items-center justify-items-center">
            <div class="w-full text-center">
                <img class="w-28 m-auto" src="{{asset('storage/' . $match->homeTeam->image)}}" />
            </div>
            <div class="text-sky-400 font-bold text-4xl self-end">
                {{$match->homeGoals}}:{{$match->awayGoals}}
            </div>
            <div class="w-full text-center">
                <img class="w-28 m-auto" src="{{asset('storage/' . $match->awayTeam->image)}}" />
            </div>
            <p class="py-4 text-xl font-bold">{{$match->homeTeam->name}}</p>
            <p @class([
                'text-xl font-bold',
                'text-green-500' => $match->state == 'WYGRANA',
                'text-red-500' => $match->state == 'PRZEGRANA',
                'text-yellow-500' => $match->state == 'REMIS',
            ])>
                {{$match->state}}
            </p>
            <p class="py-4 text-xl font-bold">{{$match->awayTeam->name}}</p>
        </div>
        <div id="lastMatchGoals" class="w-full max-h-[10.7rem] py-2 px-4 grid grid-cols-1 gap-4 bg-gray-800 rounded-b-xl font-bold text-left text-2xl overflow-y-auto scrollbar-thumb-blue-500 scrollbar-track-blue-500">
            <p class="py-1 text-white">&nbsp;</p>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        // function addInput(){
                //     let searches = document.querySelectorAll('.searchPlayer');
                //     let parent = document.getElementById('goalsForm');
                //     let select = document.getElementById('select-player-1');
                //     select.id = `select-player-${searches.length + 1}`;
                //     // console.log(select);
                //     parent.appendChild(select);
                //     init();
                // }
                // let a = 1;

        let searches = document.querySelectorAll('.searchPlayer');
        console.log(searches.length);
        for (let i = 1; i < searches.length+1; i++) {
            new TomSelect(`#select-player-${i}` ,{
                create: false,
                sortField: {
                    field: "text"
                    // direction: "asc"
                }
            });
        }
    </script>
@endsection