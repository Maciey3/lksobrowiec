<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DOMDocument;
use App\Models\Team;
use App\Models\LksMatch;

class MatchesController extends Controller
{
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
                    'homeGoals' => $homeGoals,
                    'awayGoals' => $awayGoals,
                    'date' => $date,
                    'season' => $currentSeason
                ]);
        }

        dd($matches);
    }
}
