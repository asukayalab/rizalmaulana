# Rizal Maulana — Falcon child theme

Beranda WordPress mengikuti desain `beranda rm 01.pdf` dan skenario motion pengguna, dengan template maintenance dari `trialrizal` alpha.5, dikoreksi mengikuti acuan standalone `index.html` pengguna. Font Roboto variable normal/italic 100–900 dibundel lokal. Bahasa Indonesia, suara “kami”. Repo target: https://github.com/asukayalab/rizalmaulana.

## Isi paket

- `page-home.php`: delapan bagian Beranda. `page-maintenance.php`: halaman sementara tersendiri.
- `page.php`, `single.php`, `index.php`: renderer dasar untuk Page/karya dan fallback. Halaman lain belum didesain khusus.
- `falcon-blueprint.json`: tujuh role Page, kelompok field khusus Beranda/maintenance dan jenis konten Proyek Rizal.
- Native JavaScript + CSS: menu gulung, hero/mist, transisi menimpa, profil/layanan sticky, count-up, lima proyek manual/swipe, Spirit Kerja terkait scroll, reveal dan reduced motion. Tanpa GSAP atau library eksternal.
- `.falcon-tooling` + `.github`: kit builder/publisher Falcon alpha.24. Push `main` dari commit bersih akan mencoba membuat prerelease otomatis. Tidak deploy ke WordPress.

## Build lokal

Node 22+ dan npm diperlukan:

```sh
npm ci --prefix .falcon-tooling
node .falcon-tooling/scripts/build-project.mjs --source "$PWD" --output "$PWD/../../release/rizalmaulana-alpha1"
```

Builder memerlukan path absolut, output di luar source, semua runtime terdaftar. `style.css`, blueprint dan helper memakai placeholder ID/versi yang diselesaikan builder. ZIP manual dari source belum committed hanya untuk preview lokal, bukan release remote berprovenance bersih.

## Pasang di WordPress

FP alpha.22+, FT alpha.7+, PHP 8.3+, WP 6.7+. Uji penerimaan lokal saat pengerjaan memakai FP alpha.24 / FT alpha.7.

1. Pasang child theme lewat paket Falcon, preview, kemudian aktivasi secara eksplisit.
2. Review Setup website dari paket. Map maintenance ke Page lama dan pertahankan definisi `rm_maintenance` yang sudah ada. Field/nilai lama tetap milik WordPress. Repo ini tidak menyalin database trialrizal.
3. Map enam Page utama ke existing atau draft baru. Terapkan struktur Beranda dengan template Rizal Beranda dan field `rh_*`. Definisi `rp_details` untuk jenis konten `fwf_rm_project`.
4. Isi/review konten melalui editor. Lihat [panduan konten](docs/CONTENT.md). Atur menu native di lokasi Navigasi utama Rizal, atau gunakan role blueprint; hanya Page published yang memiliki tautan fallback publik.
5. Pilih homepage melalui Settings → Reading. Maintenance bisa tetap menjadi homepage sambil Beranda dipreview sebagai draft. `front-page.php` hanya meneruskan ke template Page yang dipilih, mengatasi fallback coming-soon parent; tidak mengubah homepage.
6. Ganti foto referensi, verifikasi klaim/kontak, review HP/desktop/keyboard/SEO, lalu publish melalui manusia berwenang.

Update file tema tidak menerapkan ulang blueprint. Jangan membuat field key/kind tandingan atau menulis protected meta langsung. Instalasi desain baru tidak otomatis menggunakan setting project ID `trialrizal`; hubungkan repo/identitas `rizalmaulana` melalui alur Falcon setelah paket rilis valid tersedia.

## Preview WordPress terisolasi

`scripts/local-compose.yml` membuat database dan WordPress khusus port 8096. Fixture memeriksa environment, URL dan judul situs, lalu membuat data contoh berlabel. Kredensial database yang tertulis di compose hanya untuk fixture loopback ini, bukan konfigurasi hosting. Admin dibuat dengan password acak yang tidak disimpan di repo/log.

Taruh ZIP core lokal yang kompatibel di `.local/core/`, build ZIP proyek pada folder output di atas. Jalankan compose, instal WordPress dan paket terlebih dahulu. Setelah tema aktif:

```sh
docker compose -f scripts/local-compose.yml up -d wordpress
docker compose -f scripts/local-compose.yml run --rm cli wp eval-file /project-scripts/local-fixtures.php.txt
docker compose -f scripts/local-compose.yml run --rm cli wp eval-file /project-scripts/verify-wordpress.php.txt
```

Fixture hanya boleh dijalankan pada instalasi ini. Jangan jalankan di hosting atau situs klien. `.php.txt` disengaja agar skrip pengujian tidak diklasifikasikan sebagai runtime desain oleh builder Falcon. Compose/script uji tidak masuk ZIP. Hentikan dengan `docker compose -f scripts/local-compose.yml stop` untuk mempertahankan data preview.
