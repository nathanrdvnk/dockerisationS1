#!/bin/sh

echo "⚠️  Reset complet de l'environnement DEV"

docker compose -f docker-compose.dev.yml down -v
docker compose -f docker-compose.dev.yml up -d
docker compose -f docker-compose.dev.yml ps
