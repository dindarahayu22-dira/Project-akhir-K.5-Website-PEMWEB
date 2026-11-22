<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Models\Notification;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications=Notification::where('user_id',auth()->id())->latest()->get();
        $items=$notifications->map(fn($n)=>(object)['id'=>$n->id,'type'=>$n->type==='payment'?'success':($n->is_read?'success':'processing'),'title'=>$n->title,'description'=>$n->message,'time'=>$n->created_at->diffForHumans(),'unread'=>!$n->is_read]);
        return view('buyer.notifications.index',['active'=>'Notifikasi','notifications'=>$notifications,'items'=>$items]);
    }
    public function readAll(){Notification::where('user_id',auth()->id())->where('is_read',false)->update(['is_read'=>true]);return back()->with('status','Notifikasi ditandai sudah dibaca.');}
}
