<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\Tenant;

class MenuController extends Controller
{
    public function index()
    {
        $q = trim((string) request('q'));
        $tenantId = request('tenant');

        $menus = Menu::with('tenant', 'category')->where('status', 'available')->where('stock', '>', 0)->whereHas('tenant', fn ($t) => $t->where('status', 'open'))
            ->when($q, fn ($x) => $x->where(fn ($w) => $w->where('name', 'like', "%$q%")
                ->orWhereHas('tenant', fn ($t) => $t->where('name', 'like', "%$q%"))))
            ->when($tenantId, fn ($x) => $x->where('tenant_id', $tenantId))
            ->orderBy('name')->get();

        return view('buyer.menu.index', ['active' => 'Menu', 'menus' => $menus, 'tenants' => Tenant::where('status','open')->orderBy('name')->get(), 'q' => $q, 'tenantId' => $tenantId]);
    }

    public function show(Menu $menu)
    {
        abort_unless($menu->status === 'available' && $menu->stock > 0 && $menu->tenant?->status === 'open', 404);
        return view('buyer.menu.show', ['active' => 'Menu', 'menu' => $menu->load('tenant', 'category'), 'reviews' => \App\Models\Review::with('user')->where('menu_id', $menu->id)->latest()->get(), 'relatedMenus' => Menu::where('tenant_id', $menu->tenant_id)->whereKeyNot($menu->id)->where('status','available')->where('stock','>',0)->take(3)->get()]);
    }
}
