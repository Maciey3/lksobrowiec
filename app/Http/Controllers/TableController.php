<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Team;
use App\Models\Table;
use DOMDocument;

class TableController extends Controller
{
    static public function scrapTable(){
        $currentSeason = env('CURRENT_SEASON');
        $targetClass = 'tabela-wynikow';

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
            for ($i=0; $i < count($rows); $i++) {
                if(!$i || $i == 1){
                    continue;
                }

                $cells = $rows[$i]->getElementsByTagName('td');
                $name = $cells[1]->nodeValue;
                $matches = $cells[2]->nodeValue;
                $points = $cells[3]->nodeValue;

                if($name == 'PAUZA'){
                    continue;
                }

                $teams[$i-1] = [
                    'Name' => $name,
                    'Matches' => $matches,
                    'Points' => $points,
                ];
            }
        }

        foreach ($teams as $team) {
            $name = $team['Name'];
            $matches = $team['Matches'];
            $points = $team['Points'];

            $id = Team::where('name', $name)
                ->firstOrCreate([
                    'name' => $name
                ])
                ->id;

            Table::where('teamId', $id)
                ->where('season', $currentSeason)
                ->firstOrCreate([
                    'teamId' => $id,
                    'season' => $currentSeason
                ])
                ->update([
                    'matches' => $matches,
                    'points' => $points
                ]);
        }

        // dd($teams);
    }
}
