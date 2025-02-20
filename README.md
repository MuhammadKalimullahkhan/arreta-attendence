## Arreta Attendance

the project is developed in laravel, to solve the Attendance system of Arreta.

## How to Run
- Install `Herd` or `composer` and setup laravel then install `nodejs`.
- Rename `.env.example` to `.env` file.
- Setup Database configuration in `.env` file.

```bash
git clone https://github.com/MuhammadKalimullahkhan/arreta-attendence.git
cd arreta-attenence
npm install && npm build
composer install

# generate key
php artisan key:generate

# run the server
php artisan serve
```

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
