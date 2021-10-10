Pre-requisites: 
- PHP ^8.1
- Laravel 8.x
- MySQL 8.x
- A pre-configured DynamoDB bucket set to public

Opens up two endpoints: a basic upload image POST configured for Amazon S3 and a GET for image metadata the stack application would use. Once the pre-requisites have been installed and your DynamoDB and SQL credentials have been set, you may deploy this project locally using `php artisan serve`

To run: 
1. Clone this repository and https://github.com/meio-velarde/stack-image-app
2. Configure a DynamoDB bucket under `config/filestorages.php`
3. Configure a MySQL database under `config/databases.php`
4. Deploy the API locally via `php artisan serve`
5. Deploy the frontend app using `ng serve`
