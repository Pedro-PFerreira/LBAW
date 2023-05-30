<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;
use App\Models\Article;

class CategoryController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $categoriesFirst = Category::skip(1)->take(5)->get();
        $categoriesSecond = Category::skip(6)->take(5)->get();
        return view('pages.categories', [
            'categoriesFirst' => $categoriesFirst,
            'categoriesSecond' => $categoriesSecond]);
    }

    public function articles($id){
        $articles = Article::join('article_categories', 'articles.id', '=', 'article_categories.article_id')
                              ->where('category_id', $id)
                              ->get();                   
        return view('pages.default-articles', ['articles' => $articles]);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        $category = Category::find($id);
        $comments = $article->comments()->get();
        if($comments->isEmpty()){
            $comments = null;
        }
        return view('pages.article', [
            'article' => $article,
            'comments' => $comments
        ]);
    }
}
