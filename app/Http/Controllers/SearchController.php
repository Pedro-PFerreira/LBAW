<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\ArticleController;

class SearchController extends Controller
{
    public function show(Request $request){
        if($request->target == null){
            return view('pages.search');
        }
        else{
            return $this::results($request);
        }
    }

    public function results(Request $request){
        $results;
        $type = $request->type;
        if($type == "publishers" || empty($type)){
            if($request->exactMatch){
                $results['publishers'] = PublisherController::exactMatch($request);
            }
            else{
                $results['publishers'] = PublisherController::fullText($request);
            }
        }
        if($type == "titles" || empty($type)){
            if($request->exactMatch){
                $results['titles'] = ArticleController::exactMatchTitle($request);
            }
            else{
                $results['titles'] = ArticleController::fullTextTitle($request);
            }
        }
        if($type == "content" || empty($type)){
            if($request->exactMatch){
                $results['content'] = ArticleController::exactMatchContent($request);
            }
            else{
                $results['content'] = ArticleController::fullTextContent($request);
            }
        }
        if($type == "comments" || empty($type)){
            if($request->exactMatch){
                $results['comments'] = CommentController::exactMatch($request);
            }
            else{
                $results['comments'] = CommentController::fullText($request);
            }
         }
        if($type == "topics" || empty($type)){
            if($request->exactMatch){
                $results['topics'] = TopicController::exactMatch($request);
            }
            else{
                $results['topics'] = TopicController::fullText($request);
            }
        }
        if($request->search === 'exactMatch'){
            $request->search = 'exact-Match';
        }
        $params = [
            'type' => ucfirst($type),
            'sort' => ucfirst($request->sort),
            'order' => ucfirst($request->order),
            'search' => ucfirst($request->search),
            'target' => $request->target
        ];
        return view('pages.search', [
            'results' => $results,
            'params' => $params
        ]);
    }
}
