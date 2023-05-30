<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Article;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{

    public function store(Request $request){
        $array=$request->all();
        $post = Post::create([
            'publisher_id' => $array['publisher_id'],
            'nlikes' => 0,
            'ndislikes' => 0,
            'ncomments' => 0
        ]);
        
        $comment = Comment::create([
            'post_id' => $post->id,
            'article_id' => $array['article_id'],
            'content' => $array['content']
        ]);

        $publisher = $post->publisher()->get()[0];
        $username = $publisher->user()->get()[0]->name;

        return response(['comment'=>$comment, 'publisher_name'=> $username], 200);
    }

    public function update(Request $request, $id){
        $comment = Comment::find($id);
        $this->authorize('update', $comment);
        if($request->content != NULL){
            $comment->content = $request->comment;
        }
        $comment->save();
        return $comment;
    }

    public function delete($id){
        $comment = Comment::find($id);
        $this->authorize('delete', $comment);
        $comment->delete();
        return $comment;
    }

    public static function exactMatch(Request $request){
        if($request->sort != 'favorites'){
            $results = Comment::join("posts", "comments.post_id", '=', "posts.id");
            $order = 'desc';
            $sort = 'reputation';
            if(!empty($request->order)){
                $order = 'asc';
            }
            if(empty($request->sort)){
                $results->selectRaw("*, comments.id as comment_id, nlikes - ndislikes as reputation");
            }
            else if($request->sort === 'date'){
                $sort = 'created_at';
            }
            else if ($request->sort === 'comments'){
                $sort = 'ncomments';
            }
            else if($request->sort === 'favorites'){
                $sort = 'favorites';
            }
            $results->where('content', $request->target)
                    ->orderBy($sort, $order);
            if(empty($request->type)){
                return $results->take(3)->get();
            }
            else{
                return $results->get();
            }
        }
        return null;
    }

    public static function fullText(Request $request){
        if($request->sort != 'favorites'){
            $results = Comment::join("posts", "comments.post_id", '=', "posts.id");
            $order = 'desc';
            $sort = 'reputation';
            if(!empty($request->order)){
                $order = 'asc';
            }
            if(empty($request->sort)){
                $results->selectRaw("*, nlikes - ndislikes as reputation");
            }
            else if($request->sort === 'date'){
                $sort = 'created_at';
            }
            else if ($request->sort === 'comments'){
                $sort = 'ncomments';
            }
            else if($request->sort === 'favorites'){
                $sort = 'favorites';
            }
            $results->whereFullText('content', $request->target)
                    ->orderBy($sort, $order);
            if(empty($request->type)){
                return $results->take(3)->get();
            }
            else{
                return $results->get();
            }
        }
        return null;
    }
}
