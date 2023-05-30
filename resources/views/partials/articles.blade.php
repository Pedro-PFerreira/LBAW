<script>
  var post_id = {{$article->post()->get()[0]->id}};
  var article_id = {{$article->id}};
</script>
<section id="article-piece" data-id="{{$article->id}}">
  <label>
      <div id="container-info-data">
        <div id="title-article">
          <span id="title-article-id">{{$article->title}}</span>
        </div>
        <div id ="publisher-name">
          <a id ="publisher-name-id" href="<?php echo route('publisher.get', $publisher->id)?>">{{$user->name}}</a>
        </div>
        <div id="categories-container">
          @foreach($categories as $category)
            <h4 id="article-category">
              {{$category->categoryname}}
            </h4>
          @endforeach
        </div>
        <div id = data-article>
          <div id="data-article-id">{{$post->created_at}}</div>
        </div>
        <div id ="body-article">
          <span id="body-article-id">{{$article->body}}</span>
        </div>
      </div>
      <div id="details-container">
        @if($user->id === Auth::id())
          <div class="article-manage-container">
            <a id="article-edit-button" href="<?php echo route('article.edit', $article->id)?>"> Edit Article </a>
          </div>
        @else
          <div class="article-manage-container" id="article-manage-container-off"></div>
        @endif
        @if($user->id === Auth::id())
          <div class="article-manage-container" id='article-delete-container'>
            <a id="article-delete-button"> Delete Article </a>
          </div>
        @else
          <div class="article-manage-container" id="article-manage-container-off"></div>
        @endif
        @if(!Auth::check())
          <div class = "stats-container" id="stats-container-guest">
            <div id = "likes-icon"> 
              <i style="color: #0874a9; font-size:1.2em;" class="fa-solid fa-heart"></i> {{$post->nlikes}}
            </div>
            <div id = "dislikes-icon">
              <i style="color: #0874a9; font-size:1.2em;" class="fa-solid fa-heart-crack"></i> {{$post->ndislikes}}
            </div>
            <div id ="comment-icon">
              <i style="color: #0874a9; font-size:1.2em;" class="fa-solid fa-message"></i> {{$post->ncomments}}
            </div>  
            <div id ="comment-icon">
              <i style="color: #0874a9; font-size:1.2em;" class="fa-regular fa-star"></i> {{$article->favorites}}
            </div>  
          </div>
        @else
         <div class = "stats-container" id="stats-container-auth">
            <div id="likes-icon"> 
              <?php $likeCheck = in_array(Auth::id(), $articleLikes, true);?> 
              @if($likeCheck)
                <i style="font-size:1.2em;" id="like-button" class="fa-solid fa-heart stat-icon stat-on"></i>
                <i id='like-number'>{{$post->nlikes}}</i>
              @else
                <i style="font-size:1.2em;" id="like-button" class="fa-solid fa-heart stat-icon stat-off"></i> 
                <i id='like-number'>{{$post->nlikes}}</i>
              @endif 
            </div>
              <div id = "dislikes-icon">
              <?php $dislikeCheck = in_array(Auth::id(), $articleDislikes, true);?> 
              @if($dislikeCheck)
                <i id="dislike-button" class="fa-solid fa-heart-crack stat-icon stat-on"></i>
                <i id='dislike-number'>{{$post->ndislikes}}</i>
              @else
                <i id="dislike-button" class="fa-solid fa-heart-crack stat-icon stat-off"></i> 
                <i id='dislike-number'>{{$post->ndislikes}}</i>
              @endif
            </div>
            <div id ="comment-icon">
              <i style="color: #0874a9" class="fa-solid fa-message"></i> {{$post->ncomments}}
            </div>  
            <div id="favorites-icon">
              <?php $favoriteCheck = in_array($publisher_id, $articleFavorites, true);?> 
              @if($favoriteCheck)
                <i id="favorites-button" style="color: #0874a9" class="fa-solid fa-star stat-icon stat-on"></i>
                <i id='favorites-number'>{{$article->favorites}}</i>
              @else
                <i id="favorites-button" style="color: #0874a9" class="fa-regular fa-star stat-icon stat-off"></i> 
                <i id='favorites-number'>{{$article->favorites}}</i>
              @endif
            </div>  
          </div>
        @endif
      </div>
  </label>
</section>
