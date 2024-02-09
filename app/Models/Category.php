<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $guarded = [
        'id', 'created_at', 'updated_at'
    ];

    //Relacion de 1:N (article-category)
    public function articles(){
        return $this->hasMany(Article::class);
    }

    //Usar el slug en vez del id
    public function getRouteKeyName()
    {
        return 'slug';
    }

}
