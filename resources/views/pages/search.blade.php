@extends('layouts.app')

@section('content')
<div class="info-container" id="search-results-container">
    <div id="search-options-container">
            <div class="search-container" id="search-bar-container">
        @if(!empty($params) && $params['target'] != NULL)
                <input class="search" type="text" id="page-search" value = "<?php echo $params['target'] ?>" href="http://localhost:8000/api/search">    
        @else
            <input class="search" type="text" id="page-search" placeholder="Search" href="http://localhost:8000/api/search">
        @endif
    </div>
    <nav class="navbar navbar-expand navbar-dark" id="navbar-container"style = "background-color: white" >
        <div style = "background-color: white" class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDarkDropdown" aria-controls="navbarNavDarkDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
            <ul class="navbar-nav">
                <li class="nav-item dropdown" style = "background-color:#eaeaea; margin-left: 1em; border-radius: 10px; width: 7em;">
                @if(!empty($params) && $params['type'] != NULL)
                    <a id = "selected-type" style="color: #002c43; text-align:center;" class="nav-link dropdown-toggle selected-option" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <?php echo $params['type']?></a>
                @else
                    <a id = "selected-type" style="color: #002c43; text-align:center;" class="nav-link dropdown-toggle selected-option" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        All</a>
                @endempty
                <ul class="dropdown-menu dropdown-menu">
                    <li><a class="dropdown-item type-option filter-option" href="#">All</a></li>
                    <li><a class="dropdown-item type-option filter-option" href="#">Titles</a></li>
                    <li><a class="dropdown-item type-option filter-option" href="#">Content</a></li>
                    <li><a class="dropdown-item type-option filter-option" href="#">Comments</a></li>
                    <li><a class="dropdown-item type-option filter-option" href="#">Topics</a></li>
                </ul>
                </li>
                <li class="nav-item dropdown" style = "background-color:#eaeaea;  margin-left: 1em; border-radius: 10px; width: 7em">
                @if(!empty($params) && $params['sort'] != NULL)
                    <a id="selected-sort" style="color: #002c43; text-align:center;" class="nav-link dropdown-toggle selected-option" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <?php echo $params['sort']?></a>
                @else
                    <a id="selected-sort" style="color: #002c43; text-align:center;" class="nav-link dropdown-toggle selected-option" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Reputation</a>
                @endif
                <ul class="dropdown-menu dropdown-menu visible" id='sort-option-menu'>
                    <!-- Try to find how to make this dynamic
                        i.e. publishers can be ordered by friends, articles by comments etc -->
                    <li><a class="dropdown-item sort-option filter-option" href="#">Reputation</a></li>
                    <li><a class="dropdown-item sort-option filter-option" href="#">Date</a></li>
                    <li><a class="dropdown-item sort-option filter-option" href="#">Comments</a></li>
                    <li><a class="dropdown-item sort-option filter-option visible" id="sort-favorites" href="#">Favorites</a></li>
                </ul>
                </li>
                <li class="nav-item dropdown" style = "background-color:#eaeaea; margin-left: 1em; border-radius: 10px; width: 7em;">
                @if(!empty($params) && $params['order'] != NULL)
                    <a id="selected-order" style="color: #002c43; text-align:center;" class="nav-link dropdown-toggle selected-option" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <?php echo $params['order']?></a>
                @else
                    <a id="selected-order" style="color: #002c43; text-align:center;" class="nav-link dropdown-toggle selected-option" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Descending</a>
                @endif
                <ul class="dropdown-menu dropdown-menu">
                    <li><a class="dropdown-item order-option filter-option" href="#">Descending</a></li>
                    <li><a class="dropdown-item order-option filter-option" href="#">Ascending</a></li>
                </ul>
                </li>
                <li class="nav-item dropdown" style = "background-color:#eaeaea; margin-left: 1em; border-radius: 10px; width: 7em;">
                @if(!empty($params) && $params['search'] != NULL)
                    <a id="selected-search" style="color: #002c43; text-align:center;" class="nav-link dropdown-toggle selected-option" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <?php echo $params['search']?></a>
                @else
                    <a id="selected-search" style="color: #002c43; text-align:center;" class="nav-link dropdown-toggle selected-option" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Full-Text</a>
                @endif
                <ul class="dropdown-menu dropdown-menu">
                    <li><a class="dropdown-item search-option filter-option" href="#">Full-Text</a></li>
                    <li><a class="dropdown-item search-option filter-option" href="#">Exact-Match</a></li>
                </ul>
                <li id="search-apply-button-container">
                    <button id="search-apply-button">Apply</button>
                </li>
                
            </ul>
            </div>
        </div>
        </nav>
    </div>
    <div id="search-results">
        @isset($results)
            @isset($results['titles'])
                <article class="searches">
                    <h2>By Title</h2>
                    @foreach($results['titles'] as $article)
                    <section class="article-piece" id="sinopsis-news" data-id="{{$article->id}}">
                    <label>      
                        <div id="article-category-news">
                            {{$article->categoryname}}
                        </div>
                        <a id="title-news" href="<?php echo route('article.show', $article->article_id)?>">{{ $article->title }}</a><br>
                        <span id="brief-description"> {{$article->articledescription}}</span><br>
                    </label>
                </section>
                    @endforeach
                </article>
            @endisset
            @isset($results['content'])
                <article class="searches">
                    <h2>By Content</h2>
                    @foreach($results['content'] as $article)
                    <section class="article-piece" id="sinopsis-news" data-id="{{$article->id}}">
                        <label>      
                            <div id="article-category-news">
                                {{$article->categoryname}}
                            </div>
                            <a id="title-news" href="<?php echo route('article.show', $article->article_id)?>">{{ $article->title }}</a><br>
                            <span id="brief-description"> {{$article->articledescription}}</span><br>
                        </label>
                    </section>
                    @endforeach
                </article>
            @endisset
            @isset($results['comments'])
                <article class="searches">
                    <h2>By Comment</h2>
                    @foreach($results['comments'] as $comment)
                        <h5> 
                            <?php $article = $comment->article()->get()[0]?>
                            <a id= "top-article-title" href="<?php echo route('article.show', $article->id)?>">{{ $article->title }}</a>
                        </h5>
                        @include('partials.comment', $comment)
                    @endforeach
                </article>
            @endisset
            @isset($results['topics'])
                <h2>By Topic</h2>
                <article class="searches">
                    @foreach($results['topics'] as $topic)
                        <?php echo $topic->topicname; echo '<br>'; ?>
                        <a id= "topic-search" href="<?php echo route('pages.default-articles')?>"></a>
                    @endforeach
                </article>
            @endisset
        @endisset
    </div>
</div>
@endsection