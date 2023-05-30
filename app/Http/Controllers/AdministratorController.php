<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Suppport\Facades\Http;

use App\Models\User;
use App\Models\Publisher;
use App\Models\Administrator;
use App\Models\Topic;

class AdministratorController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        return Administrator::all();
    }

/*
Article::select('articles.id as article_id', '*')
                    ->join('posts', 'articles.post_id', '=', 'posts.id')
                    ->where('accepted', 'true')
                    ->orderBy('nlikes')
                    ->take(10)
                    ->get();
*/

    public function deleteUser(){
        $publishers = Publisher::select('*')
                    ->where('user_id', '<>', '2')
                    ->get();
        return view('pages.admin', ['publishers' => $publishers]);
    }

    public function profile(){
        $user = User::find(1);
        
        return view('pages.admin-profile', [
            'user' => $user
        ]);  
    }
        
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        return Administrator::find($id);
    }

    public function ban($id){
        $user = User::find($id);

        return view('pages.ban', ['user' => $user]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function removePost($id){
        $post = Post::find($id);
        $this->authorize('delete', $post);
        $post->delete();
        return $post;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Topic  $topic
     * @return \Illuminate\Http\Response
    */
    public function manage(){
        $topics = Topic::select('id', 'topicname')
            ->where('accepted', false)
            ->get();
        return view('pages.manage-topic', ['topics' => $topics]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function veracity($id){
        $article = Article::find($id);
        return view('pages.veracity', ['article' => $article]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function warn($id){
        $user = User::find($id);
        return view('pages.warn', ['user' => $user]);
    }
}
