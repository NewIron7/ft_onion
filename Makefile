all: 
	docker compose up --build -d


logs:
	docker logs ft_onion

stop:
	docker compose stop

clean: stop
	docker compose down

fclean: clean
	docker system prune -af

re: fclean all

test:
	docker exec -it ft_onion /bin/bash

.Phony: all logs clean fclean