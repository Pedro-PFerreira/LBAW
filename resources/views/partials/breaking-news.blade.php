<div id = "breaking-news-container">

    <h2 id = "breaking-header" class = "star-1 stars"> • BREAKING NEWS</h2>
  
    @foreach($breaking_new as $new)  
    <section class="breaking-news-main-page" data-id="{{$breaking_new}}">
  
        <article>
        <h3 id="new-title-header">
        <a id= "new-title" href="<?php echo route('article.show', $new->article_id)?>">{{ $new->title }}</a>
        </h3>
        <div id="new-description">{{$new->articledescription}}</div>
        <div id="new-date">{{$new->created_at}}</div>
        </article>        
    </section>
    @endforeach

</div>
