<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuestionImages extends Model
{
    protected $table = 'question_images';

    protected $fillable = [
        'question_id',
        'image',
    ];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
