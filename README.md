<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Cara Install

1. clone seperti biasa ke dalam folder
2. buka terminal didalam folder terkait jalankan perintah ( composer install dan npm install(opsional))
3. ubah file .env.example menjadi .env
4. jalankan perintah php artisan cache:clear dan php artisan config:clear
5. jalankan perintah php artisan config:clear
6. jalankan perintah php artisan key:generate
7. jalankan perintah php artisan migrate
8. buka link ini dan create fork ke dalam akun postman anda ( https://www.postman.com/supply-technologist-62151988/workspace/news/collection/27545872-7b76da45-bb57-45ed-ba6a-4b0f89603449?action=share&creator=27545872 )
9. jalankan perintah php artisan passport:install , maka akan muncul 2 client ID dan secret.
10. gunakan client ID dan secret yang ke 2 lalu copykan secret ke folder induk MustAuthAPI pada bagian client secret.
11. jalankan perintah php artisan serve
12. lalu bisa anda coba dengan RegisterAuth dan daftarkan 2 user berbeda role ( admin dan user )
13. buka folder induk MustAuthAPI(token here) masukkan username(email) dan password dari akun admin ( beri nama Token Name yang sesuai )
14. klik Get New Access Token, akan muncul access_token dan refresh_token nya
15. lakukan juga untuk akun user
16. lalu pada bagian current token , pilih salah satu Token Name yang sebelumnya sudah dibuat.
17. jika send LogoutAuth , maka untuk login kembali buka current token lalu pilih Token Name dan refresh token.
18. selamat mencoba.

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
