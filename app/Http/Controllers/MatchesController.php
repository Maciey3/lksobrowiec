<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DOMDocument;
use App\Models\Team;
use App\Models\LksMatch;
use App\Models\Player;
use App\Models\Goal;
use Carbon\Carbon;

class MatchesController extends Controller
{
    public function index(){
        $matches = LksMatch::where('season', env('CURRENT_SEASON'))
            ->paginate(10);

        return view('admin.match.matches', [
            'matches' => $matches
        ]);
    }

    public function create(){
        $teams = Team::get();
        return view('admin.match.create', [
            'teams' => $teams
        ]);
    }

    public function store(Request $request){
        $homeTeam = Team::where('name', $request['homeTeam'])
            ->firstOrCreate([
                'name' => $request['homeTeam']
            ]);
        $awayTeam = Team::where('name', $request['awayTeam'])
            ->firstOrCreate([
                'name' => $request['awayTeam']
            ]);
        
        $date = $request['date'] . " " . $request['time'];
        
        LksMatch::create([
            'teamHomeId' => $homeTeam->id,
            'teamAwayId' => $awayTeam->id,
            'type' => $request['type'],
            'date' => $date,
            'season' => env('CURRENT_SEASON')
        ]);

        return redirect()->route('match.index');
    }

    public function edit($id){
        $teams = Team::get();
        $match = LksMatch::where('id', $id)
            ->firstOrFail();
        
        $splitted = explode(' ', $match->date);

        $date = [
            'day' => $splitted[0],
            'time' => $splitted[1]
        ];

        return view('admin.match.edit', [
            'teams' => $teams,
            'match' => $match,
            'date' => $date
        ]);
    }

    public function editGoals($id){
        $match = LksMatch::where('id', $id)->firstOrFail();
        $players = Player::get();

        $goals = Goal::where('matchId', $id)
            ->get();
        
        $match->strDate = MatchesController::formatDate($match->date);
        $goals = Goal::where('matchId', $match->id)
        ->get();

        $home = $match->homeTeam->name;
        $away = $match->awayTeam->name;
        $homeGoals = $match->homeGoals;
        $awayGoals = $match->awayGoals;
    
        if($home == 'LKS OBROWIEC'){
            $team = 1;
        }
        elseif($away == 'LKS OBROWIEC'){
            $team = 2;
        }
    
        if(($homeGoals > $awayGoals && $team == 1) || ($homeGoals < $awayGoals && $team == 2)){
            $match->state = "WYGRANA";
        }
        elseif(($homeGoals < $awayGoals && $team == 1) || ($homeGoals > $awayGoals && $team == 2)){
            $match->state = "PRZEGRANA";
        }
        elseif($homeGoals == $awayGoals && $homeGoals !== NULL && $awayGoals !== NULL){
            $match->state = "REMIS";
        }
        
        return view('admin.match.editGoals', [
            'id' => $id,
            'match' => $match,
            'players' => $players,
            'goals' => $goals
        ]);
    }

    public function update(Request $request, $matchId){
        $homeTeam = Team::where('name', $request['homeTeam'])
            ->firstOrCreate([
                'name' => $request['homeTeam']
            ]);
        $awayTeam = Team::where('name', $request['awayTeam'])
            ->firstOrCreate([
                'name' => $request['awayTeam']
            ]);
        
        $date = $request['date'] . " " . $request['time'];

        // dd($date);
        // dd(Carbon::createFromFormat('Y-m-d H:i:s', $date)->toDateTime());

        LksMatch::where('id', $matchId)
            ->update([
                'teamHomeId' => $homeTeam->id,
                'teamAwayId' => $awayTeam->id,
                'homeGoals' => $request['homeGoals'] ?? NULL,
                'awayGoals' => $request['awayGoals'] ?? NULL,
                'type' => $request['type'],
                'date' => $date,
            ]);
        
        return redirect()->route('match.index');
    }

    public function updateGoals(Request $request, $matchId){
        // Sprawdź czy ilość strzelonych bramek
        // jest równa ilości bramek
        // strzelonych na podstawie wyniku
        $obrowiec = Team::where('name', 'LKS OBROWIEC')
            ->firstOrFail();

        $match = LksMatch::where('id', $matchId)
            ->firstOrFail();
        
        
        if($match->teamHomeId == $obrowiec->id){
            $obrowiecGoals = $match->homeGoals;
        }
        else{
            $obrowiecGoals = $match->awayGoals;
        }
            
        $players = $request->players;
        $quantities = $request->quantities;
        
        if($obrowiecGoals != array_sum($quantities)){
            return redirect()->back();
        }
            
        Goal::where('matchId', $matchId)->delete();

        for($i=0; $i<count($players); $i++){
            if(!$players[$i] && !$quantities[$i]){
                continue;
            }
            $goals[$i] = [
                'player' => $players[$i],
                'quantity' => $quantities[$i],
            ];
        }

        foreach ($goals as $goal){
            $player = Player::where('name', $goal['player'])->firstOrFail();
            
            Goal::create([
                'matchId' => $matchId,
                'playerId' => $player->id,
                'quantity' => $goal['quantity']
            ]);
        }

        return redirect()->route('home');
    }


    static public function scrapMatches(){
        $currentSeason = env('CURRENT_SEASON');
        $targetClass = 'tabela-terminarz';
        $walkower = ' - drużyna wycofana, walkower';

        $link = env('CURRENT_GROUP_ADDRESS');
        $html = file_get_contents($link);

        $dom = new DOMDocument;
        @$dom->loadHTML('<?xml encoding="utf-8" ?>' . $html);

        $table = $dom->getElementsByTagName('table');

        for ($i=0; $i < count($table); $i++) { 
            $tableClass = $table->item($i)->getAttribute('class');
            if($tableClass == $targetClass){
                $destTable = $table->item($i);
            }
        }

        if (strpos($destTable->getAttribute('class'), $targetClass) !== false) {

            $rows = $destTable->getElementsByTagName('tr');
            foreach ($rows as $row) {
                $cells = $row->getElementsByTagName('td');
                if (count($cells) < 5) {
                    continue;
                }

                if (!strpos($row->nodeValue, 'LKS OBROWIEC') || strpos($row->nodeValue, 'PAUZA')){
                    continue;
                }

                $homeTeam = explode($walkower, $cells[1]->nodeValue)[0];
                $awayTeam = explode($walkower, $cells[2]->nodeValue)[0];

                $result = explode(':', $cells[5]->nodeValue);
                $homeGoals = ($result[0] == '') ? NULL : $result[0];
                $awayGoals = $result[1] ?? NULL;

                $date = $cells[3]->nodeValue . ' ' . $cells[4]->nodeValue;

                $matches[] = [
                    'homeTeam' => $homeTeam,
                    'awayTeam' => $awayTeam,
                    'homeGoals' => $homeGoals,
                    'awayGoals' => $awayGoals,
                    'date' => $date
                ];
            }
        }

        foreach ($matches as $match) {
            $homeTeam = $match['homeTeam'];
            $awayTeam = $match['awayTeam'];
            $homeGoals = $match['homeGoals'];
            $awayGoals = $match['awayGoals'];
            $date = $match['date'];

            $homeId = Team::where('name', $homeTeam)
                        ->firstOrCreate([
                            'name' => $homeTeam
                        ])
                        ->id;

            $awayId = Team::where('name', $awayTeam)
                        ->firstOrCreate([
                            'name' => $awayTeam
                        ])
                        ->id;
            
            $match = LksMatch::where('teamHomeId', $homeId)
                ->where('teamAwayId', $awayId)
                ->where('season', $currentSeason)
                ->where('type', 'liga')
                ->first();

            if($match){
                if($homeGoals && $awayGoals){
                    $match->update([
                        'homeGoals' => $homeGoals,
                        'awayGoals' => $awayGoals,
                    ]);
                }
                if($date != $match->date){
                    $match->update([
                        'date' => $date
                    ]);
                }
            }
            else{
                LksMatch::create([
                    'teamHomeId' => $homeId,
                    'teamAwayId' => $awayId,
                    'homeGoals' => $homeGoals,
                    'awayGoals' => $awayGoals,
                    'date' => $date,
                    'season' => $currentSeason
                ]);
            }
        }
    }

