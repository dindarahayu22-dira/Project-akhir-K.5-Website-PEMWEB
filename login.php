<?php
require 'config.php';
redirect_if_logged();
$error = '';
$id = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = trim($_POST['id'] ?? '');
    $pass = $_POST['password'] ?? '';
    $user = $id !== '' ? find_user($id) : null;
    if ($user && password_verify($pass, $user['password'])) {
        session_regenerate_id(true);
        $_SESSION['nim'] = $user['nim'];
        header('Location: home.php');
        exit;
    }
    $error = 'Email/NIM atau password salah.';
}
page_start('Login');
?>
<div class="auth auth-split">
  <section class="auth-hero">
    <?= logo() ?>
    <p>Pesan Makanan Kantin Kampus,<br>Lebih Mudah!</p>
    <div class="hero-art">🏫🌳🍜</div>
  </section>
  <section class="auth-card">
    <h1>Masuk ke Akun Anda</h1>
    <p class="muted">Silakan login untuk melanjutkan</p>
    <?php if ($error): ?><div class="alert"><?= e($error) ?></div><?php endif; ?>
    <form method="post">
      <input type="text" name="id" placeholder="Email atau NIM" value="<?= e($id) ?>" required>
      <div class="pass"><input type="password" name="password" placeholder="Password" required><button type="button" class="eye" aria-label="Tampilkan password">👁</button></div>
      <div class="row"><label><input type="checkbox" name="remember"> Ingat saya</label><a href="#">Lupa password?</a></div>
      <button class="btn" type="submit">Login</button>
    </form>
    <p class="center small">Belum punya akun? <a href="register.php">Register</a></p>
  </section>
</div>
<?php page_end(); ?>
