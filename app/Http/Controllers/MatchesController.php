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
    public function edit($id){
        $match = LksMatch::where('id', $id)->firstOrFail();
        $players = Player::get();
        // dd($players);
        return view('admin.match.edit', [
            'id' => $id,
            'match' => $match,
            'players' => $players
        ]);
    }

    public function update(Request $request, $id){
        $players = $request->players;
        $quantities = $request->quantities;
        for($i=0; $i<count($players); $i++){
            if(!$players[$i] && !$quantities[$i]){
                continue;
            }
            $goals[$i] = [
                'name' => $players[$i],
                'quantity' => $quantities[$i],
            ];
        }
        
        foreach ($goals as $goal){
            $player = Player::where('name', $goal['name'])->firstOrFail();
            Goal::create([
                'matchId' => $id,
                'playerId' => $player->id,
                'quantity' => $goal['quantity']
            ]);
        }
        dd(1);
    }


    public function scrapMatches(){
        $currentSeason = '2022/2023';
        $targetClass = 'tabela-terminarz';
        $walkower = ' - drużyna wycofana, walkower';

        $link = 'https://pilkaopolska.pl/klasa-b-grupa-vii/';
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
            // dd($match);
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

            LksMatch::where('teamHomeId', $homeId)
                ->where('teamAwayId', $awayId)
                ->where('date', $date)
                ->where('season', $currentSeason)
                ->firstOrCreate([
                    'teamHomeId' => $homeId,
                    'teamAwayId' => $awayId,
                    'date' => $date,
                    'season' => $currentSeason
                ],
                [
                    'homeGoals' => $homeGoals,
                    'awayGoals' => $awayGoals
                ]);
        }
        // POPRAWIĆ DODAWANIE WYNIKÓW, Z TEGO POWODU ŻE WYNIKI SIĘ NIE NADPISUJĄ
        dd($matches);
    }

    static public function getLastMatch() : LksMatch {
        $now = Carbon::now()->toDateTimeString();
        // dd($now);
        $lastMatch = LkSMatch::where('date', '<', $now)
            // ->whereNotNull(['homeGoals', 'awayGoals'])
            ->orderBy('date', 'desc')
            ->first();

        if($lastMatch){
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
        return $lastMatch;
    }

    static public function getNextMatch() : LksMatch {
        $now = Carbon::now()->toDateTimeString();
        $nowSubMatch = Carbon::now()->subMinute(110)->toDateTimeString();
        $nextMatch = LkSMatch::where('date', '>', $nowSubMatch)
        ->whereNull(['homeGoals', 'awayGoals'])
        ->orderBy('date', 'asc')
        ->first();

        if($nextMatch){
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
}
