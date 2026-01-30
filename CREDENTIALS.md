# 🔐 E-Learning Platform - Login Credentials

## Filament Admin Panel Access

### 📍 URL
```
http://localhost:8000/admin
```

---

## 👤 Admin User Credentials

### Default Admin Account
```
Email:    admin@elearning.com
Password: password
Role:     admin
```

---

## 🚀 How to Login

1. **Open your browser** and go to: `http://localhost:8000/admin`

2. **Enter credentials**:
   - Email: `admin@elearning.com`
   - Password: `password`

3. **Click "Sign in"**

4. **You're in!** You'll see the dashboard with:
   - Stats Overview (Students, Courses, Enrollments)
   - Courses Chart
   - Latest Courses Table

---

## 🔧 Create Additional Admin Users

If you want to create more admin users, run:

```bash
php artisan make:filament-user
```

Then follow the prompts to enter:
- Name
- Email
- Password

The user will automatically be created with admin access.

---

## 🔑 Alternative: Using Existing Users

If you already have users in your database from the regular Laravel Breeze registration:

1. **Find them in the database**:
   ```sql
   SELECT name, email, role FROM users;
   ```

2. **Update their role to admin** (if needed):
   ```bash
   php artisan tinker
   ```
   Then run:
   ```php
   $user = App\Models\User::where('email', 'your@email.com')->first();
   $user->role = 'admin';
   $user->save();
   ```

3. **Login at** `http://localhost:8000/admin` with their credentials

---

## 📝 Notes

- **Default password** for the created admin is: `password`
- **Change it** immediately in production!
- **Role required**: User must have `role = 'admin'` in the database
- **Email verification**: Not required for Filament admin access

---

## 🛡️ Security Reminders

⚠️ **For Development Only**
- Current credentials are for testing/development
- DO NOT use in production

🔒 **For Production**
- Use strong, unique passwords
- Enable 2FA via Filament plugins
- Use environment variables for credentials
- Implement proper user management

---

## 🆘 Troubleshooting

### Can't login?
1. Check if user exists in database
2. Verify role is set to 'admin'
3. Clear cache: `php artisan cache:clear`
4. Check `storage/logs/laravel.log` for errors

### Forgot password?
Run:
```bash
php artisan tinker
```
Then:
```php
$user = App\Models\User::where('email', 'admin@elearning.com')->first();
$user->password = Hash::make('newpassword');
$user->save();
```

---

**Happy Admin-ing! 🎉**

_Last updated: 2026-01-29_
