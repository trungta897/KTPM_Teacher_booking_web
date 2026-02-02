# Docker Setup Guide - Web Booking

Hướng dẫn cài đặt và chạy dự án Web Booking với Docker.

## 📋 Yêu cầu hệ thống

- Docker >= 20.10
- Docker Compose >= 2.0
- Git

## 🚀 Cài đặt nhanh

### 1. Clone dự án và cấu hình environment

```bash
# Clone dự án (nếu chưa có)
git clone <repository-url>
cd web_booking

# Copy file environment
cp docker/env.docker.example .env
```

### 2. Khởi động containers

```bash
# Build và khởi động (lần đầu)
docker-compose up -d --build

# Hoặc dùng Makefile
make build
make up
```

### 3. Cấu hình Laravel

```bash
# Truy cập vào container
docker-compose exec app sh

# Bên trong container, chạy các lệnh sau:
php artisan key:generate
php artisan migrate
php artisan db:seed
php artisan storage:link

# Hoặc dùng Makefile (từ host)
make setup
```

### 4. Truy cập ứng dụng

- **Application**: http://localhost:8080
- **phpMyAdmin** (dev): http://localhost:8081
- **Mailpit** (dev): http://localhost:8025

## 📦 Services

| Service | Container Name | Port | Description |
|---------|---------------|------|-------------|
| App | web_booking_app | 8080 | Laravel + Nginx + PHP-FPM |
| MySQL | web_booking_mysql | 3306 | MySQL 8.0 Database |
| Redis | web_booking_redis | 6379 | Cache & Queue |
| phpMyAdmin | web_booking_phpmyadmin | 8081 | Database Management (dev) |
| Mailpit | web_booking_mailpit | 8025/1025 | Email Testing (dev) |

## 🛠 Các lệnh thường dùng

### Docker Commands

```bash
# Khởi động containers
docker-compose up -d

# Dừng containers
docker-compose down

# Xem logs
docker-compose logs -f

# Xem logs của service cụ thể
docker-compose logs -f app

# Truy cập shell của container
docker-compose exec app sh

# Rebuild images
docker-compose build --no-cache
```

### Laravel Commands (trong container)

```bash
# Truy cập container
docker-compose exec app sh

# Chạy migrations
php artisan migrate

# Chạy seeders
php artisan db:seed

# Clear cache
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Optimize cho production
php artisan optimize
```

### Makefile Commands

```bash
make help         # Hiển thị tất cả commands
make setup        # Cài đặt ban đầu
make up           # Khởi động containers
make down         # Dừng containers
make restart      # Restart containers
make logs         # Xem logs
make shell        # Truy cập shell
make migrate      # Chạy migrations
make fresh        # Fresh migrate + seed
make cache-clear  # Clear tất cả cache
make test         # Chạy tests
make dev          # Chạy với dev tools
```

## 🔧 Development Mode

Chế độ development bao gồm phpMyAdmin và Mailpit:

```bash
# Chạy với dev profile
docker-compose --profile dev up -d

# Hoặc
make dev
```

### Cấu hình Xdebug (VSCode)

Thêm vào `.vscode/launch.json`:

```json
{
    "version": "0.2.0",
    "configurations": [
        {
            "name": "Listen for Xdebug",
            "type": "php",
            "request": "launch",
            "port": 9003,
            "pathMappings": {
                "/var/www/html": "${workspaceFolder}"
            }
        }
    ]
}
```

## 🗄 Database

### Truy cập MySQL

```bash
# Từ host
docker-compose exec mysql mysql -u web_booking -psecret web_booking

# Hoặc dùng phpMyAdmin
http://localhost:8081
```

### Backup Database

```bash
# Export
docker-compose exec mysql mysqldump -u web_booking -psecret web_booking > backup.sql

# Import
docker-compose exec -T mysql mysql -u web_booking -psecret web_booking < backup.sql
```

## 📧 Email Testing

Trong development, emails được gửi đến Mailpit:

- **Web UI**: http://localhost:8025
- **SMTP**: localhost:1025

Cấu hình trong `.env`:

```env
MAIL_MAILER=smtp
MAIL_HOST=mailpit
MAIL_PORT=1025
```

## 🔐 Environment Variables

| Variable | Default | Description |
|----------|---------|-------------|
| APP_PORT | 8080 | Port cho ứng dụng |
| DB_DATABASE | web_booking | Tên database |
| DB_USERNAME | web_booking | MySQL username |
| DB_PASSWORD | secret | MySQL password |
| DB_ROOT_PASSWORD | rootpassword | MySQL root password |
| REDIS_PORT | 6379 | Redis port |
| PHPMYADMIN_PORT | 8081 | phpMyAdmin port |

## 🏭 Production Deployment

### Build Production Image

```bash
docker-compose build --no-cache
```

### Deploy

```bash
# Pull latest images
docker-compose pull

# Deploy với zero-downtime
docker-compose up -d --build

# Optimize Laravel
docker-compose exec app php artisan optimize
docker-compose exec app php artisan config:cache
docker-compose exec app php artisan route:cache
docker-compose exec app php artisan view:cache
```

### Health Check

Kiểm tra trạng thái ứng dụng:

```bash
curl http://localhost:8080/health
```

## ❗ Troubleshooting

### Permission Issues

```bash
docker-compose exec app chown -R www-data:www-data /var/www/html/storage
docker-compose exec app chmod -R 775 /var/www/html/storage
```

### MySQL Connection Refused

Đợi MySQL khởi động hoàn toàn (~30s):

```bash
docker-compose logs mysql
```

### Clear Everything

```bash
docker-compose down -v --remove-orphans
docker system prune -f
```

### Rebuild from Scratch

```bash
make clean
make setup
```

## 📁 Cấu trúc thư mục Docker

```
docker/
├── mysql/
│   └── init.sql           # MySQL initialization
├── nginx/
│   ├── default.conf       # Nginx server config
│   └── nginx.conf         # Nginx main config
├── php/
│   ├── php.ini            # PHP production config
│   ├── php.dev.ini        # PHP development config
│   └── www.conf           # PHP-FPM pool config
├── supervisor/
│   └── supervisord.conf   # Process manager config
├── env.docker.example     # Example environment file
└── README.md              # This file
```

