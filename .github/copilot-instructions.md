# Absences QR – Copilot Instructions

## Architecture & Roles

-   Laravel 9 app (PHP 8.2) with server-rendered views; frontend built via Laravel Mix (npm scripts in package.json) and minimal API usage (only default Sanctum /api/user).
-   Two roles: `admin` and `guru`, enforced by middleware aliases `admin` and `guru` in app/Http/Kernel.php and applied in grouped routes in routes/web.php.
-   Core domain: Users (guru/admin) → Schedules (per teacher/class/day/time) → Absences (attendance records tied to a schedule). Classes hold geolocation used for QR-based check-in.

## Key Flows & Controllers

-   Auth: registration restricted to guru; admin assumed pre-seeded. Controllers/AuthController.php handles register/login and redirects by role; logout clears session.
-   Dashboards: Admin metrics (today’s attendance counts per status) in AuthController::dashboardadmin; Guru profile/update flows in DashboardController (password update optional, uses bcrypt when provided).
-   Class QR codes: ClassController generates QR linking to `/users/absences/{class_name}` and can download PNG via Endroid QR builder; classes also capture latitude/longitude for geofence.
-   Attendance (guru-side): AbsenceController handles QR scan view, geofence distance check, and single-attendance-per-schedule enforcement; status determined by entry/out time with 30-minute grace. Note: store() currently hardcodes class coords and contains a `dd($distance)` debug stop that blocks production flow—remove when enabling real check-ins.
-   Admin CRUD: users, classes, schedules, absences handled by respective controllers with mass assignment (fillable set on models) and basic validation.

## Data Model Notes (see database/migrations)

-   users: username/email/password plus teacher metadata (nip, gender, rank/grade/job tiers, positions), role enum-like string.
-   classes: class_name with latitude/longitude decimals; qr_image column removed by migration; timestamps disabled in models.
-   schedules: fields study (added later), day, entry_time, out_time, user_id, class_id; foreign keys cascade.
-   absences: absence_datetime, status, optional description, schedule_id; no timestamps.

## Conventions & Patterns

-   Models disable timestamps and rely on explicit fillable arrays; remember to update fillable when adding columns.
-   Date/time handling via Carbon with Indonesian locale in attendance and dashboard flows; day matching uses translated day names.
-   Views follow folder names (absences/_, classes/_, schedules/_, users/_, dashboard/_, auth/_); redirects use named routes defined in routes/web.php.
-   Status values used today: "Hadir", "Terlambat", "Tidak hadir", and "Izin" (only counted on dashboard).

## Build, Run, Test

-   Setup: `composer install`, copy .env and run `php artisan key:generate`, then `php artisan migrate` (tables lack timestamps; ensure migrations ordered). For assets: `npm install` then `npm run dev` (or `npm run prod` for production).
-   Serve locally with `php artisan serve`; default API is Sanctum-protected /api/user only.
-   Tests: PHPUnit available via `php artisan test` or `vendor/bin/phpunit`; no custom tests exist.

## When Extending

-   Keep route protection consistent (admin vs guru) and place new pages inside existing middleware groups.
-   Preserve geofence/QR flow: QR links should include class_name; geolocation should read from ClassModel lat/long instead of hardcoded constants; remove debug `dd` calls before deploying.
-   When adding columns, update migrations, models’ fillable, and relevant controllers/views; remember models lack timestamps unless added explicitly.
-   Prefer using relationships (schedule->class/user) already defined on models when querying/filtering attendance or schedules.

If any section feels incomplete or unclear for contributors, tell me which part to refine (e.g., build steps, geofence flow, role handling).
