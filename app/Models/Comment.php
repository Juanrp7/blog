<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $guarded = [
        'id', 'created_at', 'updated_at'
    ];

    //Relacion de 1:N inversa (comment-user)
    public function user(){
        return $this->belongsTo(User::class);
    }

    //Relacion de 1:N inversa (commenst-article)
    public function article(){
        return $this->belongsTo(Article::class);
    }
}
