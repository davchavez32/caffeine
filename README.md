- Make a database on your local machine named caffeine_app
- Run composer install
- Run php artisan migrate
- Run php artisan db:seed
- Run php artisan serve

Web
- Run this in browser http://127.0.0.1:8000/getBeverages
- Select Beverage and clik Check button to check other beverages that can be consumed

API
- Import attached Postman file
- Run http://127.0.01:8000/api/register
- Run http://127.0.01:8000/api/login
- Run http://127.0.01:8000/api/checkAllowedBeveragesConsumption (Note: Remember to update the bearer token fetched in the login api call)