docker compose down
docker volume rm dockerisations1_mysql-data || true
docker compose -f docker-compose.dev.yml up -d
docker compose ps
