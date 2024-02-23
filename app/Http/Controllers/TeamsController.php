<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Team;
use Illuminate\Support\Facades\Storage;
// use App\Message;
use App\Alert\Alert;

class TeamsController extends Controller
{
    public function index(Request $request){
        if($search = $request['search']){
            $teams = Team::where('name', 'LIKE', "%$search%")
                ->paginate(10);
        }
        else{
            $teams = Team::paginate(10);
        }

        return view('admin.team.teams', [
            'teams' => $teams,
            'search' => $search ?? "",
        ]);
    }

    public function show($id){
        $team = Team::where('id', $id)
            ->firstOrFail();

        return view('admin.team.team', [
            'team' => $team
        ]);
    }

    public function create(){
        return view('admin.team.create');
    }

    public function store(Request $request){
        if($request->hasFile('image')){
            $imageName = $request['name'] . "." . $request->file('image')->extension();
        }
        else{
            $imageName = "default-team.png";
        }

        $player = Team::create([
            "image" => $imageName,
            "name" => $request['name'],
        ]);



        if($request->hasFile('image')){
            Storage::putFileAs(
                'public/teams', $request->file('image'), $imageName
            );
        }

        $alert = new Alert('success');
        $alert->use();
        return redirect()->route('team.index');
    }

    public function edit($id){
        $team = Team::where('id', $id)
            ->firstOrFail();

        return view('admin.team.edit', [
            'team' => $team
        ]);
    }

    public function update($id, Request $request){
        if($request->hasFile('image')){
            $imageName = $request['name'] . "." . $request->file('image')->extension();
        }
        else{
            $imageName = "default-team.png";
        }

        Team::where('id', $id)
            ->update([
                'name' => $request['name'],
                'image' => $imageName,
            ]);
        
        if($request->hasFile('image')){
            Storage::putFileAs(
                'public/teams', $request->file('image'), $imageName
            );
        }

        $alert = new Alert('success');
        $alert->use();
        return redirect()->route('team.show', ['id' => $id]);
    }

    public function delete($id){
        $team = Team::where('id', $id)->delete();

        $alert = new Alert('success');
        $alert->use();
        return redirect()->route('team.index');
    }
}
