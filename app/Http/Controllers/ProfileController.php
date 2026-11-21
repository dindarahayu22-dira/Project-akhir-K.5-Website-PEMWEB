<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function show()
    {
        /** @var User $user */
        $user = auth()->user();

        return view('buyer.profile.show', [
            'active' => 'Profile',
            'user'   => $user,
            'done'   => $user->orders()->where('status', 'completed')->count(),
            'cart'   => ($user->cart ? $user->cart->items()->count() : 0),
        ]);
    }

    public function update(Request $request)
    {
        /** @var User $user */
        $user = $request->user();

        $validated = $request->validate([
            'name'  => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user->id)],
            'phone' => ['nullable', 'string', 'max:30'],
        ]);

        $user->name  = $validated['name'];
        $user->email = $validated['email'];

        if (array_key_exists('phone', $validated)) {
            if (Schema::hasColumn('users', 'phone')) {
                $user->phone = $validated['phone'];
            } elseif (Schema::hasColumn('users', 'no_hp')) {
                $user->no_hp = $validated['phone'];
            }
        }

        $user->save();

        return back()->with('status', 'Profil berhasil diperbarui.');
    }
}