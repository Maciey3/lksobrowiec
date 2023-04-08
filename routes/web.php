<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Models\Team;
use App\Models\Table;
use App\Models\LksMatch;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    $currentSeason = '2022/2023';
    $teams = Table::where('season', $currentSeason)
        ->orderBy('points', 'desc')
        ->get();
    // dd($teams);
    return view('index', ['teams' => $teams]);
});

Route::get('/updateTable', function () {
    $currentSeason = '2022/2023';
    $targetClass = 'tabela-wynikow';

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

    // $table = $dom->getElementsByTagName('table')->item(0);
    // $tableClass = $table->getAttribute('class');
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

    dd($teams);
});

Route::get('/updateMatches', function () {
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
            $date = $cells[3]->nodeValue . ' ' . $cells[4]->nodeValue;

            $matches[] = [
                'homeTeam' => $homeTeam,
                'awayTeam' => $awayTeam,
                'date' => $date
            ];
        }
    }

    foreach ($matches as $match) {
        $homeTeam = $match['homeTeam'];
        $awayTeam = $match['awayTeam'];
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
            ]);
        // In future result update
    }

    dd($matches);
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
