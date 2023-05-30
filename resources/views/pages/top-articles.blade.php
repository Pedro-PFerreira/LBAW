@extends('layouts.app')

@section('content')
<div class="info-container">
  @foreach($articles as $article)
  <section class="article-piece" data-id="{{$article->id}}">
    <article>
      <h3 id="article-title-header">
        <a id= "top-article-title" href="<?php echo route('article.show', $article->article_id)?>">{{ $article->title }}</a>
      </h3>
      <div id="top-article-description">{{$article->articledescription}}</div>
      <div id="top-article-date">{{$article->created_at}}</div>
    </article>
  </section>
  @endforeach
</div>
@endsection
