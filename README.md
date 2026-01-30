# 🎓 E-Learning Platform

A robust, full-featured online learning management system (LMS) built with **Laravel 12**, **Filament 3**, and **Livewire 3**. This platform empowers instructors to create and sell courses while providing students with an engaging learning experience.

## ✨ Key Features

### 👨‍🏫 For Instructors
- **Instructor Dashboard**: Detailed analytics on earnings, students, and course performance.
- **Course Builder**: Intuitive, step-by-step course creation wizard.
  - Video uploads & management.
  - Curriculum structuring (Sections & Lessons).
  - Quiz creation & grading.
  - Resource management (PDFs, docs).
- **Earnings & Payouts**: real-time earning tracking and payout request system.
- **Student Management**: Monitor student progress and enrollments.

### 👨‍🎓 For Students
- **Course Discovery**: Advanced search and filtering (Category, Level, Price).
- **My Learning**: Personalized dashboard to track enrolled courses and progress.
- **Course Player**: Immersive video player with:
  - Progress tracking.
  - Lesson completion marking.
  - Resource downloads.
  - Q&A discussions.
- **Certification**: Automated certificate generation upon course completion.

### 🛡️ For Admins (Filament Panel)
- **User Management**: Manage Students, Instructors, and Admins.
- **Course Moderation**: Review and approve/reject courses.
- **Content Management**: Manage Categories, Tags, and Reviews.
- **Financial Oversight**: Monitor payments, refunds, and instructor payouts.
- **System Settings**: Configure platform-wide settings (SEO, Mail, Payment Gateways).
- **Role-Based Access Control**: Granular permissions using Spatie Permissions.

## 🛠️ Tech Stack

- **Backend Framework**: Laravel 12.x
- **Frontend Interactivity**: Livewire 3.x (No complex JS frameworks required)
- **Admin Panel**: Filament 3.x
- **Database**: MySQL 8.x
- **Styling**: Tailwind CSS 3.x
- **Authentication**: Laravel Breeze
- **Permissions**: Spatie Laravel Permission
- **Media**: Spatie Media Library
- **Payments**: Laravel Cashier (Stripe Integration)

## 🚀 Getting Started

### Prerequisites
- PHP 8.2+
- Composer
- Node.js & NPM
- MySQL

### Installation

1.  **Clone the repository**
    ```bash
    git clone https://github.com/mohamedtarek64/E-Learning-platform.git
    cd E-Learning-platform
    ```

2.  **Install PHP Dependencies**
    ```bash
    composer install
    ```

3.  **Install NPM Dependencies**
    ```bash
    npm install && npm run build
    ```

4.  **Environment Setup**
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```
    *Configure your database credentials in the `.env` file.*

5.  **Database Migration & Seeding**
    ```bash
    php artisan migrate --seed
    ```
    *This will create the database structure and populate it with initial data (Admin user, Roles, etc.).*

6.  **Storage Link**
    ```bash
    php artisan storage:link
    ```

7.  **Run the Application**
    ```bash
    php artisan serve
    ```

### 🔑 Default Access

**Admin Panel**: `/admin`
- **Email**: `admin@example.com`
- **Password**: `password`

**Instructor Dashboard**: `/instructor/dashboard`
**Student Learning**: `/my-learning`

## 🤝 Contribution

Contributions are welcome! Please fork the repository and submit a pull request.

## 📄 License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
