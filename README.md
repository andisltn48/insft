## Installation

Berikut tahapan untuk instalasi:
```bash
1. git clone https://github.com/andisltn48/insft.git
2. cd insft
3. composer install
4. cp .env.example .env
5. silahkan sesuaikan konfigurasi database anda pada file .env
6. php artisan key:generate
7. php artisan migrate
8. php artisan db:seed
9. php artisan serve (untuk menjalankan aplikasi laravel)
```

## API Documentation

Berikut tahapan untuk menjalankan Dokumentasi API (POSTMAN):
```bash
1. Pastikan aplikasi POSTMAN sudah terinstall pada device anda.
2. Buka aplikasi POSTMAN
3. Import file sql yang ada pada repository (nama file : Inosoft.postman_collection.json)
4. Semua request akan tampil pada aplikasi POSTMAN
