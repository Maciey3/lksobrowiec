<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Goal extends Model
{
    use HasFactory;

    protected $primaryKey = ['matchId', 'userId'];
    
    public $incrementing = false;

    protected $fillable = [
        'matchId',
        'playerId',
        'quantity'
    ];

    public function match(): HasOne
    {
        return $this->hasOne(LksMatch::class, 'id', 'matchId');
    }

    public function player(): HasOne
    {
        return $this->hasOne(Player::class, 'id', 'playerId');
    }

    // public function getFromCurrentSeason(){
    //     return $this->hasOne(LksMatch::class, 'id', 'matchId')->where('matches.season', '2022/2023');
    // }
}
