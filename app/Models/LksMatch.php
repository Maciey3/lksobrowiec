<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class LksMatch extends Model
{
    use HasFactory;

    protected $table = 'Matches';

    protected $fillable = [
        'teamHomeId',
        'teamAwayId',
        'homeGoals',
        'awayGoals',
        'date',
        'season'
    ];

    public function homeTeam(): HasOne
    {
        return $this->hasOne(Team::class, 'id', 'teamHomeId');
    }

    public function awayTeam(): HasOne
    {
        return $this->hasOne(Team::class, 'id', 'teamAwayId');
    }
}
