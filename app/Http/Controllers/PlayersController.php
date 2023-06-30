<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Player;

class PlayersController extends Controller
{
    public function index(){
        $players = Player::get();
        // dd($players);
        return view('admin.player.players', [
            'players' => $players
        ]);
    }

    public function show($id){
        $player = Player::where('id', $id)->firstOrFail();
        // dd($players);
        return view('admin.player.player', [
            'player' => $player
        ]);
    }
}
