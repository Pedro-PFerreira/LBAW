<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Vote;
use App\Models\Publisher;
use App\Models\Favorite;
use App\Models\Article;

class PostController extends Controller{
    
    public function vote(Request $request, $id){
        $input = $request->all();
        $post = Post::find($id);
        $nlikes = $post->nlikes;
        $ndislikes = $post->ndislikes;
        $vote;
        if($input['type'] === 'like'){
            if($input['op'] === 'add'){
                $nlikes = $nlikes+1;
                $vote = PostController::add_like_vote($post->id, $input['user_id']);
            }
            else if ($input['op'] === 'take'){
                $nlikes = $nlikes-1;
                $vote = PostController::take_vote($post->id, $input['user_id']);
            }
            $post->nlikes = $nlikes;
        }
        else if($input['type'] === 'change-like'){
            $post->nlikes = $nlikes-1;
            $post->ndislikes = $ndislikes+1;
            $vote = PostController::change_vote($post->id, $input['user_id'], 'dislike');
        }
        else if($input['type'] === 'dislike'){
            if($input['op'] === 'add'){
                $ndislikes = $ndislikes+1;
                $vote = PostController::add_dislike_vote($post->id, $input['user_id']);
            }
            else if ($input['op'] === 'take'){
                $ndislikes = $ndislikes-1;
                $vote = PostController::take_vote($post->id, $input['user_id']);
            }
            $post->ndislikes = $ndislikes;
        }
        else if($input['type'] === 'change-dislike'){
            $post->nlikes = $nlikes+1;
            $post->ndislikes = $ndislikes-1;
            $vote = PostController::change_vote($post->id, $input['user_id'], 'like');
        }
        else if($input['type'] === 'favorites'){
            if($input['op'] === 'add'){
                $vote = PostController::add_favorite($post->id, $input['user_id']);
            }
            else if ($input['op'] === 'take'){
                $article = $post->article();
                $article->favorites = $article->favorites-1;
                $vote = PostController::take_favorite($post->id, $input['user_id']);
                $article->save();
            }
        }
        else return "Error: invalid type";
        $post->save();
        return [
            'post' => $post,
            'vote' => $vote
        ];
    }

    private function add_like_vote($post_id, $user_id){
        $vote = Vote::create([
            'user_id' => $user_id,
            'post_id' => $post_id,
            'type' => 'like'
        ]);
        return $vote;
    }

    private function take_vote($post_id, $user_id){
        $vote = Vote::where('post_id', $post_id)
                    ->where('user_id', $user_id)
                    ->forceDelete();
        return $vote;
    }

    private function add_dislike_vote($post_id, $user_id){
        $vote = Vote::create([
            'user_id' => $user_id,
            'post_id' => $post_id,
            'type' => 'dislike'
        ]);
        return $vote;
    }

    private function change_vote($post_id, $user_id, $type){
        $vote = Vote::where('post_id', $post_id)
                    ->where('user_id', $user_id)
                    ->update(['type' => $type]);
        return $vote;
    }

    private function add_favorite($post_id, $user_id){
        $publisher_id = Publisher::where('user_id', $user_id)
                        ->get()[0]
                        ->id;
        $vote = Favorite::create([
            'publisher_id' => $publisher_id,
            'post_id' => $post_id
        ]);
        return $vote;
    }

    private function take_favorite($post_id, $user_id){
        $publisher_id = Publisher::where('user_id', $user_id)
                        ->get()[0]
                        ->id;
        $vote = Favorite::where('publisher_id', $publisher_id)
                        ->where('post_id', $post_id)
                        ->delete();
        return $vote;
    }

    public function comment($id) {
        $post = Post::find($id)->increment('ncomments');
        //$post = Post::find($id);
        return $post;
    }

}
