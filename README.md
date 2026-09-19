# Batik Rubung Kuning

Platform e-commerce produk batik (Tulis, Cap, Printing, Sarimbit, Kain Panjang, Mukena, Batik Modern).

## Fitur Utama

- Katalog produk & kategori hierarkis
- Keranjang belanja (per user)
- Custom order (kirim desain, admin review)
- Checkout dengan down payment (DP)
- Pembayaran digital (Midtrans)
- Pengiriman ter-tracking (courier, tracking number)
- Promo (persentase / fixed, per produk atau kategori)
- Reschedule jadwal pengiriman
- Notifikasi per user
- Role: user & admin

## Alur Pengguna

Browse → Keranjang → Checkout (DP) → Bayar → Pengiriman → Selesai

## Stack

- **Backend**: Laravel 12, PHP 8.3, Eloquent ORM
- **Frontend**: Blade + Tailwind CSS v4 + Vite + Axios
- **Database**: SQLite (dev) / MySQL / MariaDB / PgSQL
- **Cache/Session/Queue**: Database (Redis/Memcached tersedia)
- **Payment**: Midtrans
- **Storage**: Local + S3

## Struktur Database

20 tabel (semua UUID primary key):

```
users → addresses, notifications, cart, custom_orders, orders
categories → products (hierarchical)
products → product_images, product_variants, package_items, order_items, cart_items
promotions → promotion_products, promotion_categories (N:N)
cart → cart_items
custom_orders → orders (1:1)
orders → order_items, payments, delivery_reschedules, shipment (1:1)
shipment → tracking_histories
```

## Setup

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --force
php artisan db:seed
npm install && npm run build
```

## Development

```bash
composer dev    # server + queue + logs + vite
php artisan test
```

## Status

Foundation selesai (20 migration, 18 model, 16 seeder). Controller & route bisnis belum diimplementasikan.
