@extends('layouts.app')

@section('title', 'Friend Request')


@section('content')
    <article class="UserProfiles">
        @foreach($publishers as $publisher)
            <?php
                $user = Publisher::find($publisher)->user()->get()[0];
            ?>
            <section class="userProfile" data-id="{{$user->id}}">
                <label>      
                    <span>This user wants to be your friend: {{ $user->name }}</span><br>
                    <a class="button" href="<?php echo route('relationship-update', $publisher->id)?>"> Accept </a>
                    <a class="button" href="<?php echo route('relationship-destroy', $publisher->id)?>"> Refuse </a>
                </label>
            </section>
            
        @endforeach
    </article>

@endsection