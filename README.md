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
