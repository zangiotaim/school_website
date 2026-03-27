# School Website CMS

<p align="center">
  <a href="https://github.com/zangiotaim/school_website/releases"><img src="https://img.shields.io/github/v/release/zangiotaim/school_website" alt="Version" /></a>
  <a href="https://github.com/zangiotaim/school_website"><img src="https://img.shields.io/github/languages/top/zangiotaim/school_website" alt="Top Language" /></a>
  <a href="https://github.com/zangiotaim/school_website"><img src="https://img.shields.io/github/languages/count/zangiotaim/school_website" alt="Languages Count" /></a>
  <a href="https://github.com/zangiotaim/school_website/blob/main/LICENSE"><img src="https://img.shields.io/badge/license-MIT-green" alt="MIT License" /></a>
  <a href="https://github.com/zangiotaim/school_website"><img src="https://img.shields.io/badge/status-Active-success" alt="Status" /></a>
</p>

<p align="center">
  <a href="https://github.com/zangiotaim/school_website"><img src="https://img.shields.io/badge/PHP-8.3%2B-777BB4?logo=php" alt="PHP 8.3+" /></a>
  <a href="https://github.com/zangiotaim/school_website"><img src="https://img.shields.io/badge/MySQL-8.0%2B-4479A1?logo=mysql" alt="MySQL 8.0+" /></a>
  <a href="https://github.com/zangiotaim/school_website/graphs/contributors"><img src="https://img.shields.io/github/contributors/zangiotaim/school_website" alt="Contributors" /></a>
  <a href="https://github.com/zangiotaim/school_website/stargazers"><img src="https://img.shields.io/github/stars/zangiotaim/school_website" alt="Stars" /></a>
  <a href="https://github.com/zangiotaim/school_website/forks"><img src="https://img.shields.io/github/forks/zangiotaim/school_website" alt="Forks" /></a>
  <a href="https://github.com/zangiotaim/school_website/commits/main"><img src="https://img.shields.io/github/last-commit/zangiotaim/school_website" alt="Last Commit" /></a>
</p>

> **A PHP/MySQL school website CMS for modern educational institutions.**
>
> It includes a public-facing website and an admin panel for managing notices, flash notices, staff profiles, gallery albums, class routines, contact feedback, student admissions, and editable site content.

## Overview

This project is designed for schools, training centers, and educational institutions that need:

- a public website with notices, gallery, routines, contact, and admission pages
- a password-protected admin panel
- editable homepage/about/contact/join page content
- staff and management directory pages
- a MySQL seed file for quick local setup

The codebase is built with PHP, MySQL, Tailwind utility classes, and a small set of helper functions for authentication, uploads, and database access.

## Project Structure

The project has two main areas:

- a public-facing website for visitors, students, and parents
- an admin panel for managing content, notices, media, staff, routines, feedback, and admissions

Shared PHP includes handle database access, authentication, uploads, escaping, and content helpers.

## Core Features

- Flash notice banner on the home page
- News and downloadable school notices
- Staff and management committee directory
- Admission form with student registration storage
- Contact form with admin-side feedback inbox
- Gallery albums and image pages
- Routine management for classes
- Admin-managed editable page content via `web_content`
- Admin and scribe role support

## Database

The project ships with `database.sql`.

Important notes:

- `database.sql` is a fresh-install SQL file
- it is database-name agnostic, so import it into any database you choose
- it includes `DROP TABLE IF EXISTS`, so re-importing it will reset the project tables in the selected database

Main database areas include admin accounts, notices, admissions, contact feedback, gallery content, routines, staff and management records, notifications, and editable site content.

## Requirements

- PHP 8.x recommended
- MySQL 8.x recommended
- A web server such as Apache/Nginx, or PHP built-in server for local development

## Installation

### Linux / WSL

1. Clone the repository:

```bash
git clone https://github.com/zangiotaim/school_website.git
cd school_website
```

2. Install PHP and MySQL if needed:

```bash
sudo apt update
sudo apt install php php-mysql mysql-server
```

3. Create a database of your choice:

```sql
CREATE DATABASE school_website CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
```

4. Import the fresh-install SQL:

```bash
mysql -u your_user -p school_website < database.sql
```

5. Update `config/db.php` with your real database settings:

- `$server`
- `$username`
- `$password`
- `$database`
- `$databasePort`

6. Start the project locally:

```bash
php -S localhost:8000
```

7. Open:

- public site: `http://localhost:8000`
- admin login: `http://localhost:8000/admin/`

### Windows

1. Install XAMPP, WAMP, or another PHP/MySQL stack
2. Place the project in your web root, such as `htdocs`
3. Create a database in phpMyAdmin or MySQL
4. Import `database.sql`
5. Update `config/db.php`
6. Open the site in your browser

## Admin Login

The default admin seed in `database.sql` includes a single admin account.

- login page: `/admin/`
- login uses `identity_code` and `password`

Change the seeded credentials immediately before any real deployment.

## Content Areas

This project includes editable content for:

- home page
- about page
- contact page
- join/admissions page
- extras/resources page

Those sections are managed from `admin/site_content.php`.

## Media Paths

Uploaded media is stored under `assets/images/`.

Make sure your deployment environment allows PHP to write to the required upload folders.

## Development Notes

- The DB connection uses PDO with prepared statements
- Admin auth uses session-based authentication and CSRF protection helpers
- Some parts of the project are modernized, while some legacy page structure remains
- Several titles and older branding strings in the UI may still need cleanup depending on your deployment

## Maintainers

**Uzhost Developers Group** currently maintains and customizes this project.

- Repository: [zangiotaim/school_website](https://github.com/zangiotaim/school_website)
- Based on: [AcrNischal/Full-School-Website](https://github.com/AcrNischal/Full-School-Website)
- Contact: [info@uzhost.net](mailto:info@uzhost.net)

## License

This project is distributed under the MIT License. See `LICENSE`.
