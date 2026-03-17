<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Votes extends Model
{
    protected $fillable = [
        'user_id',
        'type',
        'votable_id',
        'votable_type',
    ];
}
