@extends('layouts.app')

@section('content')
<form method='POST' class="edit-comment" action="<?php echo route('article.update', $article->id)?>">
    @method('PUT')
    @csrf
    Comment:
    <input type="text" name="body" value="<?php echo $comment->content?>">
      <button type="Submit">Save</button>
</form>
@endsection
