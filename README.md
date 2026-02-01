# Projet PHP Dockerisé S1

Mini projet de dockerisation d’une application PHP / MySQL dans le cadre du cours  
**De la virtualisation à la conteneurisation**.

## Authors
- [@Nathan Radivoniuk](https://www.github.com/nathanrdvnk)
- [@Ismail Ibrahimi](https://www.github.com/IsmailIbrahimi)
- Ismael Zaidi

## Prérequis
- Docker (v20+)
- Docker Compose (v2+)
- Make (optionnel)

## Stack
- PHP 8.2 (Apache)
- MySQL 8.0
- Docker / Docker Compose

## Variables d'environnement
Copier le fichier `.env.example` en `.env` et adapter les valeurs si nécessaire.

```bash
cp .env.example .env
```

## Commandes Rapides
- `make up` : lance le projet en **dev**
- `make down` : arrête les containers
- `make logs` : affiche les logs
- `make reset` : reset complet (conteneurs + base MySQL)

## Commandes Docker Brutes
- `docker compose -f docker-compose.dev.yml up -d --build` : lancement dev
- `docker compose -f docker-compose.prod.yml up -d --build` : lancement prod
- `docker compose down` : arrêt des conteneurs
- `docker compose logs -f` : logs
- `./reset.sh` : reset complet

## Accès à l’application
L’application est accessible sur :
```
http://localhost:<PHP_PORT>
```
Par défaut :
```
http://localhost:8080
```

## Base de données
- MySQL est initialisé automatiquement au premier démarrage
- La base et la table sont créées via `init.sql`
- Les données sont persistées grâce à un volume Docker

En cas de problème :
```bash
make reset
```

## Structure du projet
```
.
│ mini-task/              # Code PHP
│ ├── index.php
│ ├── db.php
│ └── init.sql
│ docker-compose.yml
│ docker-compose.dev.yml
│ docker-compose.prod.yml
│ Dockerfile
│ docker/apache/
│ └── vhost.conf
│ .env.example
│ .dockerignore
│ Makefile
│ reset.sh
│ README.md
```

## Notes
- Lancement du projet en **une seule commande**
- Séparation dev / prod via Docker Compose
- Projet reproductible sur n’importe quelle machine avec Docker