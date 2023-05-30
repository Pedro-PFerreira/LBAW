<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Article;

use Illuminate\Auth\Access\HandlesAuthorization;

class ArticlePolicy
{
    use HandlesAuthorization;

    public function edit(User $user, Article $article){
        $publisher = $article->publisher()->get()[0];
        $userData = $publisher->user()->get()[0];
        return $user->id == $userData->id;
    }

    public function delete(User $user, Article $article){
        $publisher = $article->publisher()->get()[0];
        $userData = $publisher->user()->get()[0];
        return $user->id == $userData->id;
    }
}
?>