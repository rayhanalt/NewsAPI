<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;
    protected $table = 'news';
    protected $guarded = ['id'];
    protected $fillable = ['title', 'content', 'image'];

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
