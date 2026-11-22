<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\Tenant;
use App\Models\User;

class HomeController extends Controller
{
    public function index()
    {
        /** @var User $user */
        $user = auth()->user();

        return view('buyer.home.index', [
            'active'  => 'Home',
            'stats'   => [
                'active' => $user->orders()->whereIn('status', ['new', 'processing', 'ready'])->count(),
                'cart'   => $user->cart ? $user->cart->items()->count() : 0,
                'total'  => $user->orders()->count(),
            ],
            'tenants' => Tenant::where('status', 'open')->whereHas('menus', fn ($q) => $q->where('status', 'available')->where('stock', '>', 0))->withCount(['menus' => fn ($q) => $q->where('status', 'available')->where('stock', '>', 0)])->orderByDesc('rating')->get(),
            'popular' => Menu::with('tenant')->where('status', 'available')->where('stock', '>', 0)->whereHas('tenant', fn ($q) => $q->where('status', 'open'))->orderByDesc('stock')->take(5)->get(),
        ]);
    }
}