@extends('layouts.app')

@section('content')
    <div class="info-container" id="category-articles-container">
            @foreach($articles as $article)
                <section class="article-piece" id="sinopsis-news" data-id="{{$article->id}}">
                    <label>      
                        <div id="article-category-news">
                            {{$article->topicname}}
                        </div>
                        <a id="title-news" href="<?php echo route('article.show', $article->article_id)?>">{{ $article->title }}</a><br>
                        <span id="brief-description"> {{$article->articledescription}}</span><br>
                    </label>
                </section>
            @endforeach
        </section>
    </div>
@endsection