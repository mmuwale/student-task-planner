# 🎓 Student Task Planner

A Laravel-based task management system for students to track assignments, deadlines, and courses.

## 👥 Development Team
- **Maria Muwale - 192414** - Full-Stack Integrator & Team Lead
- **Githinji Mugambi - 189596** - Backend & Auth Specialist
- **Faith Muthoni - 178509** - Database & Data Manager  
- **Allan Waithaka - 191604** - UI/Layout Designer
- **Nathan Achar - 189206** - Frontend & UX Developer

## 🚀 Quick Start

### Prerequisites
- PHP 8.1+
- Composer
- MySQL 8.0+
- Git
- GitGuardian VS code extension (set up using your GitHub email)

### Installation
1. **Clone the repository**
   ```bash
   git clone git@github.com:mmuwale/student-task-planner.git
   cd student-task-planner
2. **Install PHP dependencies**
   ```bash
   composer install
3. **Environment Setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
4. **Database Setup**
  - Create a MySQL database named `student_planner`
    ```mysql
    CREATE DATABASE student_planner;
    ```
  - Update your `.env` file with your database credentials:
    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=student_planner
    DB_USERNAME=root
    DB_PASSWORD=(your mysql password)
    ```
5. **Run migrations**  
    `php artisan migrate`  
6. **Start development server**  
    ```bash
    php artisan serve
    ``` 
    Visit: `http://localhost:8000`

## Branch Information
  - Default Branch: `frontend/UX`
  - The default branch was changed from main because of merge conflicts.

# 🎯 Prototype Features

## Student Features

- ✅ **User Authentication** – Register, login, profile management, password reset
- ✅ **Course Enrollment** – Browse and select from available courses
- ✅ **Task & Assignment Tracking** – Create tasks with deadlines, priorities, and status based on enrolled courses
- ✅ **Progress Dashboard** – Overview of upcoming tasks, completion percentages, and weekly summaries
- ✅ **Course Resources** – Access course materials, files, and resources
- ✅ **Calendar Integration** – View and manage tasks in calendar format
- ✅ **Study Groups** – Join and participate in collaborative study sessions
- ✅ **Reminder System** – Smart deadline reminders and notifications
- ✅ **Search & Filter** – Find courses and tasks quickly with real-time search

## Admin Features

- 👑 **Full Course Management** – Exclusive rights to add, edit, and delete system-wide courses
- 👑 **User Management** – Manage student accounts, roles, and permissions
- 👑 **Course Content Control** – Create and organize course resources and materials
- 👑 **Task Analytics** – Monitor completion rates and student progress across all courses
- 👑 **System Configuration** – Manage application settings and defaults

## Core Functionalities

- 📚 **Course-Based Task Organization** – Users create tasks linked to specific enrolled courses
- 🎯 **Role-Based Access Control** – Admin-only course modification privileges
- 📊 **Visual Progress Tracking** – Completion percentages and progress indicators
- 🔔 **Smart Notifications** – Email reminders for deadlines and updates
- 📱 **Responsive Design** – Mobile-friendly interface for on-the-go access
- 🔍 **Real-Time Search** – Instant filtering of courses and tasks with debounced search
- 🎨 **Color-Coded System** – Visual organization with course-specific color schemes

# Gmail App Password Setup for Laravel

To configure Gmail SMTP in your Laravel application, you’ll need a Gmail App Password — your normal Gmail password won’t work for SMTP.

## 1. Enable 2-Step Verification

- Go to your Google Account
- Navigate to the Security section
- Under Signing in to Google, find 2-Step Verification
- Click Get started and follow the setup steps

## 2. Generate an App Password

Go back to the Security section
Scroll to App passwords under Signing in to Google
If you don’t see it, 2FA isn’t fully enabled yet
Click App passwords
Choose:
  - App: Mail
  - Device: Other → name it “Laravel” (or your project name)
Click Generate

## 3. Copy the App Password

Google will show a 16-character password (no spaces).

## 4. Configure Your Laravel .env File

```
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your.email@gmail.com
MAIL_PASSWORD=your_16_character_app_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=your.email@gmail.com
MAIL_FROM_NAME="${APP_NAME}"
```

## 5. Clear Laravel Config & Cache

```
php artisan config:clear
php artisan cache:clear
```

---

# Database Schema

```mermaid
erDiagram

    %% Core user and role entities
    users ||--o{ user_roles : has
    users ||--o{ courses : creates
    users ||--o{ tasks : creates
    users ||--o{ study_groups : creates
    users }o--o{ group_members : joins
    
    %% Course and task relationships
    courses ||--o{ tasks : contains
    tasks ||--o{ reminders : has
    tasks }o--|| study_groups : belongs_to
    
    %% Role management
    roles ||--o{ user_roles : assigned_to
    
    %% Study group relationships  
    study_groups ||--o{ group_members : has

    %% Table definitions
    users {
        BIGINT id PK
        VARCHAR name
        VARCHAR email UK
        VARCHAR password
        VARCHAR avatar_url "nullable"
        TIMESTAMP created_at
        TIMESTAMP updated_at
    }

    courses {
        BIGINT id PK
        VARCHAR course_code
        VARCHAR course_name
        VARCHAR color
        BIGINT user_id FK
        TIMESTAMP created_at
        TIMESTAMP updated_at
    }

    tasks {
        BIGINT id PK
        VARCHAR title
        TEXT description "nullable"
        DATE due_date
        TIME due_time "nullable"
        VARCHAR priority "low/medium/high/urgent"
        VARCHAR status "not_started/in_progress/completed"
        DECIMAL estimated_hours "nullable"
        BIGINT course_id FK "nullable"
        BIGINT user_id FK
        TIMESTAMP created_at
        TIMESTAMP updated_at
    }

    study_groups {
        BIGINT id PK
        VARCHAR group_name
        BIGINT task_id FK "nullable"
        BIGINT created_by FK
        TIMESTAMP created_at
        TIMESTAMP updated_at
    }

    group_members {
        BIGINT id PK
        BIGINT group_id FK
        BIGINT user_id FK
        TIMESTAMP joined_at
        TIMESTAMP created_at
        TIMESTAMP updated_at
    }

    reminders {
        BIGINT id PK
        BIGINT task_id FK
        VARCHAR reminder_offset "e.g., '3 days', '1 day'"
        VARCHAR sent_status "pending/sent/failed"
        TIMESTAMP scheduled_for
        TIMESTAMP created_at
        TIMESTAMP updated_at
    }

    roles {
        BIGINT id PK
        VARCHAR name UK "admin/student"
        VARCHAR description "nullable"
        TIMESTAMP created_at
        TIMESTAMP updated_at
    }

    user_roles {
        BIGINT id PK
        BIGINT user_id FK
        BIGINT role_id FK
        TIMESTAMP created_at
        TIMESTAMP updated_at
    }
