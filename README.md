# Laravel-bootstrap-project
To learn how to use **laravel** I thought of a simple web-app to develop. I’ve come to develop a simple **blog** where every user, after registering or logged in, can **create new posts**, **edit** or **delete** existing ones (only if they belong to that user) and **view those of other users**.

## Project structure
All the **back-end** has been done with [laravel](https://laravel.com/), instead the **front-end** has been done with [bootstrap](https://getbootstrap.com/). 

### Back-end
The **main structure** of the project have been made by using the following command

> *composer create-project laravel/laravel name_of_the_project*

All the controllers for laravel have been made with the following command

> *php artisan make:controller ControllerName*

So far i have only created **UserController**, which **handles registration**, **login** and part of the **creation of the posts** and the **PostController**, which **handles all the remaning part of the posts**.

I also modified the **web.php** file in the **routes folder**, which I used for all the links with the various **get and post requests** that you can do.

The **database** i have chosen is a **MySQL** database and i **runned it using XAMPP**. The **structure** of the database has been **made by migrating all the default tables**. You can do this by suing the following command

> *php artisan migrate*

I also needed to create the **Posts table**, so i wrote the following command to create a new table and then i migrated it

> *php artisan make:migration create_users_table*

### Front-end
As i written above, all the front-end part has been done with bootstrap and i runned the following commands to install and configure correctly bootstrap with laravel

> *composer require laravel/ui --dev*

> *php artisan ui bootstrap --auth*

> *npm install bootstrap-icons -save-dev*

> *npm install*

After done this, you can use all the bootstrap classes in your project without any problem

### Running the web-app
For **running the web app** correctly you first need to run the command to build the project correctly

> *npm run build*

Then you need to **run the database** first and then the **server**, which you can do with the following command

> *php artisan serve*

### Future updates (at least for now)
- Improve the security of the web app
- Improve the graphic
- Add a private area where you can change email and password

