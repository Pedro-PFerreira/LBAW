<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;
use Illuminate\Support\Facades\URL;

class NotificationsController extends Controller
{
    public function all($id){
        return json_encode(Notification::where('receiver_id', $id)
                                        ->where('viewed', 'true')
                                        ->orderBy('created_at', 'DESC')
                                        ->get());
    }   

    public function notifyNew($id){
        $notifications = Notification::where('receiver_id', $id)
                                        ->where('viewed', 'false')
                                        ->orderBy('created_at', 'DESC')
                                        ->get();
        $i = 0;
        $href = '';
        $response = [];
        foreach($notifications as $notification){
            switch($notification->notificationdescription){
                case 'Your article was commented':{
                    $href = URL::to('/') . '/article/' . $notification->content_id;
                    break;
                }
                case 'Your post has been approved':{
                    $href = URL::to('/') . '/article/' . $notification->content_id;
                    break;
                }
                case 'An article\'s pending approval':{
                    $href = URL::to('/') . '/article/' . $notification->content_id;
                    break;
                }
                case 'A topic is pending approval':{
                    $href = '';
                    break;
                }
                case 'Your topic has been approved':{
                    $href = URL::to('/') . '/topic/' . $notification->content_id;
                    break;
                }
                case 'You received a friend request':{
                    $href = URL::to('/') . '/publisher/' . $notification->sender_id;
                    break;
                }
                case 'You made a new friend':{
                    $href = URL::to('/') . '/publisher/' . $notification->sender_id;
                    break;
                }
                default: $href = ''; break;
            }
            $response[$i]['data'] = $notification;
            $response[$i]['href'] = $href;
            $i++;
        }
        return $response;
    }   

    public function seen(Request $request, $id){
        $input = json_decode($request->seen);
        $response = [];
        $i = 0;
        foreach($input as $notification){
            $response[$i] = Notification::where('id', $notification->data->id)
                                         ->update(['viewed' => 'true']);
            $i++;
        }
        return $response;
    }

    public function new(Request $request){
        $type = $request->type;
        $message;
        switch($type){
            case 'article-comment':{
                $message = 'Your article was commented';
                break;
            }
            case 'article-approved':{
                $message = 'Your post has been approved';
                break;
            }
            case 'article-pending':{
                $message = 'An article\'s pending approval';
                break;
            }
            case 'topic-pending':{
                $message = 'YA topic is pending approval';
                break;
            }
            case 'topic-aprooved':{
                $message = 'Your topic has been approved';
                break;
            }
            case 'friend-request':{
                $message = 'You received a friend request';
                break;
            }
            case 'friend-accepted':{
                $message = 'You made a new friend';
                break;
            }
        }
        return Notification::create([
            'receiver_id' => $request->receiver_id, 
            'sender_id' => $request->sender_id, 
            'content_id' => $request->content_id, 
            'notificationDescription' => $message, 
            'viewed' => 'false'
        ]);
    }


}
