<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

use App\Models\Article;
use App\Models\Publisher;
use App\Models\User;
use App\Models\Relationship;
use Illuminate\Support\Facades\DB;


class TestController extends Controller
{

    public function test(){
        return view('pages.test', ['users' => "hi"]);

    }

    public function top_news_by_category(){
        $articles = DB::table('article_categories')
                        ->select('article_id as id', 'category_id', 'articles.title', 'categories.categoryname', 'articles.articledescription','created_at')
                        ->distinct('category_id')
                        ->join('posts', 'posts.id', '=', 'article_categories.article_id')
                        ->join('articles as articles', 'articles.post_id', '=', 'article_categories.article_id')
                        ->join('categories', 'categories.id', '=', 'article_categories.category_id')
                        ->take(10)
                        ->get();
        return view('pages.test', ['articles' => $articles]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showPub(){
        $id = 14;
        $publisher = Publisher::find($id);    
        
        if (!is_null($publisher->user_id)){
          return view('pages.test', [
            'user' => User::find($publisher->user_id), 
            'publisher'=>$publisher
            ]);  
        }
        return view('pages.test', ['publisher' => $publisher, 'user' => $user]);

    }

    public function profile(){
        $id = 24;
        $publisher = Publisher::find($id);
        
        if (!is_null($publisher->user_id)){
          return view('pages.test', [
            'user' => User::find($publisher->user_id), 
            'publisher'=>$publisher
            ]);  
        }
    }

    public function propose_topic(){

        $id = 24;
        $publisher = Publisher::find($id);
        if (!is_null($publisher->user_id)){

            $categories = Category::select('id', 'categoryname')
                ->get();
            return view('pages.test', [
              'user' => User::find($publisher->user_id), 
              'publisher'=>$publisher,
              'categories' => $categories
              ]);  
          }
    }


    public function requests(){
        
        $id = 27;

        $publishers = Relationship::select('publisher1_id')
            ->where('publisher2_id', $id)
            ->get();
        
        return view('pages.test',[
            'publishers' => $publishers
        ]);
    }
    
}
