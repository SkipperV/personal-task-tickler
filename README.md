# Personal Task Tickler
## ! Currently, application is in developing stage. Only few API requests are available !

## Getting Started

### Dependencies

* Windows/macOS/Linux with preinstalled Docker Engine and Node.js with npm.

### Installing

* Copy .env.example to .env


* Run docker-compose
```
docker-compose up --build -d
```

* install Node packages and modules
```
npm install
```
* Resolve and install Composer dependencies in docker container
```
docker exec personal-task-tickler-app composer install
```
* Run migrations and seed database with test data
```
docker exec personal-task-tickler-app php artisan migrate --seed
```

[//]: # (* Run npm build to build frontend components)
[//]: # (```)
[//]: # (npm run build)
[//]: # (```)

While Docker containers are running, application is available by link: [localhost](http://localhost/)

Test Admin User: admin

Default Password for test users: password

[//]: # (## Link to access running application)
[//]: # ()
[//]: # ([localhost]&#40;http://localhost:8080/&#41;)

## Author

* [SkipperV](https://github.com/SkipperV) (Vladyslav Tymchuk)