    static public function getLastMatch() : Array {
        $now = Carbon::now()->toDateTimeString();
        $lastMatch = LkSMatch::where('date', '<', $now)
            // ->whereNotNull(['homeGoals', 'awayGoals'])
            ->orderBy('date', 'desc')
            ->first();

        if($lastMatch){
            $lastMatch->strDate = MatchesController::formatDate($lastMatch->date);
            $goals = Goal::where('matchId', $lastMatch->id)
            ->get();

            $home = $lastMatch->homeTeam->name;
            $away = $lastMatch->awayTeam->name;
            $homeGoals = $lastMatch->homeGoals;
            $awayGoals = $lastMatch->awayGoals;
        
            if($home == 'LKS OBROWIEC'){
                $team = 1;
            }
            elseif($away == 'LKS OBROWIEC'){
                $team = 2;
            }
        
            if(($homeGoals > $awayGoals && $team == 1) || ($homeGoals < $awayGoals && $team == 2)){
                $lastMatch->state = "WYGRANA";
            }
            elseif(($homeGoals < $awayGoals && $team == 1) || ($homeGoals > $awayGoals && $team == 2)){
                $lastMatch->state = "PRZEGRANA";
            }
            elseif($homeGoals == $awayGoals && $homeGoals !== NULL && $awayGoals !== NULL){
                $lastMatch->state = "REMIS";
            }
        }
        return [$lastMatch ?? NULL, $goals ?? NULL];
    }

    static public function getNextMatch() : LksMatch|NULL {
        $now = Carbon::now()->toDateTimeString();
        $nowSubMatch = Carbon::now()->subMinute(110)->toDateTimeString();
        $nextMatch = LkSMatch::where('date', '>', $nowSubMatch)
        ->whereNull(['homeGoals', 'awayGoals'])
        ->orderBy('date', 'asc')
        ->first();

        
        if($nextMatch){
            $nextMatch->strDate = MatchesController::formatDate($nextMatch->date);
            $matchDate = Carbon::parse($nextMatch->date);
            if($matchDate < $now){
                $nextMatch->timeLeft = ['status' => 'live'];
                $counter = $matchDate->diffInMinutes($now);
                if($counter < 46){
                    $nextMatch->live = $counter . '\'';
                }
                elseif($counter > 46 && $counter < 61){
                    $nextMatch->live = 'PRZERWA';
                }
                elseif($counter > 61){
                    $nextMatch->live = $counter-15 . '\'';
                }
                elseif($counter > 90){
                    $nextMatch->live = 90 . '\'';
                }
                
            }
            else{
                $counter = $matchDate->diffInMinutes($now);
                $minutes = $counter%60;
                $counter = intdiv($counter, 60);
                $hours = $counter%24;
                $counter = intdiv($counter, 24);
                $days = $counter;
            
                $nextMatch->timeLeft = [
                    'status' => 'remaining',
                    'days' => $days . 'D',
                    'hours' => $hours . "H",
                    'minutes' => $minutes . 'M'
                ];
            }
        }

        return $nextMatch;
    }

    static public function formatDate($date){
        $day = Carbon::parse($date)->locale('pl')->dayName;
        $date = Carbon::createFromFormat('Y-m-d H:i:s', $date)
        ->format('d.m.Y H:i');
        list($date, $time) = explode(' ', $date);


        return [
            'day' => $day,
            'date' => $date,
            'time' => $time
        ];
    }
}
