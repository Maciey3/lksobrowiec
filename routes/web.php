<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\TableController;
use App\Http\Controllers\MatchesController;

use App\Models\Table;
use App\Models\LkSMatch;

use Carbon\Carbon;

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

    $now = Carbon::now()->toDateTimeString();
    // dd($now);
    $lastMatch = LkSMatch::where('date', '<', $now)
        ->whereNotNull(['homeGoals', 'awayGoals'])
        ->orderBy('date', 'desc')
        ->first();
        
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

    $nextMatch = LkSMatch::where('date', '>', $now)
        ->whereNull(['homeGoals', 'awayGoals'])
        ->orderBy('date', 'asc')
        ->first();

    $matchDate = Carbon::parse($nextMatch->date);
    $counter = $matchDate->diffInMinutes($now);
    $minutes = $counter%60;
    $counter = intdiv($counter, 60);
    $hours = $counter%24;
    $counter = intdiv($counter, 24);
    $days = $counter;

    $nextMatch->timeLeft = [
        'days' => $days . 'D',
        'hours' => $hours . "H",
        'minutes' => $minutes . 'M'
    ];

    return view('index', [
        'teams' => $teams,
        'lastMatch' => $lastMatch,
        'nextMatch' => $nextMatch
    ]);
})->name('home');

Route::get('/terminarz', function () {
    $currentSeason = '2022/2023';
    $matches = LkSMatch::where('season', $currentSeason)
        ->orderBy('date', 'asc')
        ->get();

    foreach ($matches as $key => $match){
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
            $matches[$key]->state = "WYGRANA";
        }
        elseif(($homeGoals < $awayGoals && $team == 1) || ($homeGoals > $awayGoals && $team == 2)){
            $matches[$key]->state = "PRZEGRANA";
        }
        elseif($homeGoals == $awayGoals && $homeGoals !== NULL && $awayGoals !== NULL){
            $matches[$key]->state = "REMIS";
        }
    }

    return view('matches', ['matches' => $matches]);
})->name('matches');

Route::get('/updateTable', [TableController::class, 'scrapTable']);
Route::get('/updateMatches', [MatchesController::class, 'scrapMatches']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
