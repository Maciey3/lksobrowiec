@extends('layouts.main')

@section('bg1')
    <img class="w-full absolute z-[-1] left-0 top-[10vw] overflow-x-hidden select-none" src="{{asset('storage/bg4.png')}}"/>
@endsection

{{-- @section('bg2')
    <img class="w-full absolute z-[-2] left-0 top-[12vw] select-none" src="{{asset('storage/bg_auto_x2_cut.jpg')}}"/>
@endsection --}}

@section('content')
    {{-- <h1 class="pt-32 text-3xl font-bold uppercase">> SPONSORZY<h1> --}}
    <div class="grid pt-16 gap-24">
        <div class="flex items-center justify-center justify-items-center gap-24">
            <div class="flex justify-center w-2/5 h-36 px-8 py-4 bg-white rounded-xl big-shadow">
                <img class="h-full" src="{{asset('storage/sponsors/beno.jpg')}}">
            </div>
            <div class="flex justify-center w-1/5 h-36 px-8 py-4 bg-white rounded-xl big-shadow">
                <img class="h-full" src="{{asset('storage/sponsors/interget.png')}}">
            </div>
            <div class="flex justify-center w-1/5 h-36 px-8 py-4 bg-white rounded-xl big-shadow">
                <img class="h-full" src="{{asset('storage/sponsors/spec-instal.png')}}">
            </div>
        </div>
        <div class="flex items-center justify-center justify-items-center gap-24">
            <div class="flex justify-center w-1/5 h-36 px-8 py-4 bg-white rounded-xl big-shadow">
                <img class="h-full" src="{{asset('storage/sponsors/interget.png')}}">
            </div>
            <div class="flex justify-center w-2/5 h-36 px-8 py-4 bg-white rounded-xl big-shadow">
                <img class="h-full" src="{{asset('storage/sponsors/strazaczki-pl.png')}}">
            </div>
        </div>
    </div>
@endsection