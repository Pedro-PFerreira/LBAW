<div id="search-results">
        <article class="searches">
            @foreach($results['content'] as $article)
            <section class="articlePieces" data-id="{{$article->id}}">
            <label>      
            <a href="<?php echo route('article.show', $article->id)?>">Title: {{ $article->title }}</a><br>
            <span>Article description: {{$article->articledescription}}</span><br>
            </label>
        </section>
        @endforeach
    </article>
</div>