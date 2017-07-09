# Petition app

Forked from 
https://github.com/cretueusebiu/laravel-vue-spa

> A very small experimental Laravel-Vue petition app with limited functionality,
basically a user is only able to add their name to already created petitions.

## Installation

- `git clone https://github.com/patrick-larsson/VG-petitions.git`
- `cd VG-petitions`
- `cp .env.example .env`
- `composer install`
- `php artisan key:generate`
- `php artisan jwt:secret`
- Edit `.env` and set your database connection details
- `php artisan migrate`
- `npm install` / `yarn`

## Usage
#### Login
``` 
Username: admin
Password: admin
```

#### Development

```bash
# build and watch
npm run watch

# serve with hot reloading
npm run hot
```

#### Production

```bash
npm run production
```
