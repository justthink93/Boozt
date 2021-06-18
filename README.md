# Boozt Code Challenge

To setup for first time follow below structures:
  - Install composer and run:
  `composer install`
  - copy .env.example to .env `cp .env.example .env`
  - set .env variables based on your local environment
  - set app/config.php variables based on your environment `APP_DOMAIN` and `APP_INNER_DIRECTORY`
  
  Run migration to create tables
  
```sh
$ php cli-runner.php Migration CreateCustomerTable
$ php cli-runner.php Migration CreateOrderTable
$ php cli-runner.php Migration CreateOrderItemTable
```

 Run database seeder to initial database with sample data
 
 
```sh
$ php cli-runner.php Seeder CustomerOrderOrderItemSeeder
```

Now you can open dashboard _http://yourdomain/innerroute/dashboard_


