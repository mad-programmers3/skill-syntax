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
- **Frontend Template**: https://themewagon.com/themes/free-education-html-template-bootstrap-4-course/
- **Backend Template**: https://themewagon.com/themes/breeze-free-bootstrap-4-responsive-admin-dashboard-template/

## Project Setup

### Requirements

- PHP 8.0+
- Composer
- Node.js & npm

### Installation

1. *Clone the repository:*
   bash
   git clone https://github.com/your-repo/skill-syntax.git
   cd skill-syntax


## Workflow
- Installation
- Setup git
- Mastering
- Route setup
- DB Connection
- Authentication
- Create migration, model, controller
- CRUD for course



## Course table details
1. Columns:
    - Title: string|max:255
    - Description: text|5000
    - Price: decimal(8, 2)|def(0.00)
    - User id(Instructor id): forenkey|5000
    - Category id: frenkey // Category of the course (e.g., Web Development)
    - Sits: integer // available sits
    - Star date: date
    - End date: date
    - Thumbnail: string|nullable
    ##### Opt:
    - $table->string('level')->nullable(); // Beginner, Intermediate, Advanced


## User table details

### User rules/types:
1. **Admin**: 
    - Has full access to the system.
    - **Permissions**:
        - Perform CRUD (Create, Read, Update, Delete) operations on:
            - Courses
            - Categories
            - Users (Admins, Instructors, Students)
        - Manage course enrollments.
        - View reports and analytics on system usage and performance.
        - Approve or reject instructor course submissions.
        - Manage site settings (general configuration, payment settings, etc.).

2. **Instructor**:
    - Manages their own courses.
    - **Permissions**:
        - Create, read, update, and delete their own courses.
        - Add lessons/modules to their courses.
        - View and manage students enrolled in their courses.
        - Respond to student questions and discussions related to their courses.
        - Track student progress within their courses.
        - View course analytics (enrollment stats, ratings, feedback, etc.).

3. **Student**:
    - Can enroll in and participate in courses.
    - **Permissions**:
        - Browse available courses and enroll.
        - Access course materials (videos, articles, quizzes, etc.).
        - Track their own course progress.
        - Submit assignments and take quizzes/exams.
        - Participate in course discussions (ask questions, comment).
        - Leave ratings and reviews on completed courses.
        - Receive certificates or course completion badges.
        
### Columns:
  - Name: string|max:255
  - Email: string|unique
  - Password: string
  - Type: integer| 1=Admin, 2=Instructor, 3=Student









  ### se valo nai 

