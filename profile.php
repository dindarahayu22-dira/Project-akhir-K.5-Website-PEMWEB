//rr//
<?php
require 'config.php';
$user = require_login();
$edit = isset($_GET['edit']);
$errors = [];
$ok = isset($_GET['ok']);

//rr//
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $edit = true;
    $nama = trim($_POST['nama'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $hp = trim($_POST['hp'] ?? '');
    $new = $_POST['new_password'] ?? '';

    //rr
    if ($nama === '') $errors[] = 'Nama lengkap wajib diisi.';
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Format email tidak valid.';
    if ($hp !== '' && !preg_match('/^[0-9+\s-]{8,16}$/', $hp)) $errors[] = 'Nomor HP tidak valid.';
    if ($new !== '' && strlen($new) < 6) $errors[] = 'Password baru minimal 6 karakter.';
    
    foreach (load_users() as $u) {
        if ($u['nim'] !== $user['nim'] && strcasecmp($u['email'], $email) === 0) $errors[] = 'Email sudah dipakai akun lain.';
    }
    if (!$errors) {
        $users = load_users();
        foreach ($users as &$u) {
            if ($u['nim'] === $user['nim']) {
                $u['nama'] = $nama; $u['email'] = $email; $u['hp'] = $hp;
               
                if ($new !== '') $u['password'] = password_hash($new, PASSWORD_DEFAULT);
            }
        }
        unset($u);
        save_users($users);
        
        header('Location: profile.php?ok=1');
        exit;
    }
    $user['nama'] = $nama; $user['email'] = $email; $user['hp'] = $hp;
}
app_start($user, 'profile', 'Profile');
?>
<h1>Profil Pengguna</h1>
<section class="panel">
  <div class="profile-head">
    <span class="avatar big"><?= e(strtoupper(mb_substr($user['nama'], 0, 1))) ?></span>
    <div><h2><?= e($user['nama']) ?></h2><p class="small muted">NIM <?= e($user['nim']) ?><br><?= e($user['status'] ?? 'Mahasiswa') ?></p></div>
  </div>
  <h3>Informasi Akun</h3>
  <?php if ($ok): ?><div class="alert ok">Profil berhasil diperbarui.</div><?php endif; ?>
  <?php foreach ($errors as $er): ?><div class="alert"><?= e($er) ?></div><?php endforeach; ?>

  <?php if ($edit): ?>
  <form method="post" class="info-form">
    <label>Nama Lengkap<input type="text" name="nama" value="<?= e($user['nama']) ?>" required></label>
    <label>Email<input type="email" name="email" value="<?= e($user['email']) ?>" required></label>
    <label>No. HP<input type="text" name="hp" value="<?= e($user['hp'] ?? '') ?>" placeholder="0812 3456 7890"></label>
    <label>Password baru (kosongkan jika tidak diubah)<input type="password" name="new_password"></label>
    <div class="row"><a class="btn btn-ghost" href="profile.php">Batal</a><button class="btn" type="submit">Simpan</button></div>
  </form>
  <?php else: ?>
  <dl class="info">
    <div><dt>Nama Lengkap</dt><dd><?= e($user['nama']) ?></dd></div>
    <div><dt>Email</dt><dd><?= e($user['email']) ?></dd></div>
    <div><dt>No. HP</dt><dd><?= e($user['hp'] ?: '-') ?></dd></div>
    <div><dt>Password</dt><dd><a href="profile.php?edit=1">Ubah Password</a></dd></div>
  </dl>
  <a class="btn" href="profile.php?edit=1">Edit Profil</a>
  <?php endif; ?>
</section>
<?php app_end(); ?>
