# # CodeIgniter 4 RESTapi Server

CodeIgniter 4 RESTapi Server based on YouTube tutorial

> https://www.youtube.com/watch?v=qPefoRbsfMc&list=PLYogo31AXFBN23O7wHgQv7eI7Qf84nj4W

## 1. Clone to you XAMPP/WAMP directory

navigate inside your project folder using command line/terminal and run:

> composer install

## 2. Create a database in your phpMyAdmin

Once you create your db import restapi.sql

This mysql dump has some dummy data such as:

#### In oauth_clients table you already have

Client id: testclient

Client secret: testsecret

You should change this credentials to your own randomly generated keys

#### In users table you already have

User: Alex Lancer

Email: test@alexlancer.com

Password: password

#### oauth_users

not in use because in the tutorial we created custom Storage driver and used our own table for storing the users which is named 'users' instead of the default table 'oauth_users'

## 3. Time to setup your .env file

1. Duplicate `env` file and uncomment all `database.default` lines and set you database connection details
2. Add new line after `database.default.DBDriver = MySQLi`
   > database.default.DSN = 'mysql:dbname=ADD_YOUR_DB_NAME;host=localhost'
3. Uncomment and set app.baseURL

## 4. Setup your server to point into public folder of CodeIgniter

Watch this video: https://www.youtube.com/watch?v=qPefoRbsfMc&t=320s

### You're good to GO!!!
