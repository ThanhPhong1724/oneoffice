# OneOffice — Wonderland Việt Nam (WordPress)

Backup **code tùy biến** website cho thuê văn phòng OneOffice. Nền tảng: WordPress + WooCommerce + theme **Flatsome** (child theme).

### 📦 Repo chứa
- `wp-content/themes/flatsome-child/` — child theme: Home/VPTG V2, SEO, schema, UChat, chống spam, counter…
- `wp-content/plugins/devtung-mvc/` — plugin tùy biến (MVC, trang sản phẩm, popup báo giá)
- `robots.txt`

### 🚫 KHÔNG commit (bảo mật / dung lượng)
WP core · theme/plugin bên thứ 3 · `wp-content/uploads/` · `wp-config.php` · database (`.sql`) → backup riêng ngoài repo.

### 📚 Tài liệu
- **Quản trị (admin):** `wp-content/themes/flatsome-child/_HUONG-DAN-QUAN-TRI.md`
- **Kỹ thuật child theme:** `wp-content/themes/flatsome-child/README.md`

---

# 📘 Naming Conventions

Quy ước đặt tên trong dự án Laravel + Frontend.  
Mục tiêu: **thống nhất – dễ đọc – dễ bảo trì – dễ mở rộng**.

---

## 📑 Mục lục
1. [Backend (Laravel)](#1-backend-laravel)  
2. [Database](#2-database)  
3. [Routes & Views](#3-routes--views)  
4. [Frontend (CSS/JS)](#4-frontend-cssjs)  
5. [Config & Env](#5-config--env)  

---

## 1. Backend (Laravel)

| Thành phần          | Quy ước đặt tên             | Ví dụ                                        |
| ------------------- | --------------------------- | -------------------------------------------- |
| **Controller**      | PascalCase + `Controller`   | `ProductController`, `CartController`        |
| **Model**           | PascalCase (số ít)          | `User`, `Order`, `Product`                   |
| **Observer**        | PascalCase + `Observer`     | `UserObserver`, `OrderObserver`              |
| **Middleware**      | PascalCase                  | `Authenticate`, `CheckAdmin`                 |
| **Service class**   | PascalCase + `Service`      | `PaymentService`, `ReportService`            |
| **Helper func**     | snake\_case                 | `format_currency()`, `generate_token()`      |
| **Policy**          | PascalCase + `Policy`       | `OrderPolicy`, `UserPolicy`                  |
| **Form Request**    | PascalCase + `Request`      | `StoreProductRequest`, `UpdateUserRequest`   |
| **Resource (API)**  | PascalCase + `Resource`     | `UserResource`, `OrderResource`              |
| **Notification**    | PascalCase                  | `OrderShipped`, `ResetPassword`              |
| **Enum (PHP 8.1)**  | PascalCase                  | `OrderStatus`, `UserRole`                    |
| **Event**           | PascalCase (quá khứ)        | `OrderCreated`, `UserRegistered`             |
| **Listener/Job**    | PascalCase + (Listener/Job) | `SendEmailNotification`, `ProcessOrderJob`   |
| **Command (class)** | PascalCase                  | `SendReport`, `CleanLogs`                    |
| **Command (name)**  | kebab-case                  | `php artisan send-report`                    |
| **Seeder**          | PascalCase + `Seeder`       | `UserSeeder`, `ProductSeeder`                |
| **Factory**         | PascalCase + `Factory`      | `UserFactory`, `OrderFactory`                |
| **Migration file**  | snake\_case (quá khứ)       | `2025_09_22_123456_create_orders_table.php`  |
| **Migration class** | PascalCase                  | `CreateOrdersTable`, `AddStatusToUsersTable` |
| **Config key**      | snake\_case                 | `app.debug`, `queue.connections`             |
| **Env variable**    | UPPER\_SNAKE\_CASE          | `APP_ENV`, `DB_CONNECTION`, `MAIL_HOST`      |
| **PHP variable**    | camelCase                   | `$orderId`, `$totalAmount`, `$userName`      |
| **PHP constant**    | UPPER\_SNAKE\_CASE          | `MAX_UPLOAD_SIZE`, `DEFAULT_ROLE`            |
| **Test class**      | PascalCase + `Test`         | `UserTest`, `OrderControllerTest`            |
| **Test method**     | camelCase                   | `testUserCanLogin()`, `testOrderCheckout()`  |

---

## 2. Database

| Thành phần             | Quy ước đặt tên                | Ví dụ                                      |
| ---------------------- | ------------------------------ | ------------------------------------------ |
| **Migration (file)**   | snake_case + số nhiều          | `create_products_table.php`, `add_status_to_orders_table.php` |
| **Migration (table)**  | snake_case (số nhiều)          | `products`, `user_orders`                  |
| **Cột (column)**       | snake_case                     | `created_at`, `updated_at`, `price_input`  |
| **Pivot table**        | snake_case (số ít, alpha order)| `order_product`, `role_user`               |
| **Index/constraint**   | snake_case                     | `user_email_unique`, `orders_user_id_fk`   |
| **Seeder**             | PascalCase + `Seeder`          | `ProductSeeder`, `UserSeeder`              |
| **Factory**            | PascalCase + `Factory`         | `UserFactory`, `ProductFactory`            |

---

## 3. Routes & Views

| Thành phần            | Quy ước đặt tên                | Ví dụ                                      |
| --------------------- | ------------------------------ | ------------------------------------------ |
| **Route (URI)**       | kebab-case                     | `/add-to-cart`, `/product-detail/{id}`     |
| **Route name**        | snake_case + dot notation      | `admin.orders.show`, `shop.products.index` |
| **Blade file**        | snake_case                     | `product_detail.blade.php`, `checkout.blade.php` |
| **Blade section/yield**| snake_case                    | `@section('main_content')`, `@yield('page_title')` |
| **Blade component**   | kebab-case                     | `<x-product-card />`, `<x-layout.nav-bar />` |

---

## 4. Frontend (CSS/JS)

| Thành phần                   | Quy ước đặt tên                              | Ví dụ                                                              |
| ---------------------------- | -------------------------------------------- | ------------------------------------------------------------------ |
| **CSS class (custom)**       | Algolia/BEM (PascalCase)                     | `.ProductCard`, `.ProductCard-Title`, `.ProductCard-Title-large`   |
| **Bootstrap/Tailwind class** | Theo framework                               | `container`, `row`, `btn-primary`, `text-center`                   |
| **CSS variable (custom)**    | `--kebab-case`                               | `--primary-color`, `--font-size-base`, `--spacing-lg`              |
| **SCSS/SASS variable**       | `$kebab-case`                                | `$primary-color`, `$font-size-base`, `$spacing-lg`                 |
| **SCSS file/folder**         | kebab-case                                   | `_variables.scss`, `_mixins.scss`, `components/_product-card.scss` |
| **HTML id**                  | kebab-case                                   | `id="product-list"`, `id="order-form"`, `id="user-profile"`        |
| **HTML data-attribute**      | `data-namespace-action`                      | `data-cart-add`, `data-user-id`, `data-modal-target`               |
| **JS biến/hàm**              | camelCase                                    | `let productId`, `function addToCart()`                            |
| **JS class (ES6)**           | PascalCase                                   | `class CartManager {}`                                             |
| **JS constant**              | UPPER\_CASE\_SNAKE                           | `const API_BASE_URL = "/api/v1"`, `const MAX_ITEMS = 50`           |
| **JS file**                  | PascalCase cho class, camelCase cho function | `ImportForm.js`, `supplierSelector.js`, `helper.js`                |
| **JS folder**                | kebab-case                                   | `components/`, `handlers/`, `services/`, `shared/`                 |
| **JS event handler**         | on + Event + Action (camelCase)              | `onInputSearch`, `onClickDeleteProduct`, `onChangeQuantity`        |
| **Form handler JS**          | PascalCase cho class                         | `CustomerFormHandler.js`, `ImportFormHandler.js`                   |
| **Service JS**               | PascalCase + Service                         | `ImportService.js`, `CustomerService.js`                           |
| **Shared utils JS**          | camelCase / PascalCase (tùy loại)            | `helper.js`, `formatCurrency.js`                                   |

---

## 5. Config & Env

| Thành phần      | Quy ước đặt tên              | Ví dụ                  |
| --------------- | ---------------------------- | ---------------------- |
| **Config key**  | snake_case                   | `app.name`, `database.connections.mysql` |
| **.env key**    | UPPER_CASE + snake_case      | `APP_NAME`, `DB_PASSWORD`                |

---
