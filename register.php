<?php
require 'config.php';
redirect_if_logged();
$errors = [];
$f = ['nama' => '', 'nim' => '', 'email' => ''];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($f as $k => $_) $f[$k] = trim($_POST[$k] ?? '');
    $pass = $_POST['password'] ?? '';
    $conf = $_POST['konfirmasi'] ?? '';
    if ($f['nama'] === '') $errors[] = 'Nama lengkap wajib diisi.';
    if (!preg_match('/^\d{5,15}$/', $f['nim'])) $errors[] = 'NIM harus berupa angka (5-15 digit).';
    if (!filter_var($f['email'], FILTER_VALIDATE_EMAIL)) $errors[] = 'Format email tidak valid.';
    if (strlen($pass) < 6) $errors[] = 'Password minimal 6 karakter.';
    if ($pass !== $conf) $errors[] = 'Konfirmasi password tidak sama.';
    if (!$errors) {
        foreach (load_users() as $u) {
            if (strcasecmp($u['email'], $f['email']) === 0) $errors[] = 'Email sudah terdaftar.';
            if ($u['nim'] === $f['nim']) $errors[] = 'NIM sudah terdaftar.';
        }
    }
    if (!$errors) {
        $users = load_users();
        $users[] = ['nama' => $f['nama'], 'nim' => $f['nim'], 'email' => $f['email'], 'hp' => '',
                    'status' => 'Mahasiswa', 'password' => password_hash($pass, PASSWORD_DEFAULT), 'created_at' => date('c')];
        save_users($users);
        $_SESSION['nim'] = $f['nim'];
        header('Location: home.php');
        exit;
    }
}
page_start('Register');
?>
<div class="auth auth-center">
  <?= logo() ?>
  <section class="auth-card wide">
    <h1 class="center">Daftar Akun Baru</h1>
    <p class="muted center">Bergabung dan nikmati kemudahan pesan makanan di kantin kampus</p>
    <?php foreach ($errors as $er): ?><div class="alert"><?= e($er) ?></div><?php endforeach; ?>
    <form method="post">
      <input type="text" name="nama" placeholder="Nama Lengkap" value="<?= e($f['nama']) ?>" required>
      <input type="text" name="nim" placeholder="NIM" value="<?= e($f['nim']) ?>" required>
      <input type="email" name="email" placeholder="Email" value="<?= e($f['email']) ?>" required>
      <div class="pass"><input type="password" name="password" placeholder="Password" required><button type="button" class="eye" aria-label="Tampilkan password">👁</button></div>
      <div class="pass"><input type="password" name="konfirmasi" placeholder="Konfirmasi Password" required><button type="button" class="eye" aria-label="Tampilkan password">👁</button></div>
      <button class="btn" type="submit">Daftar</button>
    </form>
    <p class="center small">Sudah punya akun? <a href="login.php">Login</a></p>
  </section>
</div>
<?php page_end(); ?>
