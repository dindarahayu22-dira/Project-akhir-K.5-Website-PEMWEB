<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ReviewController extends Controller
{
    private const WEEKLY_GOAL=3;
    public function create(Order $order)
    {
        abort_unless((int)$order->user_id===(int)auth()->id(),403);
        abort_unless($order->status==='completed',422,'Pesanan harus selesai sebelum diulas.');
        $mine=Review::where('user_id',auth()->id());
        $review=Review::where('order_id',$order->id)->where('user_id',auth()->id())->first();
        return view('buyer.reviews.create',['active'=>'Riwayat','order'=>$order->load('tenant','items.menu'),'review'=>$review,'tags'=>Review::TAGS,'myReviews'=>(clone $mine)->latest()->take(2)->get(),'myCount'=>(clone $mine)->count(),'weeklyCount'=>(clone $mine)->where('created_at','>=',now()->startOfWeek())->count(),'weeklyGoal'=>self::WEEKLY_GOAL]);
    }
    public function store(Request $request, Order $order)
    {
        abort_unless((int)$order->user_id===(int)auth()->id(),403);
        abort_unless($order->status==='completed',422,'Pesanan harus selesai sebelum diulas.');
        $data=$request->validate(['rating'=>['required','integer','between:1,5'],'tags'=>['nullable','array'],'tags.*'=>[Rule::in(Review::TAGS)],'comment'=>['nullable','string','max:300'],'photo'=>['nullable','image','max:2048']]);
        if($request->hasFile('photo')) $data['photo']=$request->file('photo')->store('reviews','public');
        Review::updateOrCreate(['order_id'=>$order->id,'user_id'=>auth()->id()],$data+['tenant_id'=>$order->tenant_id]);
        $avg=Review::where('tenant_id',$order->tenant_id)->avg('rating');
        $order->tenant()->update(['rating'=>round((float)$avg,1)]);
        return redirect()->route('buyer.orders.index',['tab'=>'completed'])->with('status','Ulasan terkirim. Terima kasih!');
    }
}
