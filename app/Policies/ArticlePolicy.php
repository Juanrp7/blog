<?php

namespace App\Policies;

use App\Models\Article;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ArticlePolicy
{
    public function published(?User $user, Article $article){
        if($article->status == 1){
            return true;
        }else{
            return false;
        }
    }

    public function view(User $user, Article $article){

        //Revisar si el usuario autenticado es el mismo que creo el articulo
        return $user->id === $article->user_id;
    }

    public function update(User $user, Article $article){
        //Revisar si el usuario autenticado es el mismo que creo el articulo
        return $user->id === $article->user_id;
    }

    public function delete(User $user, Article $article){
        //Revisar si el usuario autenticado es el mismo que creo el articulo
        return $user->id == $article->user_id;
    }
        

}
