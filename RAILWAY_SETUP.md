# Railway Deployment Setup

## Project Versions
- **PHP**: ^8.2
- **Laravel**: ^12.0
- **MySQL**: 8.0
- **Node.js**: Latest (for Vite build)
- **NPM**: Latest

## Environment Variables Setup

### For Railway Dashboard

Add these environment variables in your Railway project settings:

#### Application Variables
```
APP_NAME=Laravel
APP_ENV=production
APP_KEY=base64:YOUR_GENERATED_KEY_HERE
APP_DEBUG=false
APP_URL=https://your-app-url.railway.app
```

#### Database Variables (Railway MySQL Plugin)
```
DB_CONNECTION=mysql
DB_HOST=${RAILWAY_PRIVATE_MYSQL_HOST}
DB_PORT=${RAILWAY_PRIVATE_MYSQL_PORT}
DB_DATABASE=${RAILWAY_PRIVATE_MYSQL_DATABASE}
DB_USERNAME=${RAILWAY_PRIVATE_MYSQL_USER}
DB_PASSWORD=${RAILWAY_PRIVATE_MYSQL_PASSWORD}
```

#### Other Important Variables
```
CACHE_STORE=redis
QUEUE_CONNECTION=redis
SESSION_DRIVER=database
LOG_CHANNEL=stack
```

### Generate APP_KEY
Run this command locally to generate your APP_KEY:
```bash
php artisan key:generate --show
```

## Railway Deployment Steps

### 1. Push to GitHub
```bash
git add .
git commit -m "Setup Railway deployment with MySQL"
git push origin main
```

### 2. Create Railway Project
1. Go to [railway.app](https://railway.app)
2. Click "New Project" > "Deploy from GitHub repo"
3. Select your `muhammadawali648-hue/lab-sample` repository
4. Railway akan menggunakan nixpacks.toml untuk build otomatis

### 3. Add MySQL Database
1. In your Railway project, click "New Service"
2. Select "Database" > "MySQL"
3. Railway will create MySQL service and provide connection variables

### 4. Configure Environment Variables
1. Go to your Laravel service settings
2. Click "Variables" tab
3. Add all environment variables listed above
4. Railway will automatically substitute `${RAILWAY_PRIVATE_*}` variables

### 5. Deploy
1. Railway will automatically deploy when you push changes
2. Monitor deployment logs for any issues
3. Your app will be available at the provided Railway URL

## Local Development Setup

### 1. Clone and Install
```bash
git clone https://github.com/muhammadawali648-hue/lab-sample.git
cd lab-sample
composer install
npm install
```

### 2. Environment Setup
```bash
cp .env.example .env
php artisan key:generate
```

### 3. Database Setup (Local SQLite)
```bash
touch database/database.sqlite
php artisan migrate
php artisan db:seed
```

### 4. Run Development Server
```bash
npm run dev
php artisan serve
```

## Features Used
- **Laravel 12.0** - Latest Laravel framework
- **MySQL 8.0** - Production database
- **Vite** - Asset bundling
- **TailwindCSS** - CSS framework
- **Laravel Breeze** - Authentication scaffolding
- **DomPDF** - PDF generation
- **Laravel Excel** - Excel import/export

## Troubleshooting

### Common Issues
1. **Database Connection Failed**: Check MySQL service is running and variables are correct
2. **APP_KEY Missing**: Generate a new key using `php artisan key:generate --show`
3. **Asset Loading Issues**: Run `npm run build` before deployment
4. **Permission Issues**: Ensure storage directory is writable

### Railway Logs
- View deployment logs in Railway dashboard
- Check runtime logs for application errors
- Monitor MySQL service logs for database issues

## Production Optimizations
- Redis for caching and queues
- Database migrations run automatically
- Asset optimization with Vite
- Health checks configured
- Automatic restart on failure
