<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

### Video Demo:

https://youtu.be/RWq846hAc8c?si=ZUcljS8vrqgAj8-z4

How to use:

1. Prepare database (follow .env.example)
2. Do `composer install` and `npm install`
3. Do the migrate
   `php artisan migrate --seed`
4. Create the key `php artisan key:generate`
5. Serve on localhost

```
php artisan serve
npm run dev
php artisan storage:link
```

6. Enjoy!
7. For schedule and queue, do `php artisan schedule:work` and `php artisan queue:work`
