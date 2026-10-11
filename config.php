<?php
session_start();
define('USERS_FILE', __DIR__ . '/users.json');

function e($s) { return htmlspecialchars((string)$s, ENT_QUOTES, 'UTF-8'); }
function load_users() {
    if (!file_exists(USERS_FILE)) return [];
    return json_decode(file_get_contents(USERS_FILE), true) ?: [];
}
function save_users($users) {
    file_put_contents(USERS_FILE, json_encode(array_values($users), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE), LOCK_EX);
}
function find_user($key) {
    foreach (load_users() as $u) {
        if (strcasecmp($u['email'], $key) === 0 || (string)$u['nim'] === (string)$key) return $u;
    }
    return null;
}
function current_user() { return isset($_SESSION['nim']) ? find_user($_SESSION['nim']) : null; }
function require_login() {
    $u = current_user();
    if (!$u) { header('Location: login.php'); exit; }
    return $u;
}
function redirect_if_logged() { if (current_user()) { header('Location: home.php'); exit; } }

function logo() { return '<div class="logo"><span class="logo-icon">🍴</span>KantinGo</div>'; }
function avatar($u) { return '<span class="avatar">' . e(strtoupper(mb_substr($u['nama'], 0, 1))) . '</span>'; }

function page_start($title) {
    echo '<!DOCTYPE html><html lang="id"><head><meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>' . e($title) . ' - KantinGo</title>
<link rel="stylesheet" href="style.css"></head><body>';
}
function page_end() { echo '<script src="script.js"></script></body></html>'; }

function app_start($user, $active, $title) {
    $nav = [
        'home' => ['Home', 'home.php', '🏠'], 'kantin' => ['Kantin', '#', '🏪'],
        'menu' => ['Menu', '#', '📋'], 'keranjang' => ['Keranjang', '#', '🛒'],
        'pesanan' => ['Pesanan', '#', '🧾'], 'pembayaran' => ['Pembayaran', '#', '💳'],
        'riwayat' => ['Riwayat', '#', '🕘'], 'profile' => ['Profile', 'profile.php', '👤'],
    ];
    page_start($title);
    echo '<div class="app"><header class="topbar">' . logo() .
        '<input class="search" type="search" placeholder="Cari makanan, minuman, atau kantin...">
        <span class="bell">🔔</span>' . avatar($user) . '</header><div class="body"><aside class="sidebar">';
    foreach ($nav as $k => $n) {
        echo '<a href="' . $n[1] . '" class="' . ($k === $active ? 'active' : '') . '"><span>' . $n[2] . '</span>' . $n[0] . '</a>';
    }
    echo '<a href="logout.php" class="logout" data-confirm="Yakin ingin keluar?"><span>🚪</span>Keluar</a></aside><main class="content">';
}
function app_end() { echo '</main></div></div>'; page_end(); }
