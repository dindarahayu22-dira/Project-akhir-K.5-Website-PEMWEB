// Tampilkan/sembunyikan password
document.querySelectorAll('.eye').forEach(function (btn) {
  btn.addEventListener('click', function () {
    var input = btn.parentElement.querySelector('input');
    input.type = input.type === 'password' ? 'text' : 'password';
  });
});

// Konfirmasi sebelum aksi tertentu (mis. logout)
document.querySelectorAll('[data-confirm]').forEach(function (el) {
  el.addEventListener('click', function (ev) {
    if (!confirm(el.dataset.confirm)) ev.preventDefault();
  });
});

// Sembunyikan notifikasi sukses otomatis
setTimeout(function () {
  document.querySelectorAll('.alert.ok').forEach(function (a) { a.style.display = 'none'; });
}, 4000);
