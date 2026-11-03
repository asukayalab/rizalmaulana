# Bukti penerimaan lokal — 3 November 2026 WIB

Target hanya repo `asukayalab/rizalmaulana`, source lokal belum committed. Paket desain 0.1.0-alpha.1. Tidak ada push, GitHub Release nyata, pemasangan hosting, penggantian homepage hosting atau impor database trialrizal.

## Lingkungan

WordPress Docker khusus `rizal-design-local`, loopback port 8096, database/volume terpisah dari lingkungan core Falcon. WordPress 7.0.8 bahasa Indonesia, PHP 8.3, FP alpha.24, FT alpha.7. Indexing dimatikan. Seluruh data contoh diberi banner preview lokal; banner disimpan hanya pada instalasi fixture, tidak pada source/ZIP tema.

## Lulus

- Builder Falcon alpha.24: runtime inventory, source paths, kompatibilitas, schema blueprint, binding ID/versi/hash serta ZIP. Hasil sekitar 1.4 MB. Source tanpa commit menghasilkan provenance preview lokal; belum layak untuk distribusi remote bersih.
- Instalasi ZIP FP/FT/proyek dan aktivasi pada instalasi uji khusus. Blueprint berhasil Review/Apply: tujuh role Page, delapan group scoped untuk Page dan satu group detail proyek, jenis konten `fwf_rm_project`. Pengulangan setup pada Page yang dipetakan tidak menggandakan tujuh role.
- 13 file PHP runtime lulus `php -l`. JavaScript runtime dan skrip QA lulus pemeriksaan sintaks Node.
- 13 assertion regresi WordPress: pemetaan role; template Beranda/maintenance terpisah; field tidak bocor ke Kontak; rm_* tetap tersedia; stale revision ditolak; lima proyek resolve; private/password tersaring; penulisan melalui Repository; output teks aman; seluruh seksi penutup tetap merender dengan konteks Page benar; blueprint valid; field/theme/homepage dipulihkan setelah pengujian.
- Browser Chrome headless: lebar 320, 375, 760, 1024, 1280, 1440 dan 1920 tanpa overflow horizontal atau gambar rusak; menu/Escape/inert; slider/panah keyboard; satu slide interaktif; Spirit Kerja scroll/pagination; reduced motion; maintenance/noindex; seluruh isi dan menu tersedia tanpa JavaScript. Tidak ada error JavaScript browser pada run pengujian.
- Hallmark render akhir: **0 FAIL, 0 WARN, 3 WAIVED, 4 ANSWERED**. Empat jawaban craft mempertahankan cue tombol PDF, kontrol pagination, dua pola scroll yang diminta pengguna, dan judul layanan lima baris. Waiver font fallback Arial serta dua frasa hero mengikuti desain sumber. Bukan klaim bahwa semua fitur sudah diuji di semua browser.
- Review hero independen: satu koreksi pemuatan foto pada 1280 px, kemudian dikonfirmasi resolved. Review akhir independen: **ship**, tidak ada temuan tersisa, desktop/mobile konsisten dengan arah sumber.

Screenshot QA disimpan di workspace visualisasi chat, bukan repo atau runtime ZIP. Perilaku swipe sudah diimplementasikan; run browser di atas menguji kontrol klik/keyboard, bukan penerimaan sentuhan pada perangkat fisik.

## Batas

Belum diuji pada hosting rizalmaulana.id, Safari/Firefox, perangkat HP fisik, client MCP/provider AI, pengiriman formulir, atau siklus rilis GitHub → installer Falcon situs nyata. Halaman Profil/Layanan/Karya/Edukasi/Kontak baru mendapat renderer native dasar. Tidak ada form kontak otomatis. Media Library belum diisi aset final. Foto portrait/karya, statistik, klaim layanan, kontak, lisensi aset/font dan SEO peluncuran perlu persetujuan manusia.

Maintenance memakai markup/field trialrizal alpha.5; CSS ditokenisasi dan motion dibuat terbatas tanpa animasi idle terus-menerus. Nilai existing hanya ikut bila Page lama dipetakan; ZIP tidak memindahkan konten antarinstalasi. Parent `front-page.php` dilewati lewat dispatcher child yang menghormati template Page terpilih. Urutan dependency CSS memastikan gaya child tidak ditimpa parent.

Penerimaan lokal tidak berarti situs publik sudah berubah. Sebelum push, review source dan catatan rilis; workflow `main` disiapkan untuk membuat prerelease otomatis, sehingga push merupakan tindakan publikasi paket tersendiri.

## Revisi minor — acuan maintenance dan Roboto

Menggantikan penyederhanaan maintenance pada implementasi awal: komposisi, bobot 900/300, tagline, dekorasi titik/garis dan motion scroll kini mengikuti standalone index.html yang diberikan pengguna. Field rm_email ditambahkan sebagai teks dan hanya menghasilkan tautan mailto setelah is_email valid; contoh kontak acuan hanya diisikan pada fixture lokal melalui Repository. Naskah “we” dipertahankan sesuai keputusan suara “kami”.

Roboto normal diambil dari font variable yang tertanam pada acuan; italic variable lengkap berasal dari repositori resmi Google Fonts. Metadata fontTools membuktikan sumbu wght 100–900 pada kedua file. Font di-host lokal dan teks lisensi OFL ikut dalam runtime fonts.css. Tidak ada permintaan font ke Google saat halaman dibuka.

Menu berubah menjadi header yang mengikuti scroll, nama RIZAL MAULANA memakai weight 300, panel putih/teks hitam dan tombol hitam. Cek browser fokus revisi lulus: family/weight aktual, posisi header setelah scroll, warna panel, maintenance weight 900/300/italic, dekorasi, dua CTA, tidak ada overflow pada 320/390 px, reduced motion, dan tanpa error JavaScript. Screenshot desktop/HP sudah ditinjau. Pemeriksaan PHP untuk dua file yang berubah dan build paket lulus. Hasil Hallmark penuh di atas adalah hasil implementasi awal; bukan audit ulang untuk styling maintenance acuan yang sengaja dipertahankan.
