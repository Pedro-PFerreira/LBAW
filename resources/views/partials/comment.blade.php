<?php   
  $post = $comment->post()->get()[0];
  $publisher = $post->publisher()->get()[0];
  $user = $publisher->user()->get()[0];
?>

<div id="comment" data-id="{{$comment->id}}">
  <label>
    <div id="comment-container">
      <div id="comment-publisher"> 
        <a id="comment-publisher-id" href="<?php echo route('publisher.get', $publisher->id)?>">{{$user->name}}</a>
      </div>
      <div id="comment-data">
        <div id="comment-data-id">{{$post->created_at}}</div>
      </div>
      <div id="comment-content">
        <div id="comment-content-id">{{$comment->content}}</div>
      </div>
      <div id="comment-votes">
        <div id = "likes-icon-comment"> 
          <i value = {{$comment->id}} style="color: #0874a9; font-size:1.2em;" class="fa-solid fa-heart stat-icon stat-off comment-icon"></i>
        </div>
        <div class="detail-number" id="num-likes-comment-{{$comment->id}}">{{$post->nlikes}}</div>
      
        <div id = "dislikes-icon-comment">
          <i value  = {{$comment->id}} style="color: #0874a9; font-size:1.2em;" class="fa-solid fa-heart-crack stat-icon stat-off comment-icon"></i> 
        </div>
        <div class="detail-number" id="num-dislikes-comment-{{$comment->id}}">{{$post->ndislikes}}</div>
        @if($user->id === $publisher->id)
        <div class="comment-edit-container">
         <a id="comment-edit-button" href="<?php echo route('comments.edit', $comment->id)?>"> Edit Comment </a>
        </div>
        @else
        <div class="comment-edit-container comment-edit-container-off"></div>
        @endif
        @if($user->id === $publisher->id)
        <div class="comment-edit-container">
         <a id="comment-remove-button" href="<?php echo route('comments.delete', $comment->id)?>"> Delete Comment </a>
        </div>

        <!--
          <div id="comment-remove-container">
          <button id="comment-remove-button" onclick="sendDeleteCommentRequest()"> Delete Comment </button>
        </div>
        -->
        @else
          <div class="comment-edit-container comment-edit-container-off" ></div>
        @endif
      
      </div>
    </div>
  </label>
</div>
