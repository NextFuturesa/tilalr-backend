#!/bin/sh
set -e

echo "🚀 Starting Tilalr Backend..."

# Create necessary directories
mkdir -p /var/log/supervisor
mkdir -p /var/log/php
mkdir -p /var/log/nginx
mkdir -p /var/www/html/storage/app/public/trips
mkdir -p /var/www/html/storage/app/public/islands
mkdir -p /var/www/html/storage/app/public/offers
mkdir -p /var/www/html/storage/app/public/sliders
mkdir -p /var/www/html/storage/framework/cache
mkdir -p /var/www/html/storage/framework/sessions
mkdir -p /var/www/html/storage/framework/views
mkdir -p /var/www/html/bootstrap/cache

# Create storage symlink manually (more reliable than artisan command)
echo "🔗 Creating storage link..."
rm -rf /var/www/html/public/storage 2>/dev/null || true
ln -sf /var/www/html/storage/app/public /var/www/html/public/storage

# Download sample images if they don't exist
if [ ! -f "/var/www/html/storage/app/public/trips/maldives.jpg" ]; then
    echo "📥 Downloading sample images..."
    
    # Install wget if not available
    if ! command -v wget > /dev/null 2>&1; then
        apk add --no-cache wget > /dev/null 2>&1 || true
    fi
    
    # Trips images
    wget -q -O /var/www/html/storage/app/public/trips/maldives.jpg "https://images.unsplash.com/photo-1514282401047-d79a71a590e8?w=800&q=80" 2>/dev/null || echo "⚠️ Could not download maldives.jpg"
    wget -q -O /var/www/html/storage/app/public/trips/bali.jpg "https://images.unsplash.com/photo-1537996194471-e657df975ab4?w=800&q=80" 2>/dev/null || echo "⚠️ Could not download bali.jpg"
    wget -q -O /var/www/html/storage/app/public/trips/seychelles.jpg "https://images.unsplash.com/photo-1589979481223-deb893043163?w=800&q=80" 2>/dev/null || echo "⚠️ Could not download seychelles.jpg"
    wget -q -O /var/www/html/storage/app/public/trips/swiss.jpg "https://images.unsplash.com/photo-1531366936337-7c912a4589a7?w=800&q=80" 2>/dev/null || echo "⚠️ Could not download swiss.jpg"
    wget -q -O /var/www/html/storage/app/public/trips/japan.jpg "https://images.unsplash.com/photo-1493976040374-85c8e12f0c0e?w=800&q=80" 2>/dev/null || echo "⚠️ Could not download japan.jpg"
    wget -q -O /var/www/html/storage/app/public/trips/dubai.jpg "https://images.unsplash.com/photo-1512453979798-5ea266f8880c?w=800&q=80" 2>/dev/null || echo "⚠️ Could not download dubai.jpg"
    
    # Islands images
    wget -q -O /var/www/html/storage/app/public/islands/island1.jpg "https://images.unsplash.com/photo-1559128010-7c1ad6e1b6a5?w=800&q=80" 2>/dev/null || echo "⚠️ Could not download island1.jpg"
    wget -q -O /var/www/html/storage/app/public/islands/island2.jpg "https://images.unsplash.com/photo-1506929562872-bb421503ef21?w=800&q=80" 2>/dev/null || echo "⚠️ Could not download island2.jpg"
    wget -q -O /var/www/html/storage/app/public/islands/island3.jpg "https://images.unsplash.com/photo-1468413253725-0d5181091126?w=800&q=80" 2>/dev/null || echo "⚠️ Could not download island3.jpg"
    
    # Sliders images
    wget -q -O /var/www/html/storage/app/public/sliders/slider1.jpg "https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=1200&q=80" 2>/dev/null || echo "⚠️ Could not download slider1.jpg"
    wget -q -O /var/www/html/storage/app/public/sliders/slider2.jpg "https://images.unsplash.com/photo-1476514525535-07fb3b4ae5f1?w=1200&q=80" 2>/dev/null || echo "⚠️ Could not download slider2.jpg"
    wget -q -O /var/www/html/storage/app/public/sliders/slider3.jpg "https://images.unsplash.com/photo-1530789253388-582c481c54b0?w=1200&q=80" 2>/dev/null || echo "⚠️ Could not download slider3.jpg"
    
    echo "✅ Sample images downloaded!"
fi

# Wait for database to be ready
echo "⏳ Waiting for database connection..."
max_tries=30
counter=0
while ! php artisan db:monitor --databases=mysql 2>/dev/null; do
    counter=$((counter + 1))
    if [ $counter -gt $max_tries ]; then
        echo "❌ Database connection failed after $max_tries attempts"
        break
    fi
    echo "Waiting for database... attempt $counter/$max_tries"
    sleep 2
done

# Run migrations if AUTO_MIGRATE is set
if [ "${AUTO_MIGRATE:-false}" = "true" ]; then
    echo "📦 Running database migrations..."
    php artisan migrate --force
    
    echo "🌱 Running seeders..."
    php artisan db:seed --force 2>/dev/null || echo "⚠️ Seeders already run or failed"
fi

# Clear and cache configurations for production
echo "🔧 Optimizing application..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Set correct permissions
echo "🔐 Setting permissions..."
chown -R www-data:www-data /var/www/html/storage
chown -R www-data:www-data /var/www/html/bootstrap/cache
chmod -R 775 /var/www/html/storage
chmod -R 775 /var/www/html/bootstrap/cache

echo "✅ Application ready!"
echo "🌐 Starting services..."

# Start supervisor (manages nginx, php-fpm, queue workers)
exec /usr/bin/supervisord -c /etc/supervisord.conf
