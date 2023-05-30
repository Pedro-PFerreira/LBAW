@extends('layouts.app')

@section('title', 'Topic Proposal')

@section('content')

<h3>
    Topic Proposal
<h3>

<article id="topic-proposal-info">
    In this Page you can propose a topic you believe it will be relevant for the community. <br>
    Also, it should have, at least, 1 category associated. <br>
    However, it will be evaluated by our administrators to decide if it will be accepted or not, since it can exist already similar topics to yours. <br>
</article>

<form method="POST" action="{{route('send-propose-topic')}}">
  @csrf
  <input id="topic-name" type="text" name="topicname" placeholder="Insert your topic name" required autofocus>
  <ul>
  @foreach($categories as $category) 
    <li>
        <input class = "checkboxes" type="checkbox" id="{{'category'.$category->id}}" name="category_id" value="{{$category->id}}" placeholder="In which category / categories is inserted">
        <label for="{{$category->categoryname}}"> {{$category->categoryname}}</label>
    </li>

  @endforeach
    </ul>
    <?php $miau = DB::table('publishers')->select('id')->where('user_id', Auth::user()->id)->get()[0]->id;?>
    <input type="hidden" name="publisher_id" value="<?= $miau?>">
    <button type="submit" id='topic-proposal'>
        Submit Topic Proposal
    </button>
</form>

@endsection