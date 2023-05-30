<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

use App\Models\User;
use App\Models\Post;
use App\Models\Publisher;
use App\Models\Category;
use App\Models\Topic;
use App\Models\Article;
use Illuminate\Support\Facades\DB;

class PublisherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        return Publisher::all();
    }

    public function all(){
        return view('pages.all-publishers', ['publishers' => Publisher::all()]);
    }

    public function profile($id){
        $publisher = Publisher::find($id);
        if (!is_null($publisher->user_id)){
          return view('pages.publisher', [
            'user' => User::find($publisher->user_id), 
            'publisher'=>$publisher
            ]);  
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        $publisher = Publisher::find($id);

        if ($publisher->user_id != 2){
            return $publisher;
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        $publisher = Publisher::find($id);
        $user = $publisher->user()->get()[0];
        return view('pages.edit-publisher', [
            'publisher' => $publisher,
            'user' => $user
        ]);
    }

    public function propose_topic($id){

        $publisher = Publisher::find($id);
        if (!is_null($publisher->user_id)){

            $categories = Category::select('id', 'categoryname')
                ->get();
            return view('pages.topic-proposal', [
              'user' => User::find($publisher->user_id), 
              'publisher'=>$publisher,
              'categories' => $categories
              ]);  
          }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
        //add checks to see if retrieve was successful
        $publisher = Publisher::find($id);
        $user = User::find($publisher->user_id);
        if($request->nome != NULL){
            $user->name = $request->nome;
        }
        if($request->email != NULL){
            $user->email = $request->email;
        }
        if($request->password != NULL){
            $user->password = bcrypt($request->password);
        }

        $user->save();
        if($request->bio != NULL){
            $publisher->bio = $request->bio;
        }
        if($request->profilepic != NULL){
            $file = $request->file('profilepic');
            $filename= $request->profilepic->getClientOriginalName();
            $file->move('images/',$filename);
            $publisher->profilepic = $filename;
        }
        $publisher->save();
        return view('pages.publisher', [
            'user' => User::find($publisher->user_id), 
            'publisher'=>$publisher
        ]);
    }

    public function articles(Request $request, $id){
        $publisher = Publisher::find($id);
        $articles = $publisher->articles();
        
        return view('pages.user-articles', [
            'user' => $publisher->get()[0],
            'publisher' => $publisher->get()[0],
            'articles' => $articles->get()
        ]);
    }

    public function delete($id){
        $publisher = Publisher::find($id);
        $user = $publisher->user()->get()[0];
        $publisher->user_id = 2;
        $publisher->banned = 'TRUE';
        $publisher->save();
        return redirect()->route('admin');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteaccount(Request $request, $id){
        
        $publisher = Publisher::find($id);
        $user = $publisher->user()->get()[0];
        //$publisher->user_id = 2;
        $publisher->banned = true;
        $publisher->save();
        
        return redirect()->route('login');
    }

    /*
        $articles = Article::select('articles.id as article_id', '*')
                    ->join('posts', 'articles.post_id', '=', 'posts.id')
                    ->where('accepted', 'true')
                    ->orderBy('nlikes')
                    ->take(10)
                    ->get();
        return view('pages.top-articles', ['articles' => $articles]);
    */

    public function friends($id){
        $publisher = Publisher::find($id);
        //$friends = $publiher->user()->get()[0];
        $friends = Relation::select('users.id as user_id');
    }

    public static function exactMatch(Request $request){
        $users = [];
        if($request->type == 'all'){
            $users = User::where('name', $request->target)->take(3)->get();
        }
        else{
            $users = User::where('name', $request->target)->get();
        }
        $results = [];
        $i = 0;
        foreach($users as $user){
            $results[$i] = Publisher::where('user_id', $user->id)->get();
            $i++;
        }
        return $results;
    }

    public static function fullText(Request $request){
        $users = [];
        if($request->type == 'all'){
            $users = User::where('name', 'LIKE', '%'.$request->target.'%')->take(3)->get();
        }
        else{
            $users = User::where('name', 'LIKE', '%'.$request->target.'%')->get();
        }
        $results = [];
        $i = 0;
        foreach($users as $user){
            $results[$i] = Publisher::where('user_id', $user->id)->get();
            $i++;
        }
        return $results;
    }

    public function manage_feed($id){
        $selectedTopics = Topic::join('feed_topics', 'feed_topics.topic_id', '=', 'topics.id')
                               ->select('topic_id')
                               ->where('feed_topics.publisher_id', 26)
                               ->where('accepted', 'TRUE')
                               ->get();
        $all = Topic::where('accepted', 'TRUE')->get();
        $found = false;
        $i = 0;
        $j = 0;
        $allTopics[$i] = [];
        foreach($all as $topic){
            foreach($selectedTopics as $selected){
                if($topic->id === $selected->topic_id){
                    $found = true;
                    break;
                }
            }
            if($found){
                $topic['selected'] = true;
                $found = false;
            }
            else{
                $topic['selected'] = false;
            }
            array_push($allTopics[$i], $topic);
            $j++;
            if($j % 15 == 0){
                $i++;
                $allTopics[$i] = [];
                $j = 0;
            }
        }
        return view('pages.manage-feed', ['allTopics' => $allTopics]);
    }

    public function topics(Request $request, $id){
        $response = [];
        $selectedTopics = $request['selectedTopics'];
        $i = 0;
        if(!empty($selectedTopics)){
            foreach($selectedTopics as $topic){
                $newTopic = DB::table('feed_topics')->insert([
                                'publisher_id' => $id,
                                'topic_id' => $topic
                            ]);
                $response['newTopics'][$i] = $newTopic;
                $i++;
            }
        }
        $removedTopics = $request['removedTopics'];
        $i = 0;
        if(!empty($removedTopics)){
            foreach($removedTopics as $topic){
                $removedTopic = DB::table('feed_topics')
                                ->where('topic_id', $topic)
                                ->delete();
                $response['removedTopics'][$i] = $topic;
                $i++;
            }
        }
        return $response;
    }

    public function feed($id){
        $topics = DB::table('feed_topics')->where('feed_topics.publisher_id', $id)->get();
        $article = [];
        $i=0;
        foreach($topics as $topic){
            $article_topic = Topic::join('has_topics', 'topics.id', '=', 'has_topics.topic_id')
                                  ->where('has_topics.topic_id', $topic->topic_id)->get();     
            if(!empty($article_topic[0])){
                $findarticle = $article_topic[0]->article_id;
                $article[$i] = Article::join("posts", "articles.post_id", '=', "posts.id")
                                      ->selectRaw('*, articles.id as article_id')
                                      ->where('articles.id', $findarticle)
                                      ->get()[0];                                                  
                $i++;
            }
        }
        return view('pages.default-articles', ['articles' => $article]);
    }

    public function pending($id){
        $articles = Article::join('posts', 'posts.id', '=', 'articles.post_id')
                           ->selectRaw('*, articles.id as article_id')
                           ->where('posts.publisher_id', $id)
                           ->where('articles.accepted', 'false')
                           ->get();
        return view('pages.default-articles', ['articles' => $articles]);
    }

    public function requests($id){
        
        $publishers = 
        Relationship::select('publisher1_id')
            ->where('publisher2_id', $id)
            ->get();
        
        return view('pages.friend-request',[
            'publishers' => $publishers
        ]);
    }
}
