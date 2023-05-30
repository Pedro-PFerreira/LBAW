
  @foreach($articles as $article)
    <section class="article-piece" data-id="{{$article->id}}">
      <article>
      <h4 id="article-category">
          {{$article->categoryname}}
        </h4>

        <section class="article-piece" id="sinopsis-news" data-id="{{$article->id}}">
                        <label>      
                            <a id="title-news" href="<?php echo route('article.show', $article->id)?>">{{ $article->title }}</a><br>
                            <span id="brief-description"> {{$article->articledescription}}</span><br>
                        </label>
                    </section>
  @endforeach
