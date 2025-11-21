<div align="center">

# 🎉 EventsManager

### *A modern event management platform*

![PHP](https://img.shields.io/badge/PHP-8.x-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MariaDB](https://img.shields.io/badge/MariaDB-003545?style=for-the-badge&logo=mariadb&logoColor=white)
![MongoDB](https://img.shields.io/badge/MongoDB-47A248?style=for-the-badge&logo=mongodb&logoColor=white)
![Composer](https://img.shields.io/badge/Composer-885630?style=for-the-badge&logo=composer&logoColor=white)

</div>

---

## 📋 Table of Contents

- [About](#-about)
- [Features](#-features)
- [Architecture](#-architecture)
- [Installation](#-installation)
- [Project Structure](#-project-structure)
- [Technologies](#-technologies)
- [Configuration](#-configuration)
- [API Endpoints](#-api-endpoints)
- [Naming Conventions](#-naming-conventions)
- [Contributing](#-contributing)
- [License](#-license)

---

## 🎯 About

**EventsManager** is a comprehensive web application designed to manage events efficiently. Users can:

- 📅 **View** upcoming events
- ➕ **Create** new events
- ✏️ **Edit** existing events
- 🗑️ **Delete** events
- 👥 **Register** for events
- 🚪 **Unregister** from events

The platform integrates data from multiple event providers: **LiveTicket**, **DiSisFine**, and **TrueGister**.

---

## ✨ Features

- 🔄 **Multi-source integration** - Aggregate events from different providers
- 💾 **Dual database support** - MySQL/MariaDB and MongoDB
- 🎨 **Modern UI** - Sleek grey-themed responsive design
- 🛡️ **PSR-4 compliant** - Following PHP standards
- 📱 **Responsive design** - Works on all devices
- ⚡ **Fast and efficient** - Optimized queries and caching

---

## 🏗️ Architecture

### 📁 Project Structure

```
EventsManager/
├── 📂 Src/                    # Application source code (PSR-4)
│   ├── Controllers/           # Handle HTTP requests
│   ├── Repositories/          # Data access layer
│   ├── Dto/                   # Data Transfer Objects
│   ├── Services/              # Business logic
│   └── Cores/                 # Core utilities (Router, Renderer, Database)
│
├── 📂 public/                 # Web root directory
│   ├── index.php              # Application entry point
│   ├── .htaccess              # Application security file
│   └── assets/                # Static files
│       └── css/               # Stylesheets
├── 📂 templates/              # View templates
│   ├── index.php              # Main layout template
│   ├── components/            # Reusable components (navbar, footer)
│   ├── events/                # Event-related views
│   ├── home/                  # Home page templates
│   └── errors/                # Error pages
│
├── 📂 data/                   # Database initialization
│   ├── databaseSQL.sql        # MySQL/MariaDB schema
│   ├── databaseMongoDB.php    # MongoDB initialization
│   ├── liveticket.json        # LiveTicket event data
│   ├── disisfine.json         # DiSisFine event data
│   └── truegister.json        # TrueGister event data
│
├── 📄 .env.model              # Environment template
├── 📄 composer.json           # PHP dependencies
└── 📄 README.md               # This file
```

---

## 🚀 Installation

### Prerequisites

- **PHP** >= 8.0
- **Composer**
- **MariaDB** or **MySQL**
- **MongoDB** (optional)
- **Apache** or **Nginx** (or PHP built-in server)

### Step-by-step Setup

#### 1️⃣ Clone the repository

```bash
git clone <repository-url>
cd EventsManager
```

#### 2️⃣ Install dependencies

```bash
composer install
```

#### 3️⃣ Configure environment

Copy `.env.model` to `.env` and configure your database credentials:

```bash
cp .env.model .env
```

Edit `.env` with your database settings:
Example :
```env
DB_HOST=localhost
DB_NAME=eventsmanager
DB_USER=your_user
DB_PASS=your_password
```

#### 4️⃣ Initialize databases

**For MySQL/MariaDB:**

```bash
# Windows
mariadb -u root -p
# Enter password
source C:\absolute\path\to\data\databaseSQL.sql

# Linux/Mac
mariadb -u root -p < /absolute/path/to/data/databaseSQL.sql
```

**For MongoDB:**

```bash
cd data/
php databaseMongoDB.php
```

#### 5️⃣ Start the server

**Using PHP built-in server:**

```bash
php -S localhost:8000 -t public
```

**Using XAMPP/WAMP:**

Configure a virtual host pointing to the `public/` directory in Apache's `httpd-vhosts.conf`

#### 6️⃣ Access the application

Open your browser and navigate to:
- **PHP server**: [http://localhost:8000](http://localhost:8000)
- **Virtual host**: [http://eventsmanager.localhost](http://eventsmanager.localhost)

---

## 📦 Project Structure Details

### 🔧 `/Src` - Source Code

| Directory | Purpose |
|-----------|---------|
| `Controllers/` | Handle HTTP requests and responses |
| `Repositories/` | Database queries and data persistence |
| `Dto/` | Data Transfer Objects for clean data flow |
| `Services/` | Business logic and operations |
| `Cores/` | Core utilities (Router, Database, Renderer) |

### 🎨 `/public` - Public Assets

| Directory | Purpose |
|-----------|---------|
| `index.php` | Application entry point |
| `assets/css/` | Stylesheets (form, navbar, events, etc.) |

### 📄 `/templates` - View Templates

| Directory | Purpose |
|-----------|---------|
| `index.php` | Main layout structure |
| `components/` | Reusable UI components (navbar, footer) |
| `events/` | Event listing and forms |
| `home/` | Home page templates |
| `errors/` | Error pages (404, 500, etc.) |

### 💾 `/data` - Database Setup

| File | Purpose |
|------|---------|
| `databaseSQL.sql` | MySQL/MariaDB schema and initialization |
| `databaseMongoDB.php` | MongoDB setup script |
| `liveticket.json` | Sample LiveTicket events |
| `disisfine.json` | Sample DiSisFine events |
| `truegister.json` | Sample TrueGister events |

---

## ⚙️ Configuration

### Environment Variables

The `.env` file contains all necessary configuration. Copy `.env.model` to `.env` and adjust the following variables:

#### MySQL/MariaDB Configuration
```env
DB_HOST=localhost        # Database host
DB_PORT=3306            # Database port (default: 3306)
DB_USER=eventsmanager   # Database user
DB_PASSWORD=password    # Database password
DB_NAME=eventsmanager   # Database name
```

#### MongoDB Configuration (Optional)
```env
MONGO_HOST=localhost    # MongoDB host
MONGO_PORT=27017       # MongoDB port (default: 27017)
MONGO_DB=eventsmanager # MongoDB database name
```

### Apache Configuration

If using Apache with virtual hosts, add this to your `httpd-vhosts.conf`:

```apache
<VirtualHost *:80>
    ServerName eventsmanager.localhost
    DocumentRoot "C:/Dev/wamp64/www/project/Cours/EventsManager/public"
    
    <Directory "C:/Dev/wamp64/www/project/Cours/EventsManager/public">
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
```

Don't forget to add `eventsmanager.localhost` to your hosts file:
- **Windows**: `C:\Windows\System32\drivers\etc\hosts`
- **Linux/Mac**: `/etc/hosts`

```
127.0.0.1    eventsmanager.localhost
```

---

## 🌐 API Endpoints

### Events
- `GET /` - Home page
- `GET /events` - List all events
- `GET /events/create` - Show event creation form
- `POST /events/store` - Store new event
- `GET /events/edit/{id}` - Show event edit form
- `POST /events/update/{id}` - Update event
- `GET /events/delete/{id}` - Delete event

### Attendees
- `POST /events/{id}/register` - Register for an event
- `POST /events/{id}/unregister` - Unregister from an event

### Errors
- `404` - Page not found
- `500` - Internal server error

---

## 🛠️ Technologies

### Backend
- **PHP 8.x** - Server-side programming
- **Composer** - Dependency management
- **PSR-4** - Autoloading standard
- **vlucas/phpdotenv** - Environment variables management
- **mongodb/mongodb** - MongoDB PHP driver

### Databases
- **MariaDB/MySQL** - Relational database
- **MongoDB** - NoSQL document database

### Frontend
- **HTML5** - Markup
- **CSS3** - Styling with modern gradients and animations
- **JavaScript** - Client-side interactivity
- **Font Awesome** - Icons

### Architecture
- **MVC Pattern** - Model-View-Controller
- **Repository Pattern** - Data access abstraction
- **DTO Pattern** - Clean data transfer

---

## 🐛 Troubleshooting

### Common Issues

**Database Connection Failed**
- Verify your `.env` credentials
- Ensure MySQL/MariaDB service is running
- Check that the database exists

**Composer Autoload Not Working**
```bash
composer dump-autoload
```

**Permission Issues (Linux/Mac)**
```bash
chmod -R 755 public/
chmod -R 777 data/
```

**MongoDB Connection Failed**
- Verify MongoDB service is running
- Check MongoDB port in `.env`
- Ensure MongoDB extension is installed: `php -m | grep mongodb`

---

## 📚 Additional Resources

- [PHP Official Documentation](https://www.php.net/docs.php)
- [Composer Documentation](https://getcomposer.org/doc/)
- [PSR-4 Autoloading Standard](https://www.php-fig.org/psr/psr-4/)
- [MariaDB Documentation](https://mariadb.com/kb/en/documentation/)
- [MongoDB PHP Library](https://www.mongodb.com/docs/php-library/current/)

---

## 👥 Authors

- **Your Name** - *Initial work*

---

## 🤝 Contributing

Contributions are welcome! Please follow these steps:

1. Fork the project
2. Create your feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

Please follow the existing code style and conventions.

---

## 📄 License

This project is licensed under the MIT License - see the LICENSE file for details.

---

<div align="center">

### Made with ❤️ for event management

[![GitHub](https://img.shields.io/badge/GitHub-Repository-181717?style=for-the-badge&logo=github)](https://github.com/yourusername/EventsManager)

**[⬆ Back to top](#-eventsmanager)**

</div>