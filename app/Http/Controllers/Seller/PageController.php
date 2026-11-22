<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;

/** Halaman penjual yang dikerjakan anggota lain (PK, LS, BA, SK). Ganti route-nya saat modul sudah jadi. */
class PageController extends Controller
{
    public function soon(string $title)
    {
        return view('pages.soon', ['active' => $title, 'title' => $title]);
    }
}
