# SPEKTA SMANSA

SPEKTA SMANSA - SISTEM PENCATATAN KEUANGAN DAN KEANGGOTAAN EKTRAKURIKULER SMA NEGERI 1 MEJAYAN

-------------------

**SPEKTA SMANSA** Adalah sebuah aplikasi berbasis web yang dikembangkan oleh SMA Negeri 1 Mejayan 

![SPEKTA SMANSA Screenshot](https://i.ibb.co/FqqpbxF/Screenshot-1825.png)

## Fitur
1. Login Multiauth
2. Verifikasi email dengan SMTP GMAIL
3. Halaman Superadmin
4. Halaman Admin
5. Halaman Teacher
6. Halaman User
7. Laporan keuangan tiap bulan
8. Sistem verifikasi dan Validasi data anggota
9. Terintegrasi dengan CBT SPEKTA
10. Export data PDF
11. Data ekstrakurikuler + data pembina yang selalu tersinkronasi
12. Laporan kegiatan + surat tugas kegiatan

## INSTALASI
1. Pastikan port localhost yang anda gunakan 80 atau 8080. Silakan cek di pengaturan apache server/nginx server anda
2. Buat database dengan nama db_spekta_3 atau yang lainnya. Jika mengubah nama database pastikan file koneksi.php sudah dikonfigurasi
3. Import data dari folder database dengan nama db_spekta_3 (jangan yang lain) ke database sql/phpmyadmin yang telah dibuat
4. aplikasi siap dijalankan


### Data user
1. Admin
email: admin@spekta.com
pass: admin12345
2. Guru (Pembina PMR)
email: guru@spekta.com
pass:guru12345
3. Teacher (Pembina Pramuka)
email: teacher@spekta.com
pass:teacher12345
4. Pramuka (Admin Pramuka)
email: pramuka@spekta.com
pass:pramuka12345
5. PMR (Admin PMR)
email: pmr@spekta.com
pass:pmr12345
6. Rohis (Admin Rohis)
email: rohis@spekta.com
pass:Rohis_12345
7. USERS (Users Spekta)
email: users@spekta.com
pass:User_12345


### Catatan
1. Aplikasi ini dibuat dengan menggunakan server laragon bukan xampp. Bila didalam aplikasi terdapat beberapa domain (.test) maka silakan ubah ke domain localhost kembali
2. Bila terjadi kegagaln konfigurasi atau yang lain sebagainya bisa ditanyakan pada halaman github ini atau menghubungi developer via whatsapp atau email

email: chaidar.21052@mhs.unesa.ac.id

Aplikasi ini milik SMA Negeri 1 Mejayan

## Lisensi
[MIT](https://choosealicense.com/licenses/mit/)
