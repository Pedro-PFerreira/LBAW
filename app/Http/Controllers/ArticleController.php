<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $articles = Article::all();
        return view('pages.articles', ['articles' => $articles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        return view('pages.new_article');
    }
    /*public function create(CreateArticleRequest $request){
        return $request;
    }*/

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $post = new Post();
        $post = Post::create([
            'publisher_id' => $request->publisher_id,
            'nlikes' => 0,
            'ndislikes' => 0,
            'ncomments' => 0
        ]);

        $post->save();
        $article = Article::create([
            'post_id' => $post->id,
            'title' => $request->title,
            'articledescription' => $request->articledescription,
            'body' => $request->body,
            'accepted' => 'false'
            
        ]);

        $article->save();

        $categories = DB::insert('insert into article_categories (article_id, category_id) values(?,?)', [$article->id, $request->categories]);

        $topics = DB::insert('insert into has_topics (article_id, topic_id) values(?,?)', [$article->id, $request->topics]);
        
        return redirect(route('article.show', $article->id));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        $article = Article::find($id);
        $post_id = $article->post()->get()[0]->id;
        $articleVotes = Post::join('votes', 'posts.id', '=', 'votes.post_id')
                                ->select('votes.user_id', 'votes.type')
                                ->where('posts.id', $post_id)
                                ->get();
        $categories = DB::select('select categoryname from categories, article_categories where article_id = :id and categories.id = category_id', ['id' => $id]);
        $articleLikes = [];
        $articleDislikes = [];
        foreach($articleVotes as $vote){
            if($vote->type === "like"){
                array_push($articleLikes, $vote->user_id);
            }
            else {
                array_push($articleDislikes, $vote->user_id);
            }
        }
        $favorites = Post::join('favorites', 'posts.id', '=', 'favorites.post_id')
                                  ->select('favorites.publisher_id')
                                  ->where('posts.id', $post_id)
                                  ->get();
        $articleFavorites = [];
        foreach($favorites as $favorite){
            array_push($articleFavorites, $favorite->publisher_id);
        }
        $comments = $article->comments()->get();
        if($comments->isEmpty()){
            $comments = null;
        }
        return view('pages.article', [
            'article' => $article,
            'categories' => $categories,
            'comments' => $comments,
            'articleLikes' => $articleLikes,
            'articleDislikes' => $articleDislikes,
            'articleFavorites' => $articleFavorites
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        $article = Article::find($id);
        $this->authorize('edit', $article);
        return view('pages.edit-article', ['article' => $article]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
        $article = Article::find($id);
        $this->authorize('edit', $article);
        if($request->title != NULL){
            $article->title = $request->title;
        }
        if($request->articledescription != NULL){
            $article->articledescription = $request->articledescription;
        }
        if($request->body != NULL){
            $article->body = $request->body;
        }
        $article->save();
        return view('pages.article', ['article' => $article]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        $article = Article::find($id);
        $this->authorize('delete', $article);
        $article->delete();
    }

    public function destroyed(){
        return view('pages.destroyed');
    }

    public function top(){
        $articles = Article::select('articles.id as article_id', '*')
                    ->join('posts', 'articles.post_id', '=', 'posts.id')
                    ->where('accepted', 'true')
                    ->orderBy('nlikes')
                    ->take(10)
                    ->get();
        return view('pages.top-articles', ['articles' => $articles]);
    }
    
    public function breaking_news(){
        $breaking_new = Article::select('articles.id as article_id', '*')
                    ->join('posts', 'articles.post_id', '=', 'posts.id')
                    ->where('accepted', 'true')
                    ->orderBy('created_at', 'desc')
                    ->take(1)
                    ->get();

        $articles = DB::table('article_categories')
                      ->select('articles.id as id', 'category_id', 'articles.title', 'categories.categoryname', 'articles.articledescription','created_at')
                      ->distinct('category_id')
                      ->join('posts', 'posts.id', '=', 'article_categories.article_id')
                      ->join('articles as articles', 'articles.post_id', '=', 'article_categories.article_id')
                      ->join('categories', 'categories.id', '=', 'article_categories.category_id')
                      ->take(10)
                      ->get();

        return view('pages.main-page', ['breaking_new' => $breaking_new, 'articles' => $articles]);
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
        return view('pages.main-page', ['articles' => $articles]);
    }

    public static function exactMatchTitle(Request $request){
        $results = Article::join("posts", "articles.post_id", '=', "posts.id");
        $order = 'desc';
        $sort = 'reputation';
        if(!empty($request->order)){
            $order = 'asc';
        }
        if(empty($request->sort)){
            $results->selectRaw("*, articles.id as article_id, nlikes - ndislikes as reputation");
        }
        else {
            $results->selectRaw("*, articles.id as article_id");
            if($request->sort === 'date'){
                $sort = 'created_at';
            }
            else if ($request->sort === 'comments'){
                $sort = 'ncomments';
            }
            else if($request->sort === 'favorites'){
                $sort = 'favorites';
            }
        }
        $results->where('title', $request->target)
                ->orderBy($sort, $order);
        if(empty($request->type)){
            return $results->take(3)->get();
        }
        else{
            return $results->get();
        }
    }
    
    public function search(Request $request){
        $column = $request->column;
        $target = $request->target;
        $results = Article::where($column, $target)
                        ->get();
        return view('pages.search', ['results' => $results]);
    }

    public static function fullTextTitle(Request $request){
        $results = Article::join("posts", "articles.post_id", '=', "posts.id");
        $order = 'desc';
        $sort = 'reputation';
        if(!empty($request->order)){
            $order = 'asc';
        }
        if(empty($request->sort)){
            $results->selectRaw("*, articles.id as article_id, nlikes - ndislikes as reputation");
        }
        else {
            $results->selectRaw("*, articles.id as article_id");
            if($request->sort === 'date'){
                $sort = 'created_at';
            }
            else if ($request->sort === 'comments'){
                $sort = 'ncomments';
            }
            else if($request->sort === 'favorites'){
                $sort = 'favorites';
            }
        }
        $results->whereFullText('title', $request->target)
                ->orderBy($sort, $order);
        if(empty($request->type)){
            return $results->take(3)->get();
        }
        else{
            return $results->get();
        }
    }
    
    public static function exactMatchContent(Request $request){
        $results = Article::join("posts", "articles.post_id", '=', "posts.id");
        $order = 'desc';
        $sort = 'reputation';
        if(!empty($request->order)){
            $order = 'asc';
        }
        if(empty($request->sort)){
            $results->selectRaw("*, articles.id as article_id, nlikes - ndislikes as reputation");
        }
        else {
            $results->selectRaw("*, articles.id as article_id");
            if($request->sort === 'date'){
                $sort = 'created_at';
            }
            else if ($request->sort === 'comments'){
                $sort = 'ncomments';
            }
            else if($request->sort === 'favorites'){
                $sort = 'favorites';
            }
        }
        $results->where('body', $request->target)
                ->orderBy($sort, $order);
        if(empty($request->type)){
            return $results->take(3)->get();
        }
        else{
            return $results->get();
        }
    }

    public static function fullTextContent(Request $request){
        $results = Article::join("posts", "articles.post_id", '=', "posts.id");
        $order = 'desc';
        $sort = 'reputation';
        if(!empty($request->order)){
            $order = 'asc';
        }
        if(empty($request->sort)){
            $results->selectRaw("*, articles.id as article_id, nlikes - ndislikes as reputation");
        }
        else {
            $results->selectRaw("*, articles.id as article_id");
            if($request->sort === 'date'){
                $sort = 'created_at';
            }
            else if ($request->sort === 'comments'){
                $sort = 'ncomments';
            }
            else if($request->sort === 'favorites'){
                $sort = 'favorites';
            }
        }
        $results->whereFullText('body', $request->target)
                ->orderBy($sort, $order);
        if(empty($request->type)){
            return $results->take(3)->get();
        }
        else{
            return $results->get();
        }
    }

    public function popular(){
        $results = Article::join("posts", "articles.post_id", '=', "posts.id")
                            ->selectRaw("*, articles.id as article_id, nlikes - ndislikes as reputation")
                            ->orderBy('reputation', 'ASC')
                            ->take(10)
                            ->get();
        return view('pages.default-articles', ['articles' => $results]);
    }

    public function recent(){
        $results = Article::join("posts", "articles.post_id", '=', "posts.id")
                            ->selectRaw('*, articles.id as article_id')
                            ->orderBy('created_at', 'DESC')
                            ->take(10)
                            ->get();
        return view('pages.default-articles', ['articles' => $results]);
    }
}
