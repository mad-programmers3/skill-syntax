# SkillSyntax - Online Course Management System

SkillSyntax is an online course management system developed by our inter-team project. It allows users to browse, enroll, and manage programming courses seamlessly. Built using the Laravel 9 framework for the backend and Vue 2 for the frontend, it also incorporates Bootstrap 4 for responsive design.

## Features

- User Authentication (Login, Register)
- Admin dashboard for managing courses and users
- Course management (Add, Update, Delete, View Courses)
- Enroll and track course progress
- Responsive and modern UI/UX

## Tech Stack

- **Backend Framework**: Laravel 9
- **Frontend Framework**: Vue 2
- **UI Framework**: Bootstrap 4
- **Frontend Template**: [Edustage](https://themewagon.com/themes/free-responsive-bootstrap-4-html-5-educational-website-template-edustage/)
- **Backend Template**: [Breeze Admin Dashboard](https://themewagon.com/themes/breeze-free-bootstrap-4-responsive-admin-dashboard-template/)

## Project Setup

### Requirements

- PHP 8.0+
- Composer
- Node.js & npm

### Installation

```bash
git clone https://github.com/mad-programmers3/skill-syntax.git
cd skill-syntax
composer install
npm install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan db:seed
php artisan storage:link
```
