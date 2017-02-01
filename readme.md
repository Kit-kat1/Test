#How to setup and run

1. Clone project
2. In project root `composer install`
3. if under windows: `vendor\\bin\\homestead make`, under linux `vendor/bin/homestead make`
4. Copy .env.example into .env
5. `vagrant up`
6. Under vagrant get into project root and enter following `php artisan migrate && php artisan db:seed`
7. `npm install`
8. `gulp`
9. Access via route http://192.168.10.10