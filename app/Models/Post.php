<?php

// app/Models/Post.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'user_id', 'image_url'];  // Пример, добавьте нужные атрибуты

    /**
     * Связь с пользователем
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Связь с изображением (если используется полиморфная связь)
     */
    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }
}
