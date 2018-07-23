"# carPoolingApp" 

Pre-requisite : Composer, Xampp

1. load laravel in parent directory 
composer global require "laravel/installer"

2. Clone this project in the directory created

3. Run Composer install

4. Run the project by writing command in CMD :
php artisan serve

5. AdminLite Theme added 
https://hdtuto.com/article/laravel-56-adminlte-bootstrap-theme-installation-example
Documentation on : https://github.com/JeroenNoten/Laravel-AdminLTE

6. Redirections for admin login and logout added 

7. Migration for user added :
    php artisan make:migration create_users_table
    php artisan migrate

8. Seeding for User added :
    php artisan make:seeder UsersTableSeeder
    regenrate composer's autoload : composer dump-autoload
    run seed : php artisan db:seed --class=UsersTableSeeder ( for specific seed )


Note:
1. To store git credentials: git config credential.helper store