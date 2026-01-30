# E-Learning Platform

A complete online learning management system built with Laravel 12 and Filament 4 admin panel. The platform enables instructors to create and monetize video courses while providing students with an intuitive learning experience.

![Laravel](https://img.shields.io/badge/Laravel-12.x-FF2D20?style=flat-square&logo=laravel)
![Filament](https://img.shields.io/badge/Filament-4.x-FFAA00?style=flat-square&logo=laravel)
![Livewire](https://img.shields.io/badge/Livewire-3.x-FB70A9?style=flat-square&logo=livewire)
![PHP](https://img.shields.io/badge/PHP-8.2+-777BB4?style=flat-square&logo=php)
![License](https://img.shields.io/badge/License-MIT-green?style=flat-square)

---

## About

This project is a training/portfolio application demonstrating advanced Laravel backend development. It covers complex business logic including:

- Multi-role user management (Admin, Instructor, Student)
- Course creation with video lessons and curriculum structuring
- Student enrollment and progress tracking
- Payment processing with Stripe integration
- Instructor earnings and payout management
- Certificate generation upon course completion

---

## Tech Stack

| Category | Technology |
|----------|------------|
| Backend | Laravel 12, PHP 8.2+ |
| Frontend | Livewire 3, Blade, Tailwind CSS |
| Admin Panel | Filament 4 |
| Database | MySQL 8.0+ |
| Authentication | Laravel Breeze |
| Authorization | Spatie Permission |
| Media Handling | Spatie Media Library, Intervention Image |
| Video Processing | FFmpeg via Laravel-FFmpeg |
| Payments | Laravel Cashier (Stripe) |
| PDF Generation | DomPDF |
| Excel Export | Maatwebsite Excel |

---

## Features

### Student Features
- Browse and search courses by category, level, and price
- Enroll in free or paid courses
- Video player with progress tracking
- Mark lessons as complete
- Download course resources
- Rate and review courses
- Earn certificates upon completion

### Instructor Features
- Apply to become an instructor
- Multi-step course creation wizard
- Upload and manage video lessons
- Create sections and organize curriculum
- Set course pricing
- View earnings dashboard
- Request payouts

### Admin Panel (Filament)
- User management with role assignment
- Approve/reject instructor applications
- Course moderation
- Category management
- Payment and payout oversight
- Analytics dashboard
- Site settings configuration

---

## Database Schema

The application uses ~26 migration files covering:

- **Users & Profiles**: users, instructor_profiles, student_profiles
- **Courses**: categories, courses, course_sections, lessons, lesson_resources
- **Quizzes**: quizzes, quiz_questions, quiz_answers, student_quiz_attempts
- **Enrollments**: course_enrollments, lesson_completions, course_progress
- **Reviews**: course_reviews, review_reports
- **Payments**: payments, instructor_earnings, instructor_payouts
- **Certificates**: certificates
- **Discussions**: course_discussions, discussion_replies
- **Marketing**: coupons, coupon_usages, course_announcements
- **Shopping**: wishlists, cart_items
- **Analytics**: course_views, video_watch_logs

---

## Installation

### Requirements
- PHP 8.2 or higher
- Composer
- Node.js 18+ and NPM
- MySQL 8.0+
- FFmpeg (optional, for video processing)

### Setup

```bash
# Clone the repository
git clone https://github.com/mohamedtarek64/E-Learning-platform.git
cd E-Learning-platform

# Install PHP dependencies
composer install

# Install Node dependencies and build assets
npm install
npm run build

# Copy environment file and generate app key
cp .env.example .env
php artisan key:generate

# Configure database in .env file
# DB_DATABASE=elearning
# DB_USERNAME=root
# DB_PASSWORD=

# Run migrations and seeders
php artisan migrate --seed

# Create storage link
php artisan storage:link

# Start the development server
php artisan serve
```

Or use the quick setup script:
```bash
composer setup
```

---

## Default Credentials

| Role | Email | Password |
|------|-------|----------|
| Admin | admin@example.com | password |

Access the admin panel at: `/admin`

---

## Project Structure

```
app/
├── Filament/           # Admin panel resources, pages, widgets
│   ├── Resources/      # CRUD resources (Users, Courses, Payments, etc.)
│   ├── Pages/          # Custom pages (Analytics, Settings)
│   └── Widgets/        # Dashboard widgets
├── Http/
│   └── Controllers/    # HTTP controllers
├── Livewire/           # Livewire components
│   ├── Public/         # Public-facing components (CourseGrid, CourseShow)
│   ├── Student/        # Student components (MyLearning, CoursePlayer)
│   └── Instructor/     # Instructor components (Dashboard, CourseBuilder)
├── Models/             # Eloquent models
└── Policies/           # Authorization policies

resources/views/
├── components/         # Blade components
├── layouts/            # Layout templates
└── livewire/           # Livewire component views
```

---

## Routes

| Route | Description |
|-------|-------------|
| `/` | Homepage with course listings |
| `/courses/{slug}` | Course details page |
| `/login`, `/register` | Authentication |
| `/my-learning` | Student enrolled courses |
| `/courses/{id}/learn` | Course player |
| `/become-instructor` | Instructor application |
| `/instructor/dashboard` | Instructor dashboard |
| `/instructor/courses` | Manage instructor courses |
| `/admin` | Filament admin panel |

---

## Configuration

### Stripe Payments
Add your Stripe keys to `.env`:
```
STRIPE_KEY=pk_test_...
STRIPE_SECRET=sk_test_...
STRIPE_WEBHOOK_SECRET=whsec_...
```

### Mail
Configure mail settings in `.env` for notifications:
```
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=587
MAIL_USERNAME=
MAIL_PASSWORD=
```

---

## Development

Run the development server with hot reload:
```bash
composer dev
```

This starts:
- Laravel server on port 8000
- Queue worker
- Vite for asset compilation

Run tests:
```bash
composer test
```

---

## Author

**Mohamed Elkenany**  
mohamedelkenany001@gmail.com

---

## License

This project is open-sourced under the [MIT License](LICENSE).
