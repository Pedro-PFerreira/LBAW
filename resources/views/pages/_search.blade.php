@extends('layouts.app')

@section('content')

  <article class="searches">
    @foreach($results as $article)
    <section class="article-piece" data-id="{{$article->id}}">
    <label>      
      <a href="<?php echo route('article.show', $article->id)?>">Title: {{ $article->title }}</a><br>
      <span>Article description: {{$article->articledescription}}</span><br>
    </label>
    </section>
  
    @endforeach
  </article>

@endsection
