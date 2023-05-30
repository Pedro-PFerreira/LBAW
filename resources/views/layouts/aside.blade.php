<? use Illuminate\Support\Facades\Auth; ?>
<div id="aside-container">
    <div id="aside-logo-container">
        <a id="aside-logo-anchor" href= "/">            
            <h1 a="<?php echo URL::to('/')?>" id="aside-logo-header">WhatsNew</h1>
        </a>
    </div>
    <div id="aside-buttons">
        <div class="aside-button-container" id="aside-categories-container">
            <a class="aside-button" href=<?php echo route('categories')?>>Categories</a>
            <div class="aside-button-line"></div>
        </div>
        <div class="aside-button-container" id="aside-breaking-news-container">
            <a class="aside-button" href=<?php echo route('breaking_news')?>>Breaking News</a>
            <div class="aside-button-line"></div>
        </div>
        <div class="aside-button-container" id="aside-most-popular-container">
            <a class="aside-button" href=<?php echo route('popular')?>>Most Popular</a>
            <div class="aside-button-line"></div>
        </div>
        <div class="aside-button-container" id="aside-most-recent-container">
            <a class="aside-button" href=<?php echo route('recent')?>>Most Recent</a>
            <div class="aside-button-line"></div>
        </div>
        <div class="aside-button-container" id="aside-favorites-container">
            <a class="aside-button" href=<?php echo route('publishers')?>>Publishers</a>
            <div class="aside-button-line"></div>
        </div>
        @if(Auth::check())
        <div class="aside-button-container" id="aside-propose-topic-container">
            <?php $publisher_id = Auth::user()->publisher()->get()[0]->id;?>
            <a class="aside-button" href=<?php echo route('publisher.propose-topic', $publisher_id)?>>Propose Topic</a>
            <div class="aside-button-line"></div>
        </div>
        <div class="aside-button-container" id="aside-reports-container">
            <a class="aside-button" href=<?php echo route('publisher.pending', $publisher_id)?>>Pending Articles</a>
            <div class="aside-button-line"></div>
        </div>
        @endif
        <div class="aside-button-container" id="aside-help-container">
                <a class="aside-button" href=<?php echo route('help')?>>Help</a>
            <div class="aside-button-line"></div>
        </div>
    </div>
    <div id="copyright-footer">
            &copy lbaw2231
    </div>
</div>