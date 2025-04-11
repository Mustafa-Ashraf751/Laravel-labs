<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;



class Post extends Model
{

    use HasFactory, Sluggable;

    protected $fillable = [
        'title',
        'description',
        'user_id',
        'image'
    ];

    protected static function booted()
    {
        static::deleting(function ($post) {
            $post->comments()->withTrashed()->get()->each(function ($comment) {
                $comment->forceDelete();
            });
        });
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //Trashed comments too

    public function allComments()
    {
        return $this->morphMany(Comment::class, 'commentable')->withTrashed();
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
