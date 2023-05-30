<div id = "section-container">
    <div class="user_information" data-id="{{$user->id}}">
            <label>
                <div id="publisher_name">{{$user->name}}</div>
                <div class="user-bio">
                    <div id="publisher_email">Email: {{$user->email}}</div>
                    <!--<span>{{$publisher->profilepic}}</span><br>TO DO-->
                    <div id="number_friends">Number of friends: {{$publisher->nfriends}}</div>
                    <div id="bio">Bio: {{$publisher->bio}}</div>
                    <div id="number_articles">Numbers of Articles: {{$publisher->publisherarticles}}</div>
                    <div id="reputation">Reputation: {{$publisher->reputation}}</div>
                </div>
                <a class="button" href="<?php echo route('publisher.edit', $publisher->id)?>"> Edit Profile </a>
                <a class="button" href="<?php echo route('publisher.articles', $publisher->id)?>"> See my articles </a>
            </label>  
    </div>
</div>