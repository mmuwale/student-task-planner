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


  # Database Schema

## 🗄️ Tables Structure

### Users
| Column | Type | Description |
|--------|------|-------------|
| id | integer | Primary key |
| name | varchar | User's full name |
| email | varchar | User's email address |
| password | varchar | Hashed password |
| avatar_url | varchar | Profile picture URL |
| created_at | timestamp | Record creation time |
| updated_at | timestamp | Record last update time |

### Courses
| Column | Type | Description |
|--------|------|-------------|
| id | integer | Primary key |
| course_code | varchar | Course code (e.g., ICS 1201) |
| course_name | varchar | Course full name |
| color | varchar | UI color for the course |
| user_id | integer | Foreign key → users.id |
| created_at | timestamp | Record creation time |
| updated_at | timestamp | Record last update time |

### Tasks
| Column | Type | Description |
|--------|------|-------------|
| id | integer | Primary key |
| title | varchar | Task title |
| description | text | Task description |
| due_date | date | Due date |
| due_time | time | Due time |
| priority | varchar | Priority level (low/medium/high/urgent) |
| status | varchar | Status (not_started/in_progress/completed) |
| estimated_hours | decimal | Estimated time to complete |
| course_id | integer | Foreign key → courses.id |
| user_id | integer | Foreign key → users.id |
| created_at | timestamp | Record creation time |
| updated_at | timestamp | Record last update time |

### Study Groups
| Column | Type | Description |
|--------|------|-------------|
| id | integer | Primary key |
| group_name | varchar | Study group name |
| task_id | integer | Foreign key → tasks.id |
| created_by | integer | Foreign key → users.id |
| created_at | timestamp | Record creation time |
| updated_at | timestamp | Record last update time |

### Group Members
| Column | Type | Description |
|--------|------|-------------|
| id | integer | Primary key |
| group_id | integer | Foreign key → study_groups.id |
| user_id | integer | Foreign key → users.id |
| joined_at | timestamp | When user joined the group |
| created_at | timestamp | Record creation time |
| updated_at | timestamp | Record last update time |

### Reminders
| Column | Type | Description |
|--------|------|-------------|
| id | integer | Primary key |
| task_id | integer | Foreign key → tasks.id |
| reminder_offset | varchar | Offset (e.g., "3 days", "1 day") |
| sent_status | varchar | Status (pending/sent/failed) |
| scheduled_for | timestamp | When to send reminder |
| created_at | timestamp | Record creation time |
| updated_at | timestamp | Record last update time |

### Roles
| Column | Type | Description |
|--------|------|-------------|
| id | integer | Primary key |
| name | varchar | Role name (student/admin) |
| description | varchar | Role description |
| created_at | timestamp | Record creation time |
| updated_at | timestamp | Record last update time |

### User Roles
| Column | Type | Description |
|--------|------|-------------|
| id | integer | Primary key |
| user_id | integer | Foreign key → users.id |
| role_id | integer | Foreign key → roles.id |
| created_at | timestamp | Record creation time |
| updated_at | timestamp | Record last update time |

## 🔗 Relationships

- **Users** → have many **Courses**
- **Users** → have many **Tasks**
- **Users** → have many **Reminders**
- **Users** → belong to many **Study Groups** (through group_members)
- **Users** → belong to many **Roles** (through user_roles)
- **Courses** → have many **Tasks**
- **Tasks** → have many **Reminders**
- **Tasks** → have one **Study Group**
- **Study Groups** → have many **Users** (through group_members)

## 📊 Visual Schema

For a visual representation of the database schema, check the `Database schema IAP Project.pdf` file in the project documentation.
