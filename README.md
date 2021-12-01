## eCommerce API

- Laravel 8
    - Sail
    - Sanctum

- Installing
    - 1) It requires docker, run the following multiple lines command:
        docker run --rm \
            -v $(pwd):/opt \
            -w /opt \
            laravelsail/php80-composer:latest \
            bash -c "composer require laravel/sail --dev"
    - 2) In the project root folder
        cp .env.example .env
    - 3) Execute
        a) vendor/bin/sail up -d
            *This process takes some time.
            *You may need to stop some services to avoid conflict with ports
                For instance:
                    /etc/init.d/apache2 stop
            *In case of failure
                - Maybe  you need to use sudo
                - Trying running docker-compose up -d first and then vendor/bin/sail up -d
                    - if this tip worked, then do these last steps:
                        - vendor/bin/sail down
                        - docker-compose down
                        - vendor/bin/sail up -d
        b) vendor/bin/sail artisan db:create
            *Maybe you need wait some seconds in order to step a) above finish.
        c) vendor/bin/sail artisan migrate
        d) vendor/bin/sail artisan db:seed
        e) vendor/bin/sail artisan config:cache
    - 4) Go to browser (http://localhost) 
        Should see the message in the body
            eCommerce API
    - 5) Perform automated testing (PHPUnit) - Integration Test
            vendor/bin/sail test
    - 6) To stop all services
        vendor/bin/sail down
