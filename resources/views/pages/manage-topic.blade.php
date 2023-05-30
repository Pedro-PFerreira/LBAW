@extends('layouts.app')

@section('title', 'Manage Topic')

@section('content')

//TODO
<section id = "topics-container">

@foreach($topics as $topic)

   <h3>
      {{$topic->topicname}}
   </h3>

   <h4>  
      Do want to accept {{$topic->topicname}}?
   </h4>
   <div id="buttons-container">
      <form method="POST" class="approve_topic" action="<?php echo route('topic-update', $topic->id)?>">
         @method('PUT')
         @csrf
         <input type="hidden" name="topic" value="{{$topic->id}}">
         <button id= "btn-accepted" type="submit">
            <i style="font-size: 24px;color:green" class="fa-regular fa-circle-check"></i>
         </button>
      </form>

      <a id="btn-denied" class="button" href="<?php echo route('topic-destroy', $topic->id)?>">   <i style="font-size: 24px;color:rgb(204, 14, 14)" class="fa-solid fa-circle-xmark"></i></a>
   </div>
@endforeach

</section>

@endsection