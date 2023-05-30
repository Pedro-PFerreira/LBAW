@extends('layouts.app')

@section('title', 'Admin Profile')

@section('content')
    <article class="UserProfiles">
        @foreach($publishers as $publisher)
            <?php
                $user = $publisher->user()->get()[0];
            ?>
            <section class="userProfile" data-id="{{$user->id}}">
            <label>      
            <span>User name: {{ $user->name }}</span><br>
            <a class="button" href="<?php echo route('publisher.delete', $publisher->id)?>"> Delete </a>
            </label>
            </section>
            
        @endforeach
    </article>

@endsection