.PHONY: build bash start

start: build bash

build:
	docker build -t imdhemy/php8.4 .

bash:
	docker run --rm -it --name imdhemy-php8.4 -v $(PWD):/var/www imdhemy/php8.4 bash

%:
	@:
