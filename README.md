Pre-requisites: 
- PHP ^8.1
- Laravel 8.x
- MySQL 8.x
- A pre-configured DynamoDB bucket

Opens up two endpoints: a basic upload image POST configured for Amazon S3 and a GET for image metadata the stack application would use. Once the pre-requisites have been installed and your DynamoDB and SQL credentials have been set, you may deploy this project locally using `php artisan serve`
