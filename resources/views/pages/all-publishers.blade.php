@extends('layouts.app')

@section('content')
<div class="info-container" id="search-results-container">
    <div id="search-options-container">
            <div class="search-container" id="search-bar-container">
        @if(!empty($params) && $params['target'] != NULL)
                <input class="search" type="text" id="publisher-search" value = "<?php echo $params['target'] ?>" href="http://localhost:8000/api/search">    
        @else
            <input class="search" type="text" id="publisher-search" placeholder="Search" href="http://localhost:8000/api/search">
        @endif
    </div>
    <div id="publisher-results-container">
        @foreach($publishers as $publisher)
            @include('partials.publisher-card', $publisher)
        @endforeach
    </div>
</div>
@endsection