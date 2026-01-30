# Projet PHP Dockerisé S1
## Authors
- Nathan Radivoniuk
- Ismael Zaidi
- Ismail Ibrahimi

## Prérequis
- Docker (v20+)
- Docker Compose(v2+)
- Make (optionnel)

## Variables
Copier `.env.example` en `.env` et modifier pour votre propre besoin.

## Commandes Rapides
- `make up` : Lance le projet en dev
- `make down` : Arrête les containers
- `make logs` : Voir les logs
- `make reset` : Reset complet (DB Mysql + containers)

## Commandes Brutes
- `docker compose -f docker-compose.dev.yml up -d --build` : #dev
- `docker compose -f docker-compose.prod.yml up -d --build` : #prod
- `docker compose down` : Arrête les containers
- `docker compose logs -f` : Voir les logs
- `./reset.sh` : Reset complet (DB Mysql + containers)

## Structure
- `app/` : Code PHP
- `./` : Dockerfile
- `docker/apache/` : Config Apache
