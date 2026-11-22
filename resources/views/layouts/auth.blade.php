<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') · KantinGo</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/auth.css') }}">
</head>
<body>
<main class="auth-card">
    <section class="auth-brand">
        <div class="auth-logo"><span class="logo-mark">K</span><span class="logo-text">KantinGo</span></div>
        <h2>Pesan Makanan Kantin Kampus, Lebih Mudah!</h2>
        <p>Hindari antrean panjang jam istirahat kuliah. Ambil pesananmu hangat tepat waktu.</p>
        <img src="{{ asset('assets/images/kantin.png') }}" alt="Kantin Universitas KantinGo">
    </section>

    <section class="auth-form">@yield('content')</section>
</main>

<script>
    // Tab peran Pembeli / Penjual
    document.querySelectorAll('[data-role-tab]').forEach(function (tab) {
        tab.addEventListener('click', function () {
            var role = tab.dataset.roleTab;
            document.querySelector('[name=role]').value = role;
            document.querySelectorAll('[data-role-tab]').forEach(function (t) {
                var on = t === tab;
                t.classList.toggle('is-active', on);
                t.setAttribute('aria-selected', on ? 'true' : 'false');
            });
            document.querySelectorAll('[data-for]').forEach(function (el) { el.hidden = el.dataset.for !== role; });
            var label = document.querySelector('[data-submit-text]');
            if (label) label.textContent = label.dataset.prefix + (role === 'seller' ? 'Penjual' : 'Pembeli');
        });
    });

    // Tampilkan / sembunyikan password
    document.querySelectorAll('[data-toggle-pw]').forEach(function (btn) {
        btn.addEventListener('click', function () {
            var input = btn.parentElement.querySelector('input');
            var show = input.type === 'password';
            input.type = show ? 'text' : 'password';
            btn.querySelector('.i-show').hidden = show;
            btn.querySelector('.i-hide').hidden = !show;
            btn.setAttribute('aria-label', show ? 'Sembunyikan password' : 'Tampilkan password');
        });
    });
</script>
</body>
</html>
