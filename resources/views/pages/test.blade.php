<?php

    use App\Models\Post;
    use App\Models\Publisher;
    use App\Models\Article;
    use App\Models\Comment;
    use App\Models\User;
    use App\Models\Administrator;
    use App\Models\Category;
    use App\Models\Topic;
    use App\Http\Controllers\PublisherController;
    use Illuminate\Http\Request;
    use App\Models\Relationship;
   
 var_dump(Auth::check())?>

@section('content')
    <article class="UserProfiles">
        <h3>Olá</h3>
        @foreach($publishers as $publisher)
        <?php var_dump($publisher);
        /*  
            $pub = Publisher::find($publisher);
            $user = $pub->user()->get()[0];
        */    
        ?>
        
            <section class="userProfile" data-id="{{$publisher}}">
                <label>      
                   
                    <!--<a class="button" href="<?php //echo route('relationship-update', $publisher)?>"> Accept </a>
                    <a class="button" href="<?php //echo route('relationship-destroy', $publisher)?>"> Refuse </a> -->
                </label>
            </section>
            
        @endforeach
    </article>

@endsection