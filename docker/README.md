# Crime Database Docker Setup

## Quick Start

### Prerequisites
- Docker
- Docker Compose

### Setup Instructions

1. **Clone the repository**
   ```bash
   git clone <your-repo-url>
   cd crime-database
   ```

2. **Copy environment file**
   ```bash
   copy .env.example .env
   # or on Linux/Mac: cp .env.example .env
   ```

3. **Generate Laravel Application Key**
   ```bash
   docker-compose run --rm app php artisan key:generate
   ```

4. **Build and start containers**
   ```bash
   docker-compose up -d
   ```

5. **Run database migrations**
   ```bash
   docker-compose exec app php artisan migrate
   ```

6. **Access the application**
   - Open http://localhost in your browser

## Available Commands

### Build the Docker image
```bash
docker-compose build
```

### Start services
```bash
docker-compose up -d
```

### Stop services
```bash
docker-compose down
```

### View logs
```bash
docker-compose logs -f app
```

### Run Artisan commands
```bash
docker-compose exec app php artisan <command>
```

### Run migrations
```bash
docker-compose exec app php artisan migrate
```

### Create a new user
```bash
docker-compose exec app php artisan tinker
>>> App\Models\User::create(['name' => 'Admin', 'email' => 'admin@example.com', 'password' => bcrypt('password')])
```

### Access the application shell
```bash
docker-compose exec app sh
```

### Install npm dependencies
```bash
docker-compose run --rm app npm install
```

### Build frontend assets
```bash
docker-compose run --rm app npm run build
```

## Services

- **app**: PHP 8.2-FPM application container
- **nginx**: Nginx web server
- **queue**: Laravel Queue worker (optional, for background jobs)

## Database

By default, SQLite is configured for development. To use MySQL or PostgreSQL:

1. Update `docker-compose.yml` to add MySQL/PostgreSQL service
2. Update `.env` file with database configuration
3. Restart containers: `docker-compose restart`

### Using MySQL

Add this to `docker-compose.yml`:
```yaml
mysql:
  image: mysql:8.0
  container_name: crime-database-mysql
  environment:
    MYSQL_ROOT_PASSWORD: root
    MYSQL_DATABASE: crime_database
  volumes:
    - mysql_data:/var/lib/mysql
  networks:
    - crime-network

volumes:
  mysql_data:
```

### Using PostgreSQL

Add this to `docker-compose.yml`:
```yaml
postgres:
  image: postgres:15-alpine
  container_name: crime-database-postgres
  environment:
    POSTGRES_PASSWORD: postgres
    POSTGRES_DB: crime_database
  volumes:
    - postgres_data:/var/lib/postgresql/data
  networks:
    - crime-network

volumes:
  postgres_data:
```

## Troubleshooting

### Permissions issues
```bash
docker-compose exec app chown -R www-data:www-data /var/www/html
docker-compose exec app chmod -R 755 storage bootstrap/cache
```

### Clear cache
```bash
docker-compose exec app php artisan cache:clear
docker-compose exec app php artisan config:cache
docker-compose exec app php artisan view:cache
```

### Rebuild containers
```bash
docker-compose down
docker-compose up --build -d
```

## Production Considerations

1. Set `APP_DEBUG=false` in `.env`
2. Ensure proper SSL certificates in `docker/certs/`
3. Use strong database passwords
4. Implement proper backup strategy for SQLite database
5. Configure proper logging
6. Use environment-specific configurations
7. Set up monitoring and health checks

## Additional Resources

- [Laravel Documentation](https://laravel.com/docs)
- [Docker Documentation](https://docs.docker.com/)
- [Docker Compose Documentation](https://docs.docker.com/compose/)
