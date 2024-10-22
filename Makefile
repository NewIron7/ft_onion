all: 
	mkdir ssh && cp ~/.ssh/id_rsa.pub ssh/authorized_keys
	docker compose up --build -d

logs:
	docker logs ft_onion

stop:
	docker compose stop

clean: stop
	docker compose down

fclean: clean
	rm -rf ssh
	docker compose rm

re: fclean all

test:
	docker exec -it ft_onion /bin/bash

.Phony: all logs clean fclean re test