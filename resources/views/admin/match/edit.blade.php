@extends('layouts.admin.main')

@section('content')

    <div class="mt-24 pb-24 w-1/2 bg-[#c3c3c3b2] m-auto text-center">
        <p class="text-4xl py-8">Dodaj Strzelców</p>
        <div class="grid grid-cols-[3fr_2fr] justify-center items-center text-center gap-y-6">
            <form action="{{route('match.update', ['id' => $id])}}" id='goalsForm' class='contents' method="POST" enctype="multipart/form-data">
                @method('POST')
                @csrf
                @for($i=1; $i<9; $i++)
                    <select id='select-player-{{$i}}' class="searchPlayer w-64 text-red-500 justify-self-end" autocomplete="off" name="players[]">
                        <option default></option>
                        @foreach ($players as $player)
                            <option>{{$player->name}}</option>
                        @endforeach
                    </select>
                    <select class="w-10 h-8 ml-10" name="quantities[]">
                        <option default></option>
                        @for($j=1; $j<13; $j++)
                            <option>{{$j}}</option>
                        @endfor
                    </select>
                @endfor
            </form>
        </div>
        <button onclick="document.getElementById('goalsForm').submit();" type="submit" class="mt-12 h-12 w-1/3 m-auto bg-red-300">Wykonaj<button>
        {{-- <button onclick="addInput()" class="w-10 h-10 mt-10 rounded-full bg-green-500 text-xl text-white">+</button> --}}
            
            
            
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
            
        {{-- </div> --}}
    </div>
@endsection