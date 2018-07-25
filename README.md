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

9. Created middleware and updated login file to redirect to admin panel
    php artisan make:middleware Admin
    update its function
    update home controller
    use  if(auth()->user()->isAdmin == 1) to check if user is admin

10. Creating New User :
    - php artisan make:controller UserController --resource
    - add route Route::resource('users','UserController');
    - create all CRUD on User using link https://appdividend.com/2018/02/23/laravel-5-6-crud-tutorial/

11. Setup forgot password
    change in .evn file, clear cache with "php artisan config:cache" and restart server 

    MAIL_DRIVER=smtp
    MAIL_HOST=smtp.googlemail.com
    MAIL_PORT=587
    MAIL_USERNAME=mittalvarsha356@gmail.com
    MAIL_PASSWORD="skrl qgfo nfux xlgp" //this is app password
    MAIL_ENCRYPTION=tls

12. Added graph :
    - Used Lavacharts http://lavacharts.com/#install
    - Keep the usage via $lava only and pass the variables to view as required

13. Created Settings update pages and redirections updated for form submition and form opening 

14. Always create the asset scripts and css in public folder.

15. Made functions common by passing parameter in URL.

Note:
1. To store git credentials: git config credential.helper store
2. Added meld as difftool and mergetool on git , Download meld and run following commands
    -  git config --global diff.tool meld
    -  git config --global merge.tool meld
    -  git config --global mergetool.meld.path "C:\Program Files (x86)\Meld\Meld.exe"
3. Create migration :   php artisan make:migration create_users_table
    - run migration :   php artisan migrate
4. Create Seeder file : php artisan make:seeder SettingsTableSeeder
    - run seeder :  composer dump-autoload
                    php artisan db:seed
                    php artisan db:seed --class=SettingsTableSeeder