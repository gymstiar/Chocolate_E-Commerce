# 🍫 ChocoLuxe - Premium Chocolate E-Commerce

A modern, full-featured e-commerce platform for premium artisan chocolates built with Laravel 11, featuring dual-role authentication (Buyer/Seller), product management, shopping cart, orders, payments, and more.

![Laravel](https://img.shields.io/badge/Laravel-11.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-8.2+-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-8.0+-4479A1?style=for-the-badge&logo=mysql&logoColor=white)
![Bootstrap](https://img.shields.io/badge/Bootstrap-5.3-7952B3?style=for-the-badge&logo=bootstrap&logoColor=white)

---

## ✨ Features

### 🛍️ **Buyer Features**
- Browse and search products with advanced filters
- Product image gallery with video support
- Shopping cart with quantity management
- Wishlist functionality
- Secure checkout with address management
- Order tracking and history
- Upload payment proof
- Re-upload payment after rejection
- Order confirmation

### 🏪 **Seller Features**
- Dashboard with sales analytics
- Product management (CRUD operations)
- Upload up to **5 photos** and **1 video** per product
- Category management
- Order management and fulfillment
- Payment verification system
- Stock management with auto-restoration on cancellation
- Sales reports and analytics
- Customer management
- Promo code creation and management

### 🎨 **Design Features**
- Premium chocolate-themed UI
- Fully responsive design
- Smooth animations (AOS)
- Custom error pages (403, 404)
- Modern card layouts
- Interactive product galleries

---

## 📋 Requirements

- **PHP**: >= 8.2
- **Composer**: Latest version
- **MySQL**: >= 8.0
- **Node.js**: >= 18.x
- **NPM**: Latest version

---

## 🚀 Installation

### 1. Clone the Repository

```bash
git clone <repository-url>
cd E-Commerce-Cokelat
```

### 2. Install PHP Dependencies

```bash
composer install
```

### 3. Install Node Dependencies

```bash
npm install
```

### 4. Environment Configuration

Copy the example environment file:

```bash
cp .env.example .env
```

### 5. Database Setup

#### Create MySQL Database

```sql
CREATE DATABASE chocoluxe_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

#### Configure .env File

Update your `.env` file with database credentials:

```env
APP_NAME=ChocoLuxe
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=chocoluxe_db
DB_USERNAME=root
DB_PASSWORD=your_password_here
```

### 6. Generate Application Key

```bash
php artisan key:generate
```

### 7. Run Migrations

```bash
php artisan migrate
```

### 8. Seed Database (Optional)

```bash
php artisan db:seed
```

### 9. Create Storage Link

```bash
php artisan storage:link
```

### 10. Build Assets

```bash
npm run build
```

For development with hot reload:

```bash
npm run dev
```

### 11. Start Development Server

```bash
php artisan serve
```

The application will be available at `http://127.0.0.1:8000`

---

## 👥 Default User Accounts

After seeding, you can login with these accounts:

### Seller Account
- **Email**: `penjual@gmail.com`
- **Password**: `password`

### Buyer Account
- **Email**: `pembeli@gmail.com`
- **Password**: `password`

---

## 📁 Project Structure

```
E-Commerce-Cokelat/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Buyer/          # Buyer controllers
│   │   │   ├── Seller/         # Seller controllers
│   │   │   └── ProductController.php
│   │   └── Middleware/
│   │       ├── IsBuyer.php
│   │       └── IsSeller.php
│   └── Models/
│       ├── Product.php
│       ├── Order.php
│       ├── Payment.php
│       └── ...
├── database/
│   ├── migrations/
│   └── seeders/
├── resources/
│   ├── views/
│   │   ├── buyer/
│   │   ├── seller/
│   │   ├── public/
│   │   └── errors/            # Custom error pages
│   ├── sass/
│   └── js/
├── routes/
│   └── web.php
└── public/
    └── storage/               # Symlinked storage
```

---

## 🎨 Key Technologies

- **Backend**: Laravel 11
- **Frontend**: Bootstrap 5.3, Blade Templates
- **Database**: MySQL
- **Animations**: AOS (Animate On Scroll)
- **Icons**: Bootstrap Icons
- **Fonts**: Google Fonts (Playfair Display, Poppins)

---

## 🔧 Configuration

### File Upload Limits

**Product Images**:
- Maximum: **5 images** per product
- Formats: JPEG, PNG, JPG, WebP
- Max size: 2MB per image

**Product Videos**:
- Maximum: **1 video** per product
- Formats: MP4, WebM, MOV
- Max size: 50MB

### Payment Proof Upload

- Formats: JPEG, PNG, JPG
- Max size: 2MB
- Can be re-uploaded if rejected by seller

---

## 📝 Usage Guide

### For Sellers

1. **Login** as seller
2. **Add Products**: Navigate to Products → Create New
3. **Upload Media**: Add up to 5 photos and 1 video
4. **Manage Orders**: View and process customer orders
5. **Verify Payments**: Approve or reject payment proofs
6. **Track Sales**: View analytics on dashboard

### For Buyers

1. **Register/Login** as buyer
2. **Browse Products**: Filter by category, type, price
3. **Add to Cart**: Select quantity and add items
4. **Checkout**: Choose address and shipping method
5. **Upload Payment**: Submit payment proof
6. **Track Order**: View order status and history

---

## 🐛 Bug Fixes Implemented

✅ **Payment Rejection Re-upload**: Buyers can now re-upload payment proof after seller rejection  
✅ **Stock Restoration**: Product stock is automatically restored when orders are cancelled

---

## 🤝 Contributing

Contributions are welcome! Please follow these steps:

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

---

## 📄 License

This project is licensed under the MIT License.

---

## 📧 Support

For support, email: samrayit.nas@gmail.com

---

## 🙏 Acknowledgments

- Laravel Framework
- Bootstrap Team
- AOS Library
- Bootstrap Icons
- Google Fonts

---

**Made with ❤️ and 🍫**
Develope by gymstiar
