@extends('layouts.auth')
@section('title', 'Masuk')

@section('content')
@php $role = old('role', 'buyer'); @endphp
<h1>Masuk ke Akun Anda</h1>
<p class="sub">Pilih peran, lalu login untuk melanjutkan</p>

<form method="POST" action="{{ route('login') }}">
    @csrf
    <input type="hidden" id="loginRoleInput" name="role" value="{{ $role }}">

    <div class="role-tabs" role="tablist">
        <button type="button" role="tab" data-role-tab="buyer" class="{{ $role === 'buyer' ? 'is-active' : '' }}" onclick="setLoginRole('buyer', this)"><x-icon name="cap"/> Pembeli</button>
        <button type="button" role="tab" data-role-tab="seller" class="{{ $role === 'seller' ? 'is-active' : '' }}" onclick="setLoginRole('seller', this)"><x-icon name="store"/> Penjual</button>
    </div>

    <div class="lbl-row"><label for="login">Email atau NIM</label><small>Mahasiswa / Dosen / Penjual</small></div>
    <div class="field">
        <x-icon name="idcard" class="lead"/>
        <input id="login" name="login" value="{{ old('login') }}" placeholder="budi@email.com" autocomplete="username" autofocus required>
    </div>
    @error('login') <p class="error">{{ $message }}</p> @enderror

    <div class="lbl-row"><label for="password">Password</label><a href="#" class="link-orange">Lupa Password?</a></div>
    <div class="field">
        <x-icon name="lock" class="lead"/>
        <input id="password" type="password" name="password" placeholder="Masukkan password" autocomplete="current-password" required>
        <button type="button" class="eye" data-toggle-pw aria-label="Tampilkan password">
            <x-icon name="eyeoff" class="i-show"/><x-icon name="eye" class="i-hide" hidden/>
        </button>
    </div>
    @error('password') <p class="error">{{ $message }}</p> @enderror

    <label class="remember"><input type="checkbox" name="remember" value="1" checked><span>Ingat sesi saya di perangkat ini</span></label>

    <button class="btn-main">
        <span id="loginSubmitText" data-submit-text data-prefix="Masuk sebagai ">Masuk sebagai {{ $role === 'seller' ? 'Penjual' : 'Pembeli' }}</span>
        <x-icon name="arrow"/>
    </button>

    <p class="switch">Belum punya akun? <a href="{{ route('register') }}" class="link-orange">Daftar</a></p>
    <p class="demo">Demo: budi@email.com (pembeli) · sari@kantin.test (penjual) · password rahasia123</p>
</form>

<script>
    function setLoginRole(role, btn) {
        const input = document.getElementById('loginRoleInput');
        if (input) input.value = role;

        document.querySelectorAll('[data-role-tab]').forEach(tab => {
            tab.classList.toggle('is-active', tab === btn || tab.getAttribute('data-role-tab') === role);
        });

        const submitText = document.getElementById('loginSubmitText');
        if (submitText) {
            submitText.textContent = 'Masuk sebagai ' + (role === 'seller' ? 'Penjual' : 'Pembeli');
        }
    }
</script>
@endsection