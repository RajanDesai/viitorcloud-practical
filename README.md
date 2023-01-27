## Follow below steps to setup and run the project:


- Create MySQL `database`
- Create `.env` file and set database credentials
- Run `composer install` OR `composer update` command inside project root directory
- Run `php artisan key:generate` command inside project root directory
- Run `php artisan migrate` command inside project root directory
- Create a virtual host pointing `127.0.0.1` to `laravel-test.demo`. This may be different procedure based on the operating system you are using. Once you have created virtual host, the website must run with the URL: `http://laravel-test.demo`
- Run `php artisan db:seed` command inside project root directory
