<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = [
        'user_id',
        'parent_id',
        'title',
        'body',
        'tags',
        'upvotes',
        'downvotes',
        'reports',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function responses()
    {
        return $this->hasMany(Responses::class)
            ->whereNull('parent_id');
    }

    public function images()
    {
        return $this->hasMany(QuestionImages::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tags::class, 'question_tags', 'question_id', 'tag_id');
    }

    public function question_tags()
    {
        return $this->hasMany(QuestionTag::class);
    }
}
