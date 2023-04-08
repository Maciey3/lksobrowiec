<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LksMatch extends Model
{
    use HasFactory;

    protected $table = 'Matches';

    protected $fillable = [
        'teamHomeId',
        'teamAwayId',
        'date',
        'season'
    ];
}
