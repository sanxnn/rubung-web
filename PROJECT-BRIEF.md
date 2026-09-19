# Batik Rubung Kuning — Project Brief

## Nama

**Batik Rubung Kuning** (`rubung-web`) — platform e-commerce produk batik.

## Tujuan

Menjual produk batik (Tulis, Cap, Printing, Sarimbit, Kain Panjang, Mukena, Batik Modern) secara online, dengan fitur keranjang, checkout ber-DP, pembayaran digital, pengiriman ter-tracking, dan opsi pemesanan desain custom.

## Alur Utama (User Journey)

1. **Browse** — Pengunjung melihat kategori & produk batik.
2. **Custom Order** (opsional) — User kirim deskripsi desain + gambar, tunggu keputusan admin (pending → accepted/rejected/converted).
3. **Keranjang** — User login, tambah produk/variant ke cart.
4. **Checkout** — Pilih alamat kirim, lihat subtotal, diskon (promo), total, setujui tanggal delivery.
5. **Pembayaran** — Bayar DP dulu, lalu lunasi pelunasan final (gateway: Midtrans).
6. **Pengiriman** — Admin proses, kurir dijadwalkan, tracking number diterbitkan, user pantau riwayat pengiriman.
7. **Selesai / Reschedule** — Order selesai, atau user minta perubahan jadwal kirim (admin approve).

## Role Pengguna

- **User** — browse, beli, custom order, track pengiriman.
- **Admin** — kelola produk/kategori/promo, review custom order, proses pesanan & pengiriman.

## Struktur Database (20 tabel, semua UUID PK)

```
users ── addresses, notifications, cart, custom_orders, orders
categories ── products (parent_id → self, hierarchical)
products ── product_images, product_variants, package_items, order_items, cart_items, promotions(N:N)
promotions ── promotion_products, promotion_categories (N:N)
cart ── cart_items
custom_orders ── orders (1:1, converted)
orders ── order_items, payments, delivery_reschedules, shipment(1:1)
shipment ── tracking_histories
```

### Tabel Pokok

| Tabel | Fungsi |
|---|---|
| `users` | Akun (role user/admin) |
| `products` | Katalog batik (base_price, stock) |
| `categories` | Kategori hierarkis |
| `orders` | Pesanan (subtotal, discount, DP, total, status, snapshot promo & alamat) |
| `order_items` | Barang per pesanan |
| `payments` | Bayaran (dp/final/full, status, transaction_id) |
| `shipments` | Pengiriman (courier, tracking number, status) |
| `custom_orders` | Pesanan desain custom (pending/accepted/rejected/converted) |
| `delivery_reschedules` | Permintaan ubah jadwal kirim |
| `promotions` | Kode promo (persentase/fixed, usage_limit) |
| `carts` / `cart_items` | Keranjang per user |
| `addresses` | Alamat kirim user |
| `notifications` | Notifikasi per user |

## Stack Teknis

- **Backend**: Laravel 12, PHP 8.3, Eloquent ORM
- **Frontend**: Blade + Tailwind CSS v4 + Vite + Axios
- **Database**: SQLite (dev), MySQL/MariaDB/PgSQL (production-ready)
- **Cache/Session/Queue**: Database driver (Redis/Memcached tersedia)
- **Payment**: Midtrans (direncanakan)
- **Mail**: SMTP (direncanakan, saat ini log driver)
- **Storage**: Local + S3 (direncanakan)

## Modul/Fitur

Auth (login/register), Katalog (produk, kategori, gambar, variant, paket), Promo, Keranjang, Custom Order, Checkout (DP + total), Pembayaran, Pesanan (status flow), Pengiriman & Tracking, Reschedule Jadwal, Notifikasi, Admin Panel.

## Status Saat Ini

Foundation selesai: 20 migration, 18 model, 16 seeder, config siap. Backend bisnis (controller, route, service) belum diimplementasikan. APP_KEY perlu generate sebelum deploy.
