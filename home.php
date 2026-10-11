<?php
require 'config.php';
$user = require_login();
$kantin = [['Kantin FIK', '4.5', 120, '50 m', '🍽️'], ['Kantin FEB', '4.4', 98, '100 m', '🥗'], ['Kantin FT', '4.6', 143, '150 m', '🍜']];
$menu = [['Nasi Goreng', 12000, '🍛'], ['Mie Ayam', 10000, '🍜'], ['Es Teh Manis', 5000, '🧋'], ['Jus Alpukat', 8000, '🥤'], ['Siomay', 9000, '🥟']];
app_start($user, 'home', 'Home');
?>
<div class="banner">
  <div>
    <h1>Makan Enak<br>di Kantin Kampus<br>Jadi Lebih Mudah!</h1>
    <a class="btn btn-white" href="#">Pesan Sekarang</a>
  </div>
  <div class="banner-art">🍛🥗🍜</div>
</div>

<div class="section-head"><h2>Kantin Terdekat</h2><a href="#">Lihat Semua</a></div>
<div class="grid">
  <?php foreach ($kantin as $k): ?>
  <article class="card">
    <div class="thumb"><?= $k[4] ?></div>
    <h3><?= e($k[0]) ?></h3>
    <p class="small muted">★ <?= $k[1] ?> (<?= $k[2] ?>) &nbsp; 📍 <?= $k[3] ?></p>
  </article>
  <?php endforeach; ?>
</div>

<div class="section-head"><h2>Menu Populer</h2><a href="#">Lihat Semua</a></div>
<div class="grid grid-5">
  <?php foreach ($menu as $m): ?>
  <article class="card">
    <div class="thumb small-thumb"><?= $m[2] ?></div>
    <h3><?= e($m[0]) ?></h3>
    <p class="price">Rp <?= number_format($m[1], 0, ',', '.') ?></p>
  </article>
  <?php endforeach; ?>
</div>
<?php app_end(); ?>
