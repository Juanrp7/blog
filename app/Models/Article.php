<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;
    protected $guarded = [
        'id', 'created_at', 'updated_at'
    ];

    //relacion de 1:N inversa (user-articles)
    public function user(){
        return $this->belongsTo(User::class);
    }

    //relacion de 1:N (article-comments)
    public function comments(){
        return $this->hasMany(Comment::class);
    }

    //relacion de 1:N inversa (category-articles)
    public function category(){
        return $this->belongsTo(Category::class);
    }

    //Utilizar el slug en vez del id
    public function getRouteKeyName()
    {
        return "slug";
    }


}
