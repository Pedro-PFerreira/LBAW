<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Comment;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommentPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function edit(User $user, Comment $comment){
        $publisher = $comment->publisher()->get()[0];
        $userData = $publisher->user()->get()[0];
        return $user->id == $userData->id;
    }

    public function delete(User $user, Comment $comment){
        $publisher = $comment->publisher()->get()[0];
        $userData = $publisher->user()->get()[0];
        return $user->id == $userData->id;
    }
}
