.PHONY: up down logs reset

help:
	@echo "Commandes disponibles :"
	@echo "  make up      -> Lancer l'environnement DEV"
	@echo "  make down    -> Arrêter l'environnement DEV"
	@echo "  make logs    -> Voir les logs DEV"
	@echo "  make reset   -> Reset complet (containers + volumes)"
up:
	docker compose -f docker-compose.dev.yml up -d
down:
	docker compose -f docker-compose.dev.yml down
logs:
	docker compose -f docker-compose.dev.yml logs -f
reset:
	./reset.sh
