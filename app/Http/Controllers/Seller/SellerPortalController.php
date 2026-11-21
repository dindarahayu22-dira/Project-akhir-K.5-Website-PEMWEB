<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Menu;
use App\Models\Notification;
use App\Models\Order;
use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SellerPortalController extends Controller
{
    private function currentTenant(): Tenant { return Tenant::where('user_id',auth()->id())->firstOrFail(); }
    public function dashboard()
    {
        $tenant=$this->currentTenant(); $orders=$tenant->orders()->whereHas('payment',fn($q)=>$q->where('status','paid'))->with(['user','items','payment'])->latest()->take(5)->get();
        return view('seller.dashboard',['active'=>'Dashboard','tenant'=>$tenant,'activeMenusCount'=>$tenant->menus()->count(),'orders'=>$orders,'stats'=>['today'=>$tenant->orders()->whereHas('payment',fn($q)=>$q->where('status','paid'))->whereDate('created_at',today())->count(),'pending'=>$tenant->orders()->whereHas('payment',fn($q)=>$q->where('status','paid'))->whereIn('status',['new','processing'])->count(),'revenue'=>$tenant->orders()->whereHas('payment',fn($q)=>$q->where('status','paid'))->sum('total'),'menus'=>$tenant->menus()->count()]]);
    }
    public function tenant(){ $tenant=$this->currentTenant(); return view('seller.tenant',['active'=>'Kelola Tenant','tenant'=>$tenant,'activeMenusCount'=>$tenant->menus()->count()]); }
    public function updateTenant(Request $request)
    {
        $data=$request->validate(['name'=>['required','string','max:120'],'location'=>['nullable','string','max:120'],'opens_at'=>['nullable','date_format:H:i'],'closes_at'=>['nullable','date_format:H:i'],'description'=>['nullable','string','max:120'],'status'=>['required','in:open,closed'],'photo'=>['nullable','image','max:2048']]);
        $tenant=$this->currentTenant(); if($request->hasFile('photo')) { if($tenant->photo) Storage::disk('public')->delete($tenant->photo); $data['photo']=$request->file('photo')->store('tenants','public'); }
        $tenant->update($data); return back()->with('status','Informasi kantin berhasil disimpan.');
    }
    public function menus(){ $tenant=$this->currentTenant(); return view('seller.menus.index',['active'=>'Kelola Menu','tenant'=>$tenant,'menus'=>$tenant->menus()->with('category')->latest('id')->get()]); }
    public function menuForm(Request $request, ?Menu $menu=null){ $tenant=$this->currentTenant(); if($menu) abort_unless($menu->tenant_id===$tenant->id,404); return view('seller.menus.form',['active'=>'Kelola Menu','tenant'=>$tenant,'menu'=>$menu,'isEdit'=>(bool)$menu,'categories'=>Category::orderBy('name')->get()]); }
    public function saveMenu(Request $request, ?Menu $menu=null)
    {
        $tenant=$this->currentTenant(); if($menu) abort_unless($menu->tenant_id===$tenant->id,404);
        $data=$request->validate(['name'=>['required','string','max:120'],'description'=>['nullable','string','max:1000'],'price'=>['required','integer','min:1'],'stock'=>['required','integer','min:0'],'category'=>['nullable','string','max:60'],'status'=>['nullable','in:available,unavailable'],'photo'=>['nullable','image','max:2048']]);
        $category=null; if(!empty($data['category'])) $category=Category::firstOrCreate(['name'=>$data['category']]);
        $payload=['name'=>$data['name'],'description'=>$data['description']??null,'price'=>$data['price'],'stock'=>$data['stock'],'status'=>($data['stock']>0?($data['status']??'available'):'unavailable'),'category_id'=>$category?->id,'tenant_id'=>$tenant->id];
        if($request->hasFile('photo')) $payload['image']=$request->file('photo')->store('menus','public');
        if($menu) $menu->update($payload); else $menu=Menu::create($payload);
        return redirect()->route('seller.menus.index')->with('status','Menu berhasil disimpan.');
    }
    public function deleteMenu(Menu $menu){ $tenant=$this->currentTenant(); abort_unless($menu->tenant_id===$tenant->id,404); $menu->delete(); return back()->with('status','Menu berhasil dihapus.'); }
    public function orders(){ $tenant=$this->currentTenant(); return view('seller.orders',['active'=>'Pesanan Masuk','tenant'=>$tenant,'orders'=>$tenant->orders()->whereHas('payment',fn($q)=>$q->where('status','paid'))->with(['user','items','payment'])->latest()->get()]); }
    public function updateOrderStatus(Request $request, Order $order)
    {
        $tenant=$this->currentTenant(); abort_unless($order->tenant_id===$tenant->id,404);
        $data=$request->validate(['status'=>['required','in:processing,ready,completed,rejected']]);
        $allowed=['new'=>['processing','rejected'],'processing'=>['ready','rejected'],'ready'=>['completed']]; abort_unless(in_array($data['status'],$allowed[$order->status]??[],true),422,'Perubahan status tidak valid.');
        $order->update(['status'=>$data['status']]);
        if($data['status']==='rejected'){foreach($order->items as $item){if($item->menu_id){$item->menu()->increment('stock',$item->quantity);$item->menu()->update(['status'=>'available']);}}}
        $titles=['processing'=>'Pesanan diproses','ready'=>'Pesanan siap diambil','completed'=>'Pesanan selesai','rejected'=>'Pesanan ditolak'];
        Notification::create(['user_id'=>$order->user_id,'type'=>'order','title'=>$titles[$data['status']],'message'=>'Status pesanan '.$order->order_number.' diperbarui menjadi '.$titles[$data['status']].'.']);
        return back()->with('status','Status pesanan berhasil diperbarui.');
    }
    public function orderDetail(Order $order){$tenant=$this->currentTenant();abort_unless($order->tenant_id===$tenant->id,404);return view('seller.orders.show',['active'=>'Pesanan Masuk','order'=>$order->load(['user','tenant','items','payment'])]);}
    public function transactions(){ $tenant=$this->currentTenant(); return view('seller.transactions',['active'=>'Riwayat Transaksi','orders'=>$tenant->orders()->with(['user','payment'])->latest()->get()]); }
    public function notifications(){ $tenant=$this->currentTenant(); $notifications=Notification::where('user_id',$tenant->user_id)->latest()->get(); return view('seller.notifications',['active'=>'Notifikasi','notifications'=>$notifications]); }
    public function profile(){ $tenant=$this->currentTenant(); return view('seller.profile',['active'=>'Profile','tenant'=>$tenant,'user'=>auth()->user(),'orderCount'=>$tenant->orders()->count(),'menuCount'=>$tenant->menus()->count()]); }
}
