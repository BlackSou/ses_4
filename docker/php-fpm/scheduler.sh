#!/bin/sh

crontab -l | { cat; echo "* * * * * cd /var/www && php artisan schedule:run >> /dev/null 2>&1"; } | crontab -

crond -f -l 8