@extends('layouts.app')

<?php
 $categories = DB::table('categories')->select('*')->get();

 $topics = DB::table('topics') ->select('*')->get();
?>


@section('content')
<form method="POST" action="{{route('article.store')}}">
    @csrf    
    <h2 id="word-title">Title</h2>
    <textarea id="title" name="title" row=8 cols=52 placeholder="Insert title" required autofocus></textarea>
    <h2 id="word-description">Description</h2>
    <textarea id="articledescription" name="articledescription" row=10 cols=52 placeholder="Article description" required></textarea>    
    <h2 id="word-body">Body</h2>
    <textarea id="body" name="body" row=30 cols=52 placeholder="Body" required></textarea>

    <ul>
<h4> Categories </h4>
    @foreach($categories as $category) 
    <li>
        <input class = "checkboxes" type="checkbox" id="{{'category'.$category->id}}" name="categories" value="{{$category->id}}" placeholder="In which category / categories is inserted">
        <label for="{{$category->categoryname}}"> {{$category->categoryname}}</label>
    </li>

  @endforeach
    <h4> Topics </h4>
    @foreach($topics as $topic) 
    <li>
        <input class = "checkboxes" type="checkbox" id="{{'topic'.$topic->id}}" name="topics" value="{{$topic->id}}" placeholder="In which category / categories is inserted">
        <label for="{{$topic->topicname}}"> {{$topic->topicname}}</label>
    </li>

    @endforeach

    </ul>
    <?php $miau = DB::table('publishers')->select('id')->where('user_id', Auth::user()->id)->get()[0]->id;?>
    <input type="hidden" name="publisher_id" value="<?= $miau?>">

    <div id="article-button-container">
        <button id="button-submit-article" type="submit">
            Submit article
        </button>
    </div>

</form>
@endsection
