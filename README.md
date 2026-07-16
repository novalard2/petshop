# 🐾 PetShop Management System | Laravel 12

![Laravel](https://img.shields.io/badge/Laravel-12-red?style=for-the-badge&logo=laravel)
![GitHub last commit](https://img.shields.io/github/last-commit/novalard2/petshop?style=for-the-badge)
![PHP](https://img.shields.io/badge/PHP-8.2-777BB4?style=for-the-badge&logo=php)
![MySQL](https://img.shields.io/badge/MySQL-Database-blue?style=for-the-badge&logo=mysql)
![Bootstrap](https://img.shields.io/badge/Bootstrap-5-purple?style=for-the-badge&logo=bootstrap)
![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-3-38BDF8?style=for-the-badge&logo=tailwindcss)

PetShop Management System is a web-based application built with Laravel 12 to help manage pet store operations, including product management, online shopping, payment integration, and dashboard analytics.

## 🚀 Features

- Authentication (Login, Register & Forgot Password)
- Product Management (CRUD)
- Category Management (CRUD)
- Animal Management (CRUD)
- User Management (CRUD)
- Shopping Cart
- Checkout System
- Midtrans Payment Gateway (Sandbox / Dummy)
- Payment Callback (Webhook)
- Order Management
- Dashboard Analytics
- Revenue Chart
- Load More Products
- Realtime Product Search
- WhatsApp Reservation
- Responsive Design

## 🛠️ Tech Stack

- Laravel 12
- PHP 8.2
- MySQL
- Bootstrap 5
- Tailwind CSS
- JavaScript
- Midtrans Sandbox
- Chartist.js
- SweetAlert2

## 🔧 Development Tools

- Git
- GitHub
- Visual Studio Code
- XAMPP
- ngrok (Webhook Testing)
  
## 📷 Screenshots

### Landing Page

![Landing Page](screenshots/landingpage.png)

### Admin Dashboard

![Dashboard](screenshots/dashboard.png)

### Product Store

![Store](screenshots/store.png)

### Checkout

![Checkout](screenshots/checkout.png)

### Order History

![Orders](screenshots/orders.png)

## ⚙️ Installation

Clone this repository

```bash
git clone https://github.com/novalard2/petshop.git
```

Go to project folder

```bash
cd petshop
```

Install dependencies

```bash
composer install
```

Copy environment file

```bash
cp .env.example .env
```
> **Windows users: copy .env.example to .env manually if the cp command is unavailable.

Generate application key

```bash
php artisan key:generate
```

Update your database configuration and Midtrans credentials in the `.env` file, then run:

```bash
php artisan migrate
```

Create a symbolic link for the storage directory

```bash
php artisan storage:link
```

Start the development server

```bash
php artisan serve
```

---

## 📄 License

This project was developed for learning and portfolio purposes.

---

## 👨‍💻 Developer

**Noval Ardiansyah**

GitHub: [github.com/novalard2](https://github.com/novalard2)
