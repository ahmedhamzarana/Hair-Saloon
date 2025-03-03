Elegance Salon Management System

Project Overview

Elegance Salon Management System is a web-based application designed to streamline salon operations, including appointment booking, client management, inventory tracking, and staff scheduling. Built using PHP, MySQL, AJAX, and other web technologies, it enhances efficiency and improves the overall customer experience.

Features

User Authentication: Secure login and role-based access control (Admin, Receptionist, Stylist, Client).

Appointment Management: Book, reschedule, cancel, and manage salon appointments.

Client Management: Maintain customer records, preferences, and history.

Inventory Management: Track product stock, set alerts for low inventory, and manage supplier details.

Staff Scheduling: Assign shifts, manage staff profiles, and track commissions.

Reporting & Analytics: Generate reports on revenue, services, and staff performance.

Payment & Invoicing: Record transactions and generate receipts for services.

Notifications: Email/SMS reminders for appointments, inventory updates, and client follow-ups.

Technology Stack

Backend: PHP, MySQL

Frontend: HTML, CSS, JavaScript, Bootstrap

Database: MySQL

Server: Apache (via XAMPP)

API Integrations: Email/SMS notifications, Google Calendar sync

Installation Guide

Step 1: Clone the Repository

git clone https://github.com/ahmedhamzarana/Hair-Saloon-Project.git
cd Hair-Saloon-Project

Step 2: Set Up the Database

Start XAMPP and enable Apache and MySQL.

Open phpMyAdmin (http://localhost/phpmyadmin/).

Create a new database (e.g., salon_db).

Import the provided salon_db.sql file from the project directory.

Step 3: Configure Database Connection

Edit the config.php file to match your local database settings:

<?php
$servername = "localhost";
$username = "root";  // Default XAMPP username
$password = "";      // Default XAMPP password is empty
$dbname = "salon_db";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

Step 4: Start the Project

Move the project folder to htdocs (inside the XAMPP installation directory).

Open a web browser and visit:

http://localhost/Hair-Saloon-Project/

Use the default login credentials:

Admin: admin@example.com / 1234

Receptionist: receptionist@example.com / 1234

Stylist: stylist@example.com / 1234

Clients: Register through the signup page.

Project Structure

Hair-Saloon-Project/
│── index.php          # Homepage
│── config.php         # Database Configuration
│── assets/            # CSS, JS, Images
│── admin/             # Admin Panel
│── users/             # User Dashboard
│── database/          # SQL Scripts
│── appointment/       # Appointment Management
│── inventory/         # Inventory Management
│── staff/             # Staff Management
│── reports/           # Reports & Analytics

Future Enhancements

Online payment integration (PayPal, Stripe).

Advanced analytics dashboard.

Mobile app version for Android & iOS.

AI-powered service recommendations.

Contributors

Muhammad Rohan Sheikh

Ahmed Hamza Rana

License

This project is licensed under the MIT License.
