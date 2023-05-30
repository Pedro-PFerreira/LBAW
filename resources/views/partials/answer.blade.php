<?php   
  $post = $comment->post()->get()[0];
  $publisher = $post->publisher()->get()[0];
  $user = $publisher->user()->get()[0];
?>

<div class="anwser" data-id="{{$comment->id}}">
    <label>
        <div id="answer-container">
            <div id="answer-publisher">
                <a id="answer-publisher-id" href="<?= route('publisher.get', $publisher->id)?>">{{$user->name}}</a>
            </div>
            <div id="answer-data">
                <div id="answer-data-id" style="color:red;">{{$post->created_at}}</div>
            </div>
            <div id="answer-content">
                <div id="answer-content-id" style="color:red;">{{$comment->content}}</div>
            </div>
        </div>

        <div id="answer-votes">
            <div id = "likes-icon-answer"> 
                <i style="color: #0874a9; font-size:1.2em;" class="fa-solid fa-heart"></i>
            </div>
            <div class="detail-number" id="num-likes-answer">{{$post->nlikes}}</div>
            <div id = "dislikes-icon-answer">
                <i style="color: #0874a9; font-size:1.2em;" class="fa-solid fa-heart-crack"></i> 
            </div>
            <div class="detail-number" id="num-dislikes-answer">{{$post->ndislikes}}</div>
        </div>
    </label>
</div>