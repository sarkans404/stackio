<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuestionTag extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'question_id',
        'tag_id',
    ];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
