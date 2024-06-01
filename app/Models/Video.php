<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'user_id',
        'category_id',
        'path',
        'description',
        'count_like',
        'count_dislike',
        'visibility'
    ];

    public function category() {
        return $this->belongsTo(Category::class);
    }
    public function user() {
        return $this->belongsTo(User::class);
    }
    public function commetns() {
        return $this->hasMany(Comment::class);
    }
    public function likes() {
        return $this->hasMany(Like::class);
    }
}
