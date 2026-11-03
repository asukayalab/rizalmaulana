# Tempat edit dan materi sebelum peluncuran

Semua naskah baru adalah draft kerja untuk review. Foto bundled berasal dari `stock/img01` milik workspace pengguna dan hanya dipakai sebagai referensi sementara. Keberadaan file tidak membuktikan identitas portrait, hak distribusi, atau keterlibatan Rizal pada bangunan yang terlihat.

| Bagian | Lokasi edit | Kosong / fallback |
|---|---|---|
| Hero | Beranda → Hero: dua frasa judul (mendukung multiline), pengantar, CTA, image | Default naskah paket melalui schema. Gambar kosong memakai referensi hero. |
| Profil | Beranda → Profil dan statistik | Foto referensi `02.png`, bukan portrait terverifikasi. Alt dapat diisi. |
| Statistik | Empat slot nilai integer, label, suffix di Profil | 0/kosong menyembunyikan statistik. Nilai preview 10/500/5/25 hanya fixture lokal. |
| Karya pilihan | Beranda → Lima karya pilihan | Maksimal lima relationship ke Proyek Rizal. Duplikat, draft, private dan password disaring. Seluruh seksi disembunyikan jika kosong. |
| Detail proyek | Proyek Rizal: native title/body + foto dan lokasi | Halaman single dasar. Tanpa foto memakai gambar referensi; wajib diganti sebelum tayang. |
| Spirit kerja | Beranda → Spirit kerja, empat judul/uraian | Copy dari pengguna; review klaim sebelum publish. |
| Layanan | Beranda → Ragam layanan, judul/pengantar dan empat judul/uraian | Empat slot tetap; bukan repeater. Copy draft, termasuk uraian PBG/SLF yang perlu persetujuan. |
| Jurnal/Tulisan/Edukasi | Beranda → Jurnal, tulisan, edukasi | Gambar, teks, CTA dan relationship Page tujuan. Default target role Karya/Karya/Edukasi, bukan URL hardcoded. |
| Kolaborasi/footer | Beranda → Kolaborasi dan footer | Teks, gambar, identitas footer, tagline, copyright, sosial. Tautan sosial kosong tidak tampil. |
| Navigasi | Menu native WordPress, lokasi Navigasi utama Rizal | Fallback role blueprint memakai permalink Page published aktual. Tidak menebak slug/ID. |
| Maintenance | Page maintenance → field rm_* existing | Key dan jenis dipertahankan. Kontak baru kosong; isi dari data yang telah disetujui. Noindex hanya Page template ini. |
| Profil/Layanan/Karya/Edukasi/Kontak | Native Page title/body | Struktur dasar siap diisi; desain rinci belum dibuat. |

Tombol menuju role draft/private/tidak tersedia tidak dirender. Preview draft baru biasanya belum menampilkan seluruh nav/CTA hingga target Page terbit; ini mengikuti visibility Falcon. Form kontak tidak termasuk dalam paket awal. Tidak ada endpoint/email delivery pura-pura.

## Motion

Desktop: hero sticky ditutup profil; foto profil sticky selama narasi/statistik; karya berganti manual dengan wipe; Spirit Kerja memakai track scroll tanpa wheel hijacking; layanan kiri sticky; footer menggulung menutup kolaborasi. Sticky dinonaktifkan bila viewport terlalu pendek atau pengguna memilih reduced motion. Semua perubahan berjalan native, dengan requestAnimationFrame hanya setelah scroll/resize, tanpa loop idle.

Mobile: satu kolom, profil dan layanan tidak sticky; statistik dua kolom, karya swipe/panah, Spirit Kerja swipe/pagination tanpa pin; footer normal. Reduced motion menonaktifkan entrance/count-up/parallax dan pin tetapi kontrol tetap bekerja. Dengan JavaScript mati, semua proyek dan pendekatan tampil berurutan; menu dan seluruh isi tetap dapat diakses.

## Materi yang perlu disetujui

Foto hero arsitektur 16:9 (minimal 1600 px), foto profil vertikal 4:5, foto untuk maksimal lima proyek beserta judul/lokasi/peran asli, tiga gambar pengetahuan 16:9, foto kolaborasi 16:9, logo RME vector asli jika ingin mengganti identitas teks, font Roboto variable normal/italic 100–900 sudah dibundel lokal beserta OFL, angka statistik, kanal komunikasi dan tautan sosial. Satu materi paling membantu berikutnya: daftar lima proyek terpilih dengan foto dan peran Rizal yang terverifikasi.

## Label seksi — alpha.2

Enam label outline dari PDF dikembalikan: STRUCTURAL ENGINEER, RIZAL MAULANA ENGINEERING, KARYA PILIHAN, SPIRIT KERJA, RAGAM LAYANAN dan KARYA LAINNYA. Label dapat diedit lewat enam field opsional rh_*_label setelah Review/Apply struktur baru. Update kode saja langsung menampilkan fallback desain pada schema alpha.1. Label Karya Pilihan mengikuti visibilitas seksi proyek: pilih minimal satu Proyek Rizal published pada slot Beranda untuk memunculkannya. Tidak ada proyek dummy yang diimpor ke hosting.
