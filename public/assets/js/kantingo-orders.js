// Interaksi halaman Riwayat Pesanan & Ulasan (JavaScript native)
document.addEventListener('DOMContentLoaded', () => {
    // Dialog "Detail Struk"
    document.querySelectorAll('[data-open]').forEach((btn) => {
        btn.addEventListener('click', () => document.getElementById(btn.dataset.open)?.showModal());
    });

    // Form ulasan
    const form = document.querySelector('[data-review-form]');
    if (!form) return;

    const labels = ['Pilih rating', 'Sangat Kurang', 'Kurang', 'Cukup', 'Puas', 'Sangat Puas'];
    const input = form.querySelector('[data-rating-input]');
    const label = form.querySelector('[data-rating-label]');
    const stars = [...form.querySelectorAll('[data-star]')];

    const paint = (value) => {
        stars.forEach((s) => {
            const on = Number(s.dataset.star) <= value;
            s.classList.toggle('on', on);
            s.setAttribute('aria-checked', Number(s.dataset.star) === value ? 'true' : 'false');
        });
        label.textContent = value ? `${value} dari 5 Bintang (${labels[value]})` : labels[0];
    };

    stars.forEach((s) => s.addEventListener('click', () => {
        input.value = s.dataset.star;
        paint(Number(input.value));
    }));
    paint(Number(input.value));

    // Penghitung karakter
    const comment = form.querySelector('[data-comment]');
    const count = form.querySelector('[data-count]');
    comment.addEventListener('input', () => (count.textContent = comment.value.length));

    // Nama file foto + batas 2 MB
    const photo = form.querySelector('[data-photo]');
    const photoName = form.querySelector('[data-photo-name]');
    photo.addEventListener('change', () => {
        const file = photo.files[0];
        if (file && file.size > 2 * 1024 * 1024) {
            photoName.textContent = 'Ukuran foto maksimal 2 MB.';
            photo.value = '';
            return;
        }
        photoName.textContent = file ? `Foto dipilih: ${file.name}` : '';
    });

    // Rating wajib diisi sebelum kirim
    form.addEventListener('submit', (e) => {
        if (!Number(input.value)) {
            e.preventDefault();
            label.textContent = 'Pilih rating terlebih dahulu';
            label.classList.add('shake');
            stars[0].focus();
        }
    });
});
