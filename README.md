# 🎓 Student Task Planner

A Laravel-based task management system for students to track assignments, deadlines, and courses.

## 👥 Development Team
- **Maria Muwale - 192414** - Full-Stack Integrator & Team Lead
- *[To be assigned]* - Backend & Auth Specialist
- **Faith Muthoni - 178509** - Database & Data Manager  
- **Allan Waithaka - 191604** - UI/Layout Designer
- *[To be assigned]* - Frontend & UX Developer

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
  - Update your `.env` file with your database credentials:
  ```env
  DB_DATABASE=student_planner
  DB_USERNAME=your_mysql_username
  DB_PASSWORD=your_mysql_password
  ```
5. **Run migrations**  
  `php artisan migrate`  
6. **Start development server**  
  `php artisan serve`  
  Visit: `http://localhost:8000`