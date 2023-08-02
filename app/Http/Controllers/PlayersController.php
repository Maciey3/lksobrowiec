<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Player;
use App\Models\Goal;
use Illuminate\Support\Facades\Storage;

class PlayersController extends Controller
{
    public function index(){
        $playersActive = Player::where('active', 1)
            ->get();
        
        $playersUnactive = Player::where('active', 0)
            ->get();
        
        return view('admin.player.players', [
            'playersActive' => $playersActive,
            'playersUnactive' => $playersUnactive
        ]);
    }

    public function new(){
        return view('admin.player.addPlayer');
    }

    public function create(Request $request){
        if($request->hasFile('image')){
            $imageName = $request['name'] . "." . $request->file('image')->extension();
        }
        else{
            $imageName = "profile.png";
        }

        $player = Player::create([
            "image" => $imageName,
            "name" => $request['name'],
            "birthday" => $request['birthday']
        ]);



        if($request->hasFile('image')){
            Storage::putFileAs(
                'public/players', $request->file('image'), $imageName
            );
        }

        return redirect()->route('player.index');
    }

    public function show($id){
        $player = Player::where('id', $id)->firstOrFail();
        // dd($players);
        return view('admin.player.player', [
            'player' => $player
        ]);
    }

    public function edit($id){
        $player = Player::where('id', $id)->firstOrFail();
        // dd($players);
        return view('admin.player.edit', [
            'player' => $player
        ]);
    }

    public function update($id, Request $request){
        if($request->hasFile('image')){
            $imageName = $request['name'] . "." . $request->file('image')->extension();
        }
        else{
            $imageName = "profile.png";
        }

        Player::where('id', $id)
            ->update([
                'image' => $imageName,
                'name' => $request['name'],
                'birthday' => $request['birthday'],
                'active' => $request['status']
            ]);
        
        if($request->hasFile('image')){
            Storage::putFileAs(
                'public/players', $request->file('image'), $imageName
            );
        }

        return redirect()->route('player.show', ['id' => $id]);
    }

    public function delete($id){
        $player = Player::where('id', $id)->delete();
        $goals = Goal::where('playerId', $id)->delete();

        return redirect()->route('player.index');
    }
}
