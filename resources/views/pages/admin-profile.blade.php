@extends('layouts.app')


@section('content')

    <section class="admin-information" data-id="{{$user->id}}">
            <label>
                <div id="admin-name">
                    <h2> {{$user->name}} </h2>
                    <h3> This user is an administrator </h3>
                </div>
                @if (Auth::check() && (Auth::id() === 1))
                    <div id = "manage-publishers-container">
                        <a class="button" href="<?php echo route('admin', $user->id)?>"> Manage Publishers </a>
                    </div>
                    <div id = "manage-topics-container">
                        <a class="button" href="<?php echo route('manage-topic', $user->id)?>"> Manage Topics </a>
                    </div>
                @endif
            </label>
    </section>
@endsection