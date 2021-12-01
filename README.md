## eCommerce API

- Laravel 8
    - Sail
    - Sanctum

- Installing
    1) It requires docker, run the following multiple lines command:
        docker run --rm \
            -v $(pwd):/opt \
            -w /opt \
            laravelsail/php80-composer:latest \
            bash -c "composer require laravel/sail --dev"
    2) In the project root folder
        cp .env.example .env
    3) Execute
        1) vendor/bin/sail up -d
            *This process takes some time.
            *You may need to stop some services to avoid conflict with ports
                For instance:
                    /etc/init.d/apache2 stop
            *(FAIL1) In case of failure
                - Maybe  you need to use sudo
                - Trying running docker-compose up -d first and then vendor/bin/sail up -d
                    - if this tip worked, then do these last steps:
                        - vendor/bin/sail down
                        - docker-compose down
                        - docker-compose up -d
                        - vendor/bin/sail up -d
        2) vendor/bin/sail artisan db:create
            *Maybe you need wait some seconds in order to step a) above finish.
            *Maybe need grants permission in folders
                sudo chmod 777 -R storage/logs
            *See (*FAIL1)
        3) vendor/bin/sail artisan migrate
        4) vendor/bin/sail artisan db:seed
        5) vendor/bin/sail artisan config:cache
            *Maybe need grants permission in folders
                sudo chmod 777 -R bootstrap/cache
                sudo chmod 777 -R storage/framework
    4) Go to browser (http://localhost) 
        Should see the message in the body
            eCommerce API
    5) Perform automated testing (PHPUnit) - Integration Test
            vendor/bin/sail test
    6) To stop all services
        vendor/bin/sail down
