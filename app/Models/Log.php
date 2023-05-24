<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use HasFactory;
    protected $table = 'logs';
    protected $guarded = ['id'];

    public function hasNews()
    {
        return $this->belongsTo(News::class, 'news_id');
    }
    public function hasUser()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
