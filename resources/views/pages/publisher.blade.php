@extends('layouts.app')

<script>
    let publisher_friend_id = {{$user->id}};
</script>


@section('content')
<div class="info-container">  
    <section class="user_information" data-id="{{$user->id}}">
            <label>
                <div id="publisher_name"><h2> {{$user->name}} </h2>
                
                </div>
                @if ($publisher->profilepic === '')
                    <img id = "profile-image" src = "{{asset('images/user_default.jpg')}}" alt = "User default">
                @else
                    <img id = "profile-image" src = "{{asset('images/'. $publisher->profilepic)}}" alt = "Profile Picture"> 
                @endif
                <div class="user-bio">
                    
                    <div id="publisher_email">Email: {{$user->email}}</div>
                    <div id="number_friends">Number of friends: {{$publisher->nfriends}}</div>
                    <div id="bio">Bio: {{$publisher->bio}}</div>
                    <div id="number_articles">Numbers of Articles: {{$publisher->publisherarticles}}</div>
                    <div id="reputation">Reputation: {{$publisher->reputation}}</div>
                </div>
                <div id = "buttons-container">
                    <div id = "see-articles-profile-container">
                        <a class="button" href="<?php echo route('publisher.articles', $publisher->id)?>"> See articles </a>
                    </div>
                    @if (Auth::check() && (Auth::id() === $user->id))

                    <div id= "manage-feed-container">
                        <a class="button" href="<?php echo route('publisher.manage-feed', $publisher->id)?>">Manage Feed </a>

                    </div>

                    <div id = "edit-profile-container">
                        <a class="button" href="<?php echo route('publisher.edit', $publisher->id)?>"> Edit Profile </a>
                    </div>
                    <div id = "delete-account-container">
                        <form action="<?php echo route('publisher.deleteAccount', $publisher->id)?>" method="POST">
                            {{ method_field('DELETE') }}
                            @csrf

                            <button class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                    @elseif (Auth::check() && (Auth::id() != $user->id))
                    <div id="block-and-friend-container">
                        <div id="block-container">

                            <form action="<?php echo route('relationship-store')?>" method = "POST">
                                @method('PUT')
                                @csrf
                                <?php 
                                    $publisher1 = DB::table('publishers')->select('id')->where('user_id', Auth::user()->id)->get()[0]->id;
                                    $publisher2 = $publisher->id;
                                ?>
                                <input type="hidden" name="publisher1" value="<?= $publisher1?>">

                                <input type="hidden" name="publisher2" value="<?= $publisher2?>">

                                <input type="hidden" name="reltype" value="Block">
                                

                                <a class= "button" href="<?php echo route('feed')?>">
                                    <button id = "btn-block" type="submit">Block</button>
                                </a>
                            </form>
                        </div>

                        <div id="friend-request-container">
                            <form action="<?php echo route('relationship-store')?>" method = "POST">
                                @method('PUT')
                                @csrf    
                                <?php 
                                    $publisher1 = DB::table('publishers')->select('id')->where('user_id', Auth::user()->id)->get()[0]->id;
                                    $publisher2 = $publisher->id;
                                ?>
                                <input type="hidden" name="publisher1" value="<?= $publisher1?>">

                                <input type="hidden" name="publisher2" value="<?= $publisher2?>">

                                <input type="hidden" name="reltype" value="Pending">

                                <button id = "btn-friend-request" type="submit">
                                    Send Friend Request
                                </button>
                            </form>
                        </div>
                    </div>

                    @endif
                </div>
            </label>
    </section>
</div>
@endsection