@extends('layouts.auth')
@section('title', 'Daftar')

@section('content')
@php $role = old('role', 'buyer'); @endphp
<h1>Daftar Akun Baru</h1>
<p class="sub">Pilih peran, lalu daftar</p>

@if ($errors->any())
    <div class="error" style="margin-bottom:12px;">
        {{ $errors->first() }}
    </div>
@endif

<form method="POST" action="{{ route('register') }}">
    @csrf
    <input type="hidden" name="role" value="{{ $role }}">

    <div class="role-tabs" role="tablist">
        <button type="button" role="tab" data-role-tab="buyer" class="{{ $role === 'buyer' ? 'is-active' : '' }}"><x-icon name="cap"/> Pembeli</button>
        <button type="button" role="tab" data-role-tab="seller" class="{{ $role === 'seller' ? 'is-active' : '' }}"><x-icon name="store"/> Penjual</button>
    </div>

    <div class="lbl-row"><label for="name">Nama lengkap</label></div>
    <div class="field"><input id="name" name="name" value="{{ old('name') }}" placeholder="Budi Santoso" required><x-icon name="idcard" class="trail"/></div>
    @error('name') <p class="error">{{ $message }}</p> @enderror

    <div data-for="buyer" @if($role !== 'buyer') hidden @endif>
        <div class="lbl-row"><label for="nim">NIM</label></div>
        <div class="field"><input id="nim" name="nim" value="{{ old('nim') }}" placeholder="12345678"><x-icon name="hash" class="trail"/></div>
        @error('nim') <p class="error">{{ $message }}</p> @enderror
    </div>
    <div data-for="seller" @if($role !== 'seller') hidden @endif>
        <div class="lbl-row"><label for="tenant">Nama Kantin</label></div>
        <div class="field"><input id="tenant" name="tenant" value="{{ old('tenant') }}" placeholder="Kantin FILKOM"><x-icon name="hash" class="trail"/></div>
        @error('tenant') <p class="error">{{ $message }}</p> @enderror
    </div>

    <div class="lbl-row"><label for="email">Email</label></div>
    <div class="field"><input id="email" type="email" name="email" value="{{ old('email') }}" placeholder="email@kampus.ac.id" required><x-icon name="mail" class="trail"/></div>
    @error('email') <p class="error">{{ $message }}</p> @enderror

    <div class="lbl-row"><label for="password">Password</label></div>
    <div class="field">
        <input id="password" type="password" name="password" placeholder="Minimal 8 karakter" required>
        <button type="button" class="eye" data-toggle-pw aria-label="Tampilkan password"><x-icon name="eye" class="i-show"/><x-icon name="eyeoff" class="i-hide" hidden/></button>
    </div>
    @error('password') <p class="error">{{ $message }}</p> @enderror

    <div class="lbl-row"><label for="password_confirmation">Konfirmasi password</label></div>
    <div class="field">
        <input id="password_confirmation" type="password" name="password_confirmation" placeholder="Ulangi password" required>
        <button type="button" class="eye" data-toggle-pw aria-label="Tampilkan password"><x-icon name="eye" class="i-show"/><x-icon name="eyeoff" class="i-hide" hidden/></button>
    </div>

    <button class="btn-main">
        <span data-submit-text data-prefix="Daftar sebagai ">Daftar sebagai {{ $role === 'seller' ? 'Penjual' : 'Pembeli' }}</span>
        <x-icon name="arrow"/>
    </button>
    <p class="switch">Sudah punya akun? <a href="{{ route('login') }}" class="link-orange">Login</a></p>
</form>
@endsection