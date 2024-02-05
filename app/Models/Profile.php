<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    //Campos que no se van asignar masivamente. Lo contrario a fillable
    protected $guarded = [
        'id', 'created_at', 'updated_at'
    ];

    //Relacion 1:1 inversa (prfile-user)
    public function user(){
        return $this->hasOne(Profile::class);
    }

    
}
