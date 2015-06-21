# Laravel TODO MVC

An over engineered laravel app pretends to be a Todo app.

#### Things Considered

- [x] Repository Pattern (Domain Driven Design)
- [x] Model Validation as a Service
- [x] RESTful API
- [x] JSON-API Spec (http://jsonapi.org/)
- [x] Single Page App (except for registration)
- [x] User registrations
- [ ] Event driven backend (laravel event emitters/listeners)
- [ ] Authenticated API via `access_tokens`
- [ ] Front end refactor
- [ ] SPECS! NO TESTS
- [ ] Refactor annotations and types.

### Setting up
1. Clone the repository
1. `vagrant up`
1. `vagrant ssh`
1. `cd /var/www/`
1. `touch storage/database.sqlite`
1. `php artisan migrate`
1. `php artisan db:seed`

#### Development
1. Steps from Setting Up
1. `npm install -g gulp`
1. `npm install`
1. `gulp watch` (wait for the process to complete, may take few seconds)

