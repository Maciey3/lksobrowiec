<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;


class Table extends Model
{
    use HasFactory;

    protected $fillable = [
        'teamId',
        'matches',
        'points',
        'season'
    ];

    public function team(): HasOne
    {
        return $this->hasOne(Team::class, 'id', 'teamId');
    }
}
