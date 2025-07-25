# Elegance Salon Management System

Elegance Salon Management System is a comprehensive web-based application designed to streamline and automate salon operations. From appointment scheduling to inventory tracking, this system provides an all-in-one solution for salon management.

## 📋 Project Overview

A fully functional system built using PHP, MySQL, and modern web technologies to manage:

- Client records and appointments
- Staff scheduling and commission tracking
- Inventory stock and supplier details
- Invoicing, reporting, and notifications

## 🌟 Features

- **User Authentication**: Role-based access for Admin, Receptionist, Stylist, and Clients
- **Appointment Management**: Book, reschedule, cancel appointments
- **Client Management**: Store customer preferences and visit history
- **Inventory Management**: Track stock, set low inventory alerts, manage suppliers
- **Staff Scheduling**: Shift assignments, profile management, commission tracking
- **Reporting & Analytics**: Revenue, service usage, staff performance reports
- **Payment & Invoicing**: Invoice generation and transaction tracking
- **Notifications**: Email/SMS alerts for bookings, inventory, and follow-ups

## 🛠️ Technology Stack

- **Backend**: PHP
- **Frontend**: HTML, CSS, JavaScript, Bootstrap
- **Database**: MySQL
- **Server**: Apache (via XAMPP)
- **API Integrations**: Email/SMS notifications, Google Calendar sync

## 📦 Installation Guide

### Step 1: Clone the Repository

```bash
git clone https://github.com/ahmedhamzarana/Hair-Saloon-Project.git
cd Hair-Saloon-Project
```

### Step 2: Set Up the Database

1. Start **XAMPP** and enable Apache and MySQL.
2. Open [phpMyAdmin](http://localhost/phpmyadmin/)
3. Create a new database (e.g., `salon_db`)
4. Import the provided `salon_db.sql` file from the `database/` directory

### Step 3: Configure Database Connection

Edit the `config.php` file:

```php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "salon_db";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
```

### Step 4: Start the Application

1. Move the project folder to `htdocs` (inside your XAMPP installation directory)
2. Visit the project in your browser:

```
http://localhost/Hair-Saloon-Project/
```

### Default Login Credentials

| Role         | Email                    | Password |
|--------------|--------------------------|----------|
| Admin        | admin@example.com        | 1234     |
| Receptionist | receptionist@example.com | 1234     |
| Stylist      | stylist@example.com      | 1234     |
| Clients      | Register via signup page |          |

## 📁 Project Structure

```
Hair-Saloon-Project/
├── index.php               # Homepage
├── config.php              # DB Configuration
├── assets/                 # CSS, JS, Images
├── admin/                  # Admin Dashboard
├── users/                  # User Dashboard
├── database/               # SQL Scripts
├── appointment/            # Appointment Management
├── inventory/              # Inventory Management
├── staff/                  # Staff Management
├── reports/                # Reports & Analytics
```

## 🔮 Future Enhancements

- Online payments (PayPal, Stripe)
- AI-powered service recommendations
- Mobile apps for Android & iOS
- Advanced analytics and dashboard

## 👥 Contributors

- **Muhammad Rohan Sheikh**
- **Ahmed Hamza Rana**

## 📄 License

This project is licensed under the [MIT License](LICENSE).
