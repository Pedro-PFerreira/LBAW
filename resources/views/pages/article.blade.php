

@extends('layouts.app')

@section('Title', 'Article Page')

<?php   

  use App\Models\Publisher;

  $post = $article->post()->get()[0];
  $publisher = $post->publisher()->get()[0];
  $user = $publisher->user()->get()[0];
  $logged;
  $publisher_id;
  if(Auth::check()){
    $logged = Auth::id();
    $publisher_id = Publisher::where('user_id', $logged)->get();
    if(count($publisher_id) != 0){
      $publisher_id = $publisher_id[0]->id;
    }
  }
?>

@section ('content')
  <div class="info-container" id='article-info-container'>
    @include('partials.articles', $article)
    @if(Auth::check())
      <div id="new-comment-container">
        <input name="new-comment-publisher" type='hidden' value="<?=$publisher_id?>">
        <input name="new-comment-article" type='hidden' value="<?=$article->id?>">
        <input name="new-comment-post-article" type='hidden' value="<?=$post->id?>">
        <div id="textarea-commet">
          <textarea id="new-comment-box" name="content" row=8 cols=52 placeholder="Leave here your comment..."></textarea>
        </div>
        <div id="new-comment-button-container">
          <button id="new-comment-button" onclick="sendCreateCommentRequest()"> Publish new comment </button>
        </div>
      </div>
    @endif
    @isset($comments)
        @foreach($comments as $comment)
            @include('partials.comment', $comment)
        @endforeach  
    @endisset  
  </div>
@endsection
