<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Player;
use App\Models\Goal;
use Illuminate\Support\Facades\Storage;
use App\Alert\Alert;

class PlayersController extends Controller
{
    public function index(Request $request){
        if($search = $request['search']){
            $playersActive = Player::where('active', 1)
                ->where('name', 'LIKE', "%$search%")
                ->paginate(10);
        
            $playersUnactive = Player::where('active', 0)
                ->where('name', 'LIKE', "%$search%")
                ->paginate(5);
        }
        else{
            $playersActive = Player::where('active', 1)
                ->paginate(10);
        
            $playersUnactive = Player::where('active', 0)
                ->paginate(5);
        }

        
        
        return view('admin.player.players', [
            'playersActive' => $playersActive,
            'playersUnactive' => $playersUnactive,
            'search' => $search ?? "",
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

        $alert = new Alert('success');
        $alert->use();
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

        $alert = new Alert('success');
        $alert->use();
        return redirect()->route('player.show', ['id' => $id]);
    }

    public function delete($id){
        $player = Player::where('id', $id)->delete();
        $goals = Goal::where('playerId', $id)->delete();

        $alert = new Alert('success');
        $alert->use();
        return redirect()->route('player.index');
    }
}
