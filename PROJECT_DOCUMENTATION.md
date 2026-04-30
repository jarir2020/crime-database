# Crime Database Application Documentation

## 📌 Project Overview
The **Crime Database Application** is a Laravel-based platform designed for reporting and managing crime incidents. It features a robust user authentication system, an admin dashboard for content moderation, and a unique "Self-Healing" database architecture.

---

## 🏗️ Architecture Stack
- **Backend**: Laravel 11 (PHP 8.2)
- **Frontend**: Blade, Tailwind CSS, Alpine.js (via Laravel Breeze)
- **Database**: MySQL (Production/Local) / SQLite (Optional)
- **Infrastructure**: Docker (Alpine Linux, Nginx, PHP-FPM, Supervisor)

---

## 🚀 Key Features

### 1. Crime Reporting & Tracking
- **Public/User View**: Users can view approved crimes and report new ones.
- **Admin Management**: Admins can approve, disapprove, or delete reported crimes.
- **Search & Filters**: AJAX-powered search for both users and admins.

### 2. Auto-Healing Database (Unique Feature) 🛡️
The application includes a custom `SelfHealing` trait located in `app/Traits/SelfHealing.php`. 
- **Automatic Table Creation**: If a model is accessed but its table is missing, it is created automatically.
- **Dynamic Column Repair**: If a feature requires new columns, the trait detects their absence and adds them to the database on the fly.
- **Implementation**: Used in `User`, `Crime`, and `AboutUs` models.

### 3. Optimized Docker Deployment
A single-container architecture optimized for platforms like Coolify:
- **Combined Services**: Nginx and PHP-FPM run in the same container to eliminate 502 Gateway errors.
- **Supervisor Managed**: All processes (Nginx, PHP-FPM, Laravel Queue) are controlled by Supervisor for maximum uptime.
- **Port 80 Ready**: Exposed directly for Traefik or other load balancers.

---

## 🛠️ Installation & Setup

### Local Setup (Laragon/XAMPP)
1. Clone the repository.
2. Run `composer install`.
3. Run `npm install && npm run build`.
4. Create a database named `crime_database`.
5. Configure `.env` (set `DB_CONNECTION=mysql`).
6. Run `php artisan migrate --seed`.

### Docker Deployment
1. Ensure Docker is installed.
2. Build and run: `docker-compose up --build -d`.
3. The app will be available on port `80`.

---

## 🔐 Default Credentials
| Role  | Email | Password |
| :--- | :--- | :--- |
| **Admin** | `admin@example.com` | `123456` |
| **User** | `jarircse16@gmail.com` | `123456` |

---

## 💡 Recommended Improvements & New Features

### 1. Security Enhancements
- **Rate Limiting**: Implement stricter rate limiting on crime reporting to prevent spam.
- **File Upload Validation**: Add virus scanning and strict MIME check for any future image upload features.
- **Two-Factor Authentication (2FA)**: Integrate 2FA for admin accounts using Laravel Fortify or a similar package.

### 2. New Features
- **Geolocation Integration**: Use a library like Leaflet.js to show crime locations on an interactive map.
- **Real-time Notifications**: Use Laravel Echo and Pusher/Soketi to notify admins instantly when a new crime is reported.
- **Media Support**: Allow users to upload photos or videos as evidence for reported crimes.
- **Export System**: Add functionality to export crime statistics to PDF or Excel (useful for local law enforcement reports).
- **Audit Logs**: Track which admin approved/disapproved a crime for better accountability.

### 3. Technical Debt / Refactoring
- **API Versioning**: If a mobile app is planned, start versioning API routes (`/api/v1/...`).
- **Caching**: Implement Redis caching for the "About Us" and approved crime listings to reduce database load.
- **Automated Testing**: Expand the `tests/` directory with feature tests for the Self-Healing trait.

---
*Generated on: 2026-03-15 by Antigravity AI*
