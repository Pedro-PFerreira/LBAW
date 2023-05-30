<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\CategoryTopic;

class TopicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Topic::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $topic = Topic::create([

            'publisher_id' => $request->publisher_id,
            'topicname' => $request->topicname,
            'accepted' => 'false'
        ]);

        $category_topic = DB::insert('insert into category_topics (category_id, topic_id) values(?,?)', [$request->category_id, $topic->id]);

        //$publisher_topic = DB::insert('insert publisher_topics (publisher_id, topic_id) values(?,?)', [$request->publisher_id, $topic->id]);

        return redirect()->route('main');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function show(Topic $topic)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Topic $topic)
    {
        $topic = Topic::find($request->id);
        $topic->accepted = 'TRUE';
        $topic->save();

        return redirect()->route('manage-topic');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $topic = Topic::find($id);
       
        $category_topic = DB::table('category_topic')
            ->where('topic_id', $id)
            ->delete();

        $publisher_topic = DB::table('publisher_topic')
            ->where('topic_id', $id)
            ->delete();
        $article_topic = DB::table('article_topic')
            ->where('topic_id', $id)
            ->delete();
        $topic->delete();
        //$category_topic->save();
        return redirect()->route('manage-topic');
    }

    public function articles(){
        return view('pages.default-articles');
    }




    public static function exactMatch(Request $request){
        $results = Topic::where('topicname', $request->target);
        $sort = 'topicname';
        $order = 'desc';
        if(!empty($request->order)){
            $order = 'asc';
        }
        $results->orderBy($sort, $order);
        if($request->type == 'all'){
            return $results->take(3)->get();
        }
        else{
            return $results->get();
        }
    }

    public static function fullText(Request $request){
        $results = Topic::where('topicname','LIKE', '%'.$request->target.'%')
                        ->where('accepted', 'TRUE');
        $sort = 'topicname';
        $order = 'desc';
        if(!empty($request->order)){
            $order = 'asc';
        }
        $results->orderBy($sort, $order);
        if($request->type == 'all'){
            return $results->take(3)->get();
        }
        else{
            return $results->get();
        }
    }

}
