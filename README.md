# Portal - Web Management System

[![Laravel](https://img.shields.io/badge/Laravel-10.x-red.svg)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.1+-blue.svg)](https://php.net)
[![Bootstrap](https://img.shields.io/badge/Bootstrap-5.1-purple.svg)](https://getbootstrap.com)
[![License](https://img.shields.io/badge/license-MIT-green.svg)](LICENSE)

A comprehensive, secure, and scalable web portal built with Laravel for managing users, projects, and employees. This application demonstrates modern web development practices including role-based authentication, session management, and advanced security features.

## 📋 Table of Contents

- [Features](#-features)
- [Requirements](#-requirements)
- [Installation](#-installation)
- [Usage](#-usage)
- [Web Endpoints](#-web-endpoints)
- [Database Schema](#-database-schema)
- [Security Features](#-security-features)
- [Testing](#-testing)
- [Project Structure](#-project-structure)
- [License](#-license)

## 🚀 Features

### Core Functionality
- **User Authentication & Authorization**
  - Secure login/registration with password hashing
  - Role-based access control (Admin/User)
  - Session timeout with automatic logout

- **User Management (Admin Only)**
  - View paginated list of users
  - Advanced search and filtering by name, email, role
  - Edit user information and roles
  - Activate/deactivate user accounts
  - Real-time user status management

- **Project Management**
  - Create, read, update, delete projects
  - Assign projects to employees
  - Track project descriptions and tasks
  - Employee-project relationship management

- **Employee Directory**
  - Comprehensive employee listing with department info
  - Employee profiles with project assignments
  - Salary tracking and department analytics
  - Multi-project employee identification

- **Analytics Dashboard**
  - Department salary expenditure analysis
  - Employee project assignment statistics
  - Interactive data visualizations

### Security Features
- **Security Implementations**
  - CSRF protection on all forms
  - Input validation and sanitization
  - SQL injection prevention via Eloquent ORM
  - XSS protection with Blade templating
  - Secure password hashing (bcrypt)

### User Experience
- **Responsive Design**
  - Mobile-first Bootstrap 5 framework
  - Custom CSS with modern styling
  - Touch-friendly interface
  - Cross-browser compatibility

- **Interactive Features**
  - Real-time search and filtering
  - Smooth transitions
  - Professional notification system

## 💻 Requirements

- **PHP**: 8.1 or higher
- **Composer**: Latest version
- **Database**: MySQL 8.0+
- **Node.js**: 16+ (for asset compilation)

### PHP Extensions Required
```
- BCMath
- Ctype
- Fileinfo
- JSON
- Mbstring
- OpenSSL
- PDO
- Tokenizer
- XML
```

## 🛠 Installation

### 1. Clone the Repository
```bash
git clone https://github.com/yourusername/portal-app.git
cd portal-app
```

### 2. Install Dependencies
```bash
# Install PHP dependencies
composer install

# Install Node dependencies (if using asset compilation)
npm install
```

### 3. Environment Configuration
```bash
# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

### 4. Database Setup
```bash
# Create database (MySQL example)
mysql -u root -p -e "CREATE DATABASE portal_db;"

# Update .env with your database credentials
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=portal_db
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### 5. Run Migrations & Seeders
```bash
# Run database migrations
php artisan migrate

# Seed the database with sample data
php artisan db:seed
```

### 6. Start Development Server
```bash
php artisan serve
```

The application will be available at `http://localhost:8000`

## 🎯 Usage

### Default Accounts
After running the seeders, you can log in with:

**Administrator Account:**
- Email: `admin@example.com`
- Password: `password`
- Role: Admin (full access)

**Regular User Account:**
- Email: `user@example.com`
- Password: `password`
- Role: User (limited access)

### Admin Features
Administrators can access:
- User management dashboard
- User creation and editing
- User activation/deactivation
- All project and employee features
- Analytics dashboard

### User Features
Regular users can access:
- Personal dashboard
- Project viewing and creation
- Employee directory
- Basic analytics

## 🔌 WEB Endpoints

### Authentication
```
POST   /login              # User login
POST   /register           # User registration
POST   /logout             # User logout
```

### User Management (Admin Only)
```
GET    /users              # List users with filters
GET    /users/{id}         # Show user details
PUT    /users/{id}         # Update user
POST   /users/{id}/toggle-status  # Toggle user status
```

### Projects
```
GET    /projects           # List projects
POST   /projects           # Create project
GET    /projects/{id}      # Show project
PUT    /projects/{id}      # Update project
DELETE /projects/{id}      # Delete project
```

### Employees
```
GET    /employees          # List employees
GET    /employees/{id}     # Show employee details
```

### Analytics
```
GET    /analytics          # Analytics dashboard
```

## 🗄️ Database Schema

### Users Table
```sql
- id (Primary Key)
- name (String)
- email (String, Unique)
- password (String, Hashed)
- role (Enum: admin, user)
- is_active (Boolean)
- email_verified_at (Timestamp)
- created_at, updated_at (Timestamps)
```

### Departments Table
```sql
- id (Primary Key)
- name (String)
- created_at, updated_at (Timestamps)
```

### Employees Table
```sql
- id (Primary Key)
- name (String)
- department_id (Foreign Key → departments.id)
- salary (Decimal)
- created_at, updated_at (Timestamps)
```

### Projects Table
```sql
- id (Primary Key)
- project_name (String)
- description (Text, Nullable)
- employee_id (Foreign Key → employees.id)
- task (Text, Nullable)
- created_at, updated_at (Timestamps)
```

## 🔒 Security Features

### Authentication Security
- **Password Hashing**: BCrypt with configurable rounds
- **Session Security**: Secure, HttpOnly cookies
- **CSRF Protection**: Laravel's built-in CSRF middleware
- **Input Validation**: Comprehensive form request validation

### Session Management
- **Session Expire**: Every Hour
- **Session Regeneration**: New session ID on login

### Access Control
- **Role-Based Access**: Admin/User role separation
- **Route Protection**: Middleware-based access control
- **Resource Authorization**: Controller-level permissions
- **UI Conditional Rendering**: Role-based view components

## 🧪 Testing

### Run Tests
```bash
# Run all tests
php artisan test

# Run specific test suite
php artisan test --testsuite=Feature

# Run with coverage
php artisan test --coverage
```

### Test Accounts
Use the seeded accounts for testing:
- Admin: `admin@example.com` / `password`
- User: `user@example.com` / `password`

### Manual Testing Checklist
- [ ] User registration and login
- [ ] Admin user management
- [ ] Project CRUD operations
- [ ] Employee directory
- [ ] Analytics dashboard
- [ ] Mobile responsiveness
- [ ] Cross-browser compatibility

## 📁 Project Structure

```
portal-app/
├── app/
│   ├── Http/
│   │   ├── Controllers/         # Request handling logic
│   │   ├── Middleware/          # Custom middleware
│   │   └── Requests/           # Form validation
│   ├── Models/                 # Eloquent models
│   ├── Services/              # Business logic layer
│   └── Repositories/          # Data access layer
├── database/
│   ├── migrations/            # Database structure
│   └── seeders/              # Sample data
├── resources/
│   └── views/                # Blade templates
│       ├── layouts/          # Layout templates
│       ├── auth/            # Authentication views
│       ├── users/           # User management views
│       ├── projects/        # Project views
│       ├── employees/       # Employee views
│       └── analytics/       # Analytics views
├── public/
│   └── css/                 # Custom stylesheets
├── routes/
│   └── web.php             # Application routes
└── tests/                  # Application tests
```

## 🛠 Development


### Asset Compilation
```bash
# Compile assets for development
npm run dev

# Watch for changes
npm run watch

# Build for production
npm run build
```

### Cache Management
```bash
# Clear application cache
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Optimize for production
php artisan optimize
```

## 📊 Performance Optimization

### Database Optimization
- **Eager Loading**: Implemented for relationships
- **Query Optimization**: Efficient joins and indexes
- **Pagination**: Prevents memory issues with large datasets

### Caching Strategy
- **Route Caching**: Production route optimization
- **Config Caching**: Environment configuration caching
- **View Caching**: Compiled Blade template caching

### Frontend Optimization
- **Asset Minification**: CSS/JS compression
- **Image Optimization**: Responsive image loading
- **CDN Integration**: Bootstrap and FontAwesome from CDN

## 📄 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## 🙏 Acknowledgments

- **Laravel Framework** - The foundation of this application
- **Bootstrap** - Responsive UI framework
- **FontAwesome** - Icon library
- **PHP Community** - For excellent documentation and support

---

**Built with ❤️ using Laravel**

*This project demonstrates modern web development practices including secure authentication, session management, role-based access control, and responsive design.*