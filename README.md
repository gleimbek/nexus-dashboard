# 🚀 Nexus Dashboard SaaS

A modern Laravel-based SaaS admin dashboard built for portfolio and real-world backend practice.

---

## 📊 Features

- Authentication system (Login / Register)
- Role-based access (Admin / User)
- User management (CRUD)
- Dynamic dashboard analytics
- Chart.js data visualization
- Latest users tracking
- Secure middleware protection

---

## 🛠 Tech Stack

- Laravel 12
- PHP 8.2+
- SQLite by default (MySQL works too)
- Vite
- Blade
- Chart.js

---

## 📈 Purpose

This project simulates a real SaaS admin system similar to modern platforms like Stripe dashboards and internal business analytics tools.

It demonstrates:

- Backend architecture
- Full-stack Laravel development
- UI structuring for SaaS products
- Portfolio-ready engineering skills

---

## 🚀 Installation

```bash
git clone https://github.com/gleimbek/nexus-dashboard.git
cd nexus-dashboard
composer install
npm install
cp .env.example .env
php artisan key:generate
touch database/database.sqlite
php artisan migrate --seed
npm run dev
php artisan serve
```

## 🔑 Demo accounts

`php artisan migrate --seed` creates two accounts. Both use the password `password`.

| Email | Role | What it can do |
| --- | --- | --- |
| admin@example.com | admin | Everything, including the Users page (edit and delete users) |
| test@example.com | user | Dashboard and own profile only |

## ✅ Tests

```bash
npm run build
php artisan test
```

`tests/Feature/AdminUserManagementTest.php` checks the access rules: guests are sent to login, regular users get a 403 on every admin route and can't change anyone else's data, and admins can edit and delete users but not their own account from the list.

---

## 👨‍💻 Author

**Gustavo Leimbek**  
Full-stack Developer
