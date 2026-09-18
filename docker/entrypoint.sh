#!/bin/sh
set -e

# Railway (and most PaaS hosts) assign the listen port via $PORT at runtime.
# Apache's default config hardcodes port 80, so rewrite it on container start.
PORT="${PORT:-80}"
sed -i "s/Listen 80/Listen ${PORT}/" /etc/apache2/ports.conf
sed -i "s/:80>/:${PORT}>/" /etc/apache2/sites-enabled/000-default.conf

exec "$@"
