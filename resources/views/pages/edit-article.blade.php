@extends('layouts.app')

@section('title', 'Edit Article')

@section('content')
<section id="edit">
  <article class="edit_article">
    <form method = "POST" class="article_edition" action="<?php echo route('article.update', $article->id)?>">
      @method('PUT')
      @csrf
      <input type="text" name="title" value="<?php echo $article->title?>">
      <input type="text" name="articledescription" value="<?php echo $article->articledescription?>">
      <input type="text" name="body" value="<?php echo $article->body?>">
      <button type="Submit">Save</button>
    </form>
  </article>
</section>
@endsection