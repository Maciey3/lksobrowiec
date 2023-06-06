@extends('layouts.admin.main')

@section('content')

    <div class="mt-24 h-96 w-1/2 bg-[#ff000037] m-auto text-center">
        <p class="text-4xl py-8">Dodaj Strzelców</p>
        <div class="grid grid-cols-[2fr_1fr] justify-center items-center text-center gap-y-6">

           
            <select id='select-player-1' class="w-64 justify-self-end" autocomplete="off">
                <option default></option>
                <option>MACIEJ</option>
                <option>KUPKA</option>
            </select>
            <select class="w-10 ml-10">
                <option default></option>
                <option>1</option>
                <option>2</option>
            </select>
            
            <select class="w-64 justify-self-end">
                <option default></option>
                <option>MACIEJ</option>
                <option>KUPKA</option>
            </select>
            <select class="w-10 ml-10">
                <option default></option>
                <option>1</option>
                <option>2</option>
            </select>
            
            <select class="w-64 justify-self-end">
                <option default></option>
                <option>MACIEJ</option>
                <option>KUPKA</option>
            </select>
            <select class="w-10 ml-10">
                <option default></option>
                <option>1</option>
                <option>2</option>
            </select>
            
           <script>
                let a = 1;
                new TomSelect(`#select-player-${a}` ,{
                    create: false,
                    sortField: {
                        field: "text",
                        direction: "asc"
                    }
                });
           </script>
            
        </div>
    </div>
@endsection