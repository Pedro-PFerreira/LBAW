@extends('layouts.app')

@section('content')
    <h1> Write your comment </h1>
    <form method="POST" action="{{route('comment.create')}}">
        <!-- <input type="hidden" name="name" value="<?php $publisher = DB::table('users')->select('name')->get()[0]?>"></input> !-->
        <input type="text" name="content-comment" placeholder="write what you're thinking" required>

        <button type="submit">
            Post Comment
        </button>
    </form>
@endsection