<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tags extends Model
{
    public function questions()
    {
        return $this->belongsToMany(Question::class, 'question_tags', 'tag_id', 'question_id');
    }
}
