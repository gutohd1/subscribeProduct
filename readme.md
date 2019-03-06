in order to load the service
run migrations through the command: 

php artisan migrate

and then to seed the product (service) table *forget the name when i was creating then realized later based on requirements  
php artisan db:seed --class=ServicesTableSeeder

this command should create some mock products to relate with to subscribe or unsubscribe


/subscription method POST to subscribe phone with product
/subscription method DELETE to unsubscribe phone with product



as a laravel framework you should create a vhost like the following pointing to the folder PUBLIC in your laravel project 

<VirtualHost *:80>
    ServerAdmin webmaster@dummy-host2.example.com
    DocumentRoot "C:/xampp/htdocs/pmconnect/public"
    ServerName api.pmconnect.com
    ErrorLog "logs/books.log"
    CustomLog "logs/books.log" common
</VirtualHost>

and finally in your hosts file create one entry for the url you have created. like the following:

127.0.0.1       api.pmconnect.com
