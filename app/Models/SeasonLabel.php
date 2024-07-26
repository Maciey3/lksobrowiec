<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeasonLabel extends Model
{
    use HasFactory;

    protected $table = 'seasons_labels';

    protected $primaryKey = 'season';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'season',
        'label'
    ];
}
