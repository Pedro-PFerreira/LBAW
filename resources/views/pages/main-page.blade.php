@extends('layouts.app')

@section('Title', 'Main Page')

@section('content')
  <div class="info-container">
    @include('partials.breaking-news', ['breaking_new' => $breaking_new])
    <h2 id="News-by-category-title">News by category</h2>
    @include('partials.top-articles-main-page', ['articles' => $articles])
  </div>
@endsection