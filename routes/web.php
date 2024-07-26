<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\TableController;
use App\Http\Controllers\MatchesController;
use App\Http\Controllers\PlayersController;
use App\Http\Controllers\TeamsController;
use App\Http\Controllers\UserController;

use App\Models\Table;
use App\Models\Player;
use App\Models\LkSMatch;
use App\Models\Goal;

use Illuminate\Database\Eloquent\Builder;

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
    $currentSeason = env('CURRENT_SEASON');
    $teams = Table::where('season', $currentSeason)
        ->orderBy('points', 'desc')
        ->get();
    
    list($lastMatch, $matchGoals) = MatchesController::getLastMatch();
    $nextMatch = MatchesController::getNextMatch();
    $goals = Goal::take(3)
        ->whereHas('match', function (Builder $q) {
            $q->where('matches.season', env('CURRENT_SEASON'));
        })
        ->groupBy('playerId')
        ->selectRaw('playerId, SUM(quantity) as quantity')
        ->orderBy('quantity', 'desc')
        ->get();


    return view('index', [
        'teams' => $teams,
        'lastMatch' => $lastMatch,
        'nextMatch' => $nextMatch,
        'matchGoals' => $matchGoals,
        'goals' => $goals
    ]);
})->name('home');

Route::get('/kontakt', function(){
    return view('contact');
})->name('contact');

Route::get('/klub', function(){
    return view('club');
})->name('club');

Route::get('/sponsorzy', function(){
    return view('sponsors');
})->name('sponsors');

Route::get('/terminarz', function () {
    function sortMatches($matches){
        $sorted = [];
        foreach($matches as $i => $match){
            if($i+1 % 2){
                if(!isset($matches[$i])){
                    continue;
                }
                array_push($sorted, $match);
                unset($matches[$i]);
            }

            $homeTeam = $match->teamHomeId;
            $awayTeam = $match->teamAwayId;
            foreach ($matches as $j => $$match) {
                if($$match->teamHomeId == $awayTeam && $$match->teamAwayId == $homeTeam){
                    // dump($$match->homeTeam->id . $awayTeam .  $$match->awayTeam->id . $homeTeam);
                    array_push($sorted, $$match);
                    unset($matches[$j]);
                    break;
                }
            }
        }
        
        return $sorted;
    }

    $currentSeason = '2023/2024';
    $matches = LkSMatch::where('season', $currentSeason)
        ->orderBy('date', 'asc')
        ->get();

    // dd($matches);
    $matches = sortMatches($matches);

    foreach ($matches as $key => $match){
        list($match->date, $match->time) = explode(' ', $match->date);
        $match->time = explode(':', $match->time)[0] . ':' . explode(':', $match->time)[1];
        $match->date = (new Carbon($match->date))->format('d.m.Y');

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


Route::get('/update', function(){
    $info = MatchesController::scrapMatches();
    TableController::scrapTable();

    if($info == -1){
        // return redirect()->route('club');
        return view('admin.match.labelSeason');
    }
    else{
        return redirect()->route('home');
    }

})->name('update');

// Route::get('/updateTable', [TableController::class, 'scrapTable']);
// Route::get('/updateMatches', [MatchesController::class, 'scrapMatches']);

Route::get('/createPlayer', function(){
    $random = rand(1,9999);
    $player = Player::create([
        'name' => "Maciej Chromiński {$random}",
        'birthday' => '2001.02.11'
    ]);
    dd($player);
});

Route::controller(MatchesController::class)
    ->name('match.')
    ->group(function(){
        Route::get('/matches', 'index')->name('index');
        Route::get('/match/create', 'create')->name('create');
        Route::post('/match/store', 'store')->name('store');
        Route::get('/match/edit/{id}', 'edit')->name('edit');
        Route::post('/match/update/{id}', 'update')->name('update');
        Route::get('/match/edit/{id}/goals', 'editGoals')->name('editGoals');
        Route::post('/match/update/goals/{id}', 'updateGoals')->name('updateGoals');
        Route::post('/matches/markSeasonsLabels', 'markSeasonsLabels')->name('markSeasonsLabels');
    }
);

Route::controller(TeamsController::class)
    ->name('team.')
    ->group(function(){
        Route::get('/teams', 'index')->name('index');
        Route::get('/team/create', 'create')->name('create');
        Route::post('/team/store', 'store')->name('store');
        Route::get('/team/{id}', 'show')->name('show');
        Route::get('/team/edit/{id}', 'edit')->name('edit');
        Route::post('/team/update/{id}', 'update')->name('update');
        Route::post('/team/team/{id}', 'delete')->name('delete');
    }
);

Route::controller(PlayersController::class)
    ->name('player.')
    ->group(function(){
        Route::get('/players', 'index')->name('index');
        Route::get('/player/new', 'new')->name('new');
        Route::post('/player/create', 'create')->name('create');
        Route::get('/player/{id}', 'show')->name('show');
        Route::get('/player/edit/{id}', 'edit')->name('edit');
        Route::post('/player/update/{id}', 'update')->name('update');
        Route::post('/player/delete/{id}', 'delete')->name('delete');
    }
);

Route::controller(UserController::class)
    ->name('user.')
    ->group(function(){
        Route::get('/users', 'index')->name('index');
        Route::get('/user/create', 'create')->name('create');
        Route::post('/user/store', 'store')->name('store');
        Route::get('/user/{id}', 'show')->name('show');
    }
);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
