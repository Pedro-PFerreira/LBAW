<?use Illuminate\Support\Facades\Auth;?>
<script>
  var user_id = {{ Auth::id() }};
  var publisher_user_id = {{Auth::id()}};
</script>
<div>
    <div id="header-container">
        <div class="search-container" id="header-search-container">
            <a href= "<?php echo route('search.show')?>" id = "header-search-icon" >
                <i style="font-size:20px;color:#30373a;" class="fa-solid fa-magnifying-glass"></i>
            </a>
            <input type="text" class="search" id="header-search" placeholder="Search" href=<?php echo URL::to('/') . '/api/search'?>>
        </div>
        @auth
            <div id="header-icons-container">
                <div id="header-new-post-container">
                    <a class= "button" id="header-new-post=button" href= "<?php echo route('article.create') ?>">Create</a>
                </div>
                <div value = {{Auth::user()->publisher()->get()[0]->id}} id="header-notifications-thumbnail">
                    <i id='header-notifications-button' class="fa-solid fa-bell notifications-off"></i>
                    <div id='new-notifications-number' class='hidden'> 1</div>
                </div>
                <div id="header-messages-thumbnail">
                    <i style="font-size: 24px;color:#015782" class="fa-solid fa-comment"></i>
                </div>
                <div id="header-profile-thumbnail">
                    <?php $publisher_id = Auth::user()->publisher()->get()[0]->id?>
                    <a href="<?php echo route('publisher.get', $publisher_id);?>">
                        <i style="font-size: 24px;color:#015782" class="fa-solid fa-user"></i>
                    </a>
                </div>
                <div id="logout-icon-container">
                    <a href="<?php echo route('logout')?>">
                        <i style="font-size: 24px;color:#30373a" class="fa-solid fa-right-from-bracket"></i>
                    </a>
                </div>
            </div>
        @else
            <div id="login-icon-container">
                <a href="<?php echo route('login')?>">
                    <i style="font-size: 24px;color:#30373a" class="fa-solid fa-right-to-bracket"></i>
                </a>
            </div>
        @endauth
    </div>
    <div class="body-frame-line"></div>
    <?php use App\Models\Notification;
    $notification = Notification::find(2);?>
    <div id='notifications-box' class='hidden'>
    </div>
</div>