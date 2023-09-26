#!/bin/bash
set -e

# Add a line to pg_hba.conf for "host all all all md5"
echo "host all all all md5" >> /var/lib/postgresql/data/pg_hba.conf

# Call the original entrypoint script
/usr/local/bin/docker-entrypoint.sh "$@"