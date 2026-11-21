@extends('layouts.seller')
@section('title', $title)
@section('content')
<div class="page-head"><div><h1>{{ $title }}</h1></div></div>
<div class="card empty"><h2>Halaman ini sedang dikerjakan anggota kelompok</h2>
    <p class="muted">Ganti route-nya di <code>routes/web.php</code> setelah modul {{ $title }} selesai.</p>
    <a class="btn btn-primary" href="{{ route('seller.dashboard') }}">Kembali ke Dashboard</a></div>
@endsection
