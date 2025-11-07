# AXIS Clothing — E-commerce Website (PHP + MySQL)

This project is a custom-built e-commerce web application for **AXIS Clothing**, featuring:
- User authentication and profile management  
- Shopping cart and checkout system  
- Manual bank transfer payment upload  
- Admin dashboard for order management  
- Product inventory with stock size validation  

Built with **PHP**, **MySQL**, **HTML**, **CSS**, and **Vanilla JavaScript**.

---

## 🚀 Features

### 🛍️ User Side
- Browse and add products to cart  
- Place orders via **bank transfer/manual payment upload**  
- Track order statuses (`Pending`, `To Ship`, `To Receive`, `Completed`, `Cancelled`)  
- Cancel pending orders  
- Manage shipping address and profile  

### 🧾 Admin Side
- View and manage all customer orders  
- Approve or reject payment proofs  
- Update order statuses (`To Ship`, `To Receive`, `Completed`)  
- View customer details and payment info  

---

## ⚙️ Installation Guide

### 1️. Requirements
- **XAMPP 8.2+**
- **PHP 8.2+**
- **MySQL 8.0+**
- **Apache (with mod_rewrite enabled)**

---

### 2. Setup Steps

1. **Clone this repository**
   ```
   git clone https://github.com/<your-username>/axis-clothing.git
   
2. **Move the project to your XAMPP htdocs folder**
   ```
   D:/korddev/xampp 8.2/htdocs/axis.com

3. **Import the Database**
   - Open ***phpmyadmin***
   - Create new database (e.g., Axis)
   - Import the included .sql file

4. **Update your Apache httpd.conf**

Open your XAMPP httpd.conf file (usually found in D:\korddev\xampp 8.2\apache\conf\httpd.conf)and make sure the following lines exist or are modified:
```
DocumentRoot "D:/korddev/xampp 8.2/htdocs"
<Directory "D:/korddev/xampp 8.2/htdocs">
    AllowOverride All
    Require all granted
</Directory>

LoadModule rewrite_module modules/mod_rewrite.so

AllowOverride All

