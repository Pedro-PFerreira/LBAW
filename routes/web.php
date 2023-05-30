<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;

Route::get('test', 'TestController@test');

//Post API
Route::post('api/post/{id}/vote', 'PostController@vote');
Route::post('api/post/{id}/comment', 'PostController@comment');

//Menu API
Route::get('breaking', 'ArticleController@breaking_news')->name('breaking_news');
Route::get('popular', 'ArticleController@popular')->name('popular');
Route::get('recent', 'ArticleController@recent')->name('recent');
Route::get('feed/{id}', 'PublisherController@feed')->name('feed');

Route::get('test', 'TestController@requests')->name('test');

//Notifications API
Route::get('/api/notification/{id}/new', 'NotificationsController@notifyNew');
Route::post('/api/notification/new', 'NotificationsController@new');
Route::get('/api/notification/{id}', 'NotificationsController@all');
Route::post('/api/notification/{id}/seen', 'NotificationsController@seen');

//Search API
Route::get('search', 'SearchController@show')->name('search.show');
Route::get('api/search/results', 'SearchController@results')->name('search.results');

Route::get('/', function() {
    if(!Auth::check()){
        return redirect(route('breaking_news'));
    }
    else{
        $publisher_id = Auth::user()->publisher()->get()[0]->id;;
        return redirect(route('feed', $publisher_id));
    }
})->name('main');

//Article API
Route::get('article/destroyed', 'ArticleController@destroyed');
Route::get('article/top', 'ArticleController@top')->name('top-articles');
Route::get('article/edit', 'ArticleController@edit')->name('edit-article');
Route::get('api/article/search', 'ArticleController@search')->name('article.search');
Route::get('api/article/fulltext', 'ArticleController@fulltext')->name('article.fulltext');
Route::post('api/article/{id}/veracity', 'ArticleController@veracity');
Route::resource('article', ArticleController::class)
    ->missing(function(Request $request){
        return Redirect::route('test');
    }
);

//Comments API
Route::post('api/comment', 'CommentController@store')->name('comment.create');
Route::get('api/comment/{id}/edit', 'CommentController@update')->name('comments.edit');
Route::get('api/comment/{id}/delete', 'CommentController@delete')->name('comments.delete');


//Relationship API

Route::put('api/relation/store', 'RelationshipController@store')->name('relationship-store');
Route::put('api/relation/{id}/update', 'RelationshipController@update')->name('relationship-update');
Route::delete('api/relation{id}/delete', 'RelationshipController@destroy')->name('relationship-delete');

//Router API

Route::post('api/topic/propose', 'TopicController@store')->name('send-propose-topic');
Route::put('api/topic/{id}/update', 'TopicController@update')->name('topic-update');
Route::get('api/topic/{id}/destroy', 'TopicController@destroy')->name('topic-destroy');


//User API
Route::get('publishers', 'PublisherController@all')->name('publishers');
Route::get('publisher/{id}', 'PublisherController@profile')->name('publisher.get');
Route::get('publisher/{id}/edit', 'PublisherController@edit')->name('publisher.edit');
Route::get('publisher/{id}/friends', 'PublisherController@friends')->name('publisher.friends');
Route::get('publisher/{id}/articles', 'PublisherController@articles')->name('publisher.articles');
Route::get('publisher/{id}/requests', 'PublisherController@requests')->name('publisher.requests');
Route::get('publisher/{id}/pending', 'PublisherController@pending')->name('publisher.pending');
Route::get('publisher/{id}/proposetopic', 'PublisherController@propose_topic')->name('publisher.propose-topic');
Route::get('publisher/{id}/feed', 'PublisherController@manage_feed')->name('publisher.manage-feed');
Route::put('api/publisher/{id}/ban', 'PublisherController@ban')->name('publisher.ban');
Route::put('api/publisher/{id}/warn', 'PublisherController@warn')->name('publisher.warn');
Route::post('api/publisher/{id}/topics', 'PublisherController@topics');
// mudar quando se implementar AJAX
Route::get('api/publisher/{id}/delete', 'PublisherController@delete')->name('publisher.delete');
Route::delete('api/publisher/{id}/deleteaccount', 'PublisherController@deleteaccount')->name('publisher.deleteAccount');
Route::apiResource('api/publisher', PublisherController::class);

// Authentication
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

// Administrator API
Route::get('admin/delete', 'AdministratorController@deleteUser')->name('admin');
Route::get('admin/', 'AdministratorController@profile')->name('admin-profile');
Route::get('admin/veracity', 'AdministratorController@veracity');
Route::get('admin/manage', 'AdministratorController@manage')->name('manage-topic');


//Static Pages
Route::get('help', 'StaticController@help')->name('help');
Route::get('about', 'StaticController@about')->name('about');
Route::get('contacts', 'StaticController@contacts')->name('contacts');


//Categories API
Route::get('categories', 'CategoryController@index')->name('categories');
Route::get('categories/{id}/articles', 'CategoryController@articles')->name('categories.articles');

//Topic
Route::get('topic/{id}', 'TopicController@articles')->name('topic');


//Publisher Profile

Route::get('publisher', function() {
    $user = App\Models\Publisher::get();
    return $user;
});
