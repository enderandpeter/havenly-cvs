# havenly-cvs
My Laravel solution to the Havenly CVS upload code test

To setup, simply do the following:
1. Clone the repo to an empty folder
2. Make sure [composer](https://getcomposer.org/download/) is installed and run the command `composer install`
3. Copy `.env.example` to `.env` make make any necessary changes for your environment
4. Make sure a database exists and is accessible with the credentials set in `.env`
5. Run `php artisan key:generate` to create a unique `APP_KEY`. Although you won't be using it, Laravel will insist that it is set.
6. Run the database migration with the command `php artisan migrate`
7. Make sure there is a web server configuration that allows all overrides in the project folder and sets the `public` folder as the DocumentRoot.
8. Visit the site's homepage and use the form to upload a CSV file as specified
