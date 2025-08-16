<?php

namespace App\Models;

use App\Traits\HasHeart;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Italofantone\Sluggable\Sluggable;

class Question extends Model
{
    /** @use HasFactory<\Database\Factories\QuestionFactory> */
    use HasFactory, HasHeart, Sluggable;

    protected $fillable = [
        'title',
        'user_id',
        'category_id',
        'description',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    protected static function booted()
    {
        static::deleting(function ($question) {
            $question->hearts()->delete();

            $question->comments()->get()->each(function ($comment) {
                $comment->hearts()->delete();
                $comment->delete();
            });

            $question->answers()->get()->each(function ($answer) {
                $answer->hearts()->delete();
                $answer->comments()->get()->each(function ($comment) {
                    $comment->hearts()->delete();
                    $comment->delete();
                });
            });
        });
    }
}
