@extends('layouts.app')

@section('content')

  <article class="UserArticles">
    @foreach($articles as $article)
    <div class="article-piece" data-id="100">
    <section class="userArticles" data-id="{{$article->id}}">
    <label>      
      <h3> <a id="title-user-article" href="<?php echo route('article.show', $article->id)?>">{{ $article->title }}</a></h3><br>
      <!--<span id="user-article-date">Time: {{$article->created_at}}</span>-->
      <span id="user-article-description">{{$article->articledescription}}</span><br>
    </label>
    </section>
    </div>
    @endforeach
  </article>

@endsection
