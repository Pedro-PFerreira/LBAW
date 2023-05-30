@extends('layouts.app')

<script>
    let publisher_id = {{Auth::user()->publisher()->get()[0]->id}};

</script>
<?php $count=0?>

@section('content')
    <div class='info-container' id='manage-feed-info-container'>
        <div id='manage-topic-header'>
            <h1>
                Select your desired topics:
            </h1>
            <h3 id='count-selected-topics'>
                <div id='num-selected-topics'>
                     0
                </div>
                <div>
                    /15
                </div>
            </h3>
        </div>
        <div id='topic-options'>
            @foreach($allTopics as $topics)
                <div id='topics-container-{{$count}}' class='topics-container'>
                    @foreach($topics as $topic)
                        <div id='topic-{{$topic->id}}-container'>
                            @if($topic['selected'])
                                <button value='{{$topic->id}}' id='topic-{{$topic->id}}' class='selected-topic topic-button'>{{$topic->topicname}}</button>
                            @else
                                <button value='{{$topic->id}}' id='topic-{{$topic->id}}' class='unselected-topic topic-button'>{{$topic->topicname}}</button>
                            @endif
                        </div>
                    @endforeach
                </div>
                <?php $count++; ?>
            @endforeach
        </div>
        <div id='manage-topics-rejected' class='hidden'>Too many topics!</div>
        <button id="manage-topics-apply">Apply</button>
    </div>
@endsection