@extends('layouts.app')

@section('title', 'Edit Profile')

@section('content')
<section id="edit_publisher">
  <article class="edit_profile">
    <form method = "POST" class="profile_edition" action="<?php echo route('publisher.update', $publisher->id)?>" enctype="multipart/form-data">
      @method('PUT')
      @csrf
      Name:
      <input type="text" name="nome" value="<?php echo $user->name?>">
      Email:
      <input type="text" name="email" value="<?php echo $user->email?>">
      <!--<input type="text" name="nome" value=""> //TODO Profile Pic-->
      Bio:
      <input type="text" name="bio" value="<?php echo $publisher->bio?>">
      New Profile Picture:
      <input type="file" name="profilepic" value="<?php echo $publisher->profilepic?>">
      <button type="Submit">Save</button>
    </form>
  </article>
</section>
@endsection