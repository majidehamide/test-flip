## Test On heroku
[Link test on heroku](https://majid-test-flip.herokuapp.com/)

## Test On Local
- open cmd and go to this repo
- Run composer install on your cmd or terminal
- Copy .env.example file to .env on the root folder. You can type copy .env.example .env if using command prompt Windows or cp .env.example .env if using terminal, Ubuntu
- Open your .env file and change the database name (DB_DATABASE) to whatever you have, username (DB_USERNAME) and password (DB_PASSWORD) field correspond to your configuration. 
- Add SLIGHTY_BIG_FLIP_URL=https://nextar.flip.id && SLIGHTY_BIG_FLIP_TOKEN=HyzioY7LP6ZoO7nTYKbG8O4ISkyWnX1JvAEVAhtWKZumooCzqp41 to your configuration.
- By default, the username is root and you can leave the password field empty. (This is for Xampp)
- By default, the username is root and password is also root. (This is for Lamp)
- Run php artisan key:generate
- Run php artisan migrate
- Run php artisan serve
- Go to localhost:8000

## Set Permission if Get 500 (ubuntu and mac)
- sudo chmod -R 755 this_repo
- chmod -R o+w this_repo/storage
[source](https://stackoverflow.com/a/39913449)

## PHP Unit Test
- run php artisan test




