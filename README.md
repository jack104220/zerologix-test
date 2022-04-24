<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## 安裝步驟

本專案使用Laravel/Octane及Docker，需要用php 8版本

- 切到工作目錄
- 建立 Image
<code>docker build . -t php8:0.0.0 </code>
- 執行docker compose啟動服務，如已有mysql redis則去掉
<code>docker compose up -d zerologix mysql redis</code>
- 進入container
<code>docker compose exec zerologix bash</code>
- 安裝套件
<code>composer install</code>
- 調整環境變數 .env (container內外都行)
- 建立資料庫 (container外)
- 執行migrate
<code>php artisan migrate</code>
- 執行seeder
<code>php artisan db:seed</code>
- 啟動octane
<code>php artisan octane:start --host=0.0.0.0</code>

## ER-Model
- 在資料夾內的ER-Model.png

## 測試類
- 單元測試
    - 測試文章列表
    - 測試文章最愛
    - 測試文章取消最愛

- 功能測試
    - 文章列表

## 尚未完成
- SWAGGER產生用yml