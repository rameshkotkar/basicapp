Yii 2 Basic With login/logout, reset password
============================

Basic app is created from Yii 2 Basic template but add custom login, reset password, change password and profile updates with mysql db migrate and create default user administrator to login


DIRECTORY STRUCTURE
-------------------

      assets/             contains assets definition
      components/         contains component classes
      console/            contains console commands (controllers)
      config/             contains application configurations
      controllers/        contains Web controller classes
      mail/               contains view files for e-mails
      models/             contains model classes
      runtime/            contains files generated during runtime
      tests/              contains various tests for the basic application
      vendor/             contains dependent 3rd-party packages
      views/              contains view files for the Web application
      themes/             contains different themes

  Note: Web folder is removed and web content is set to root folder for simplicity

REQUIREMENTS
------------

The minimum requirement by this project template that your Web server supports PHP 5.4.0.


INSTALLATION
------------

### Install from an Archive File

Extract the archive file downloaded  from git as zip to
a directory named `basicapp` that is directly under the Web root.


### Install via Composer

If you do not have [Composer](http://getcomposer.org/), you may install it by following the instructions
at [getcomposer.org](http://getcomposer.org/doc/00-intro.md#installation-nix).

You can then install this project template using the following command:

~~~
php composer.phar global require "fxp/composer-asset-plugin:~1.1.1"
php composer.phar create-project --prefer-dist --stability=dev yiisoft/yii2-app-basic basic
~~~

If Git install excute command in your server root directory
git clone https://github.com/rameshkotkar/basicapp.git


Now you should be able to access the application through the following URL, assuming `basicapp` is the directory
directly under the Web root.

~~~
http://localhost/basicapp/
~~~


CONFIGURATION
-------------

### Database

Create Database "basicapp" in mysql, name can be different but set same as in db.php file.

Edit the file `config/db.php` with real data, for example:

```php
return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=basicapp',
    'username' => 'root',
    'password' => '',
    'charset' => 'utf8',
];
```
Execute ./yii migrate or yii migrate command to update the database and create admin user

  Login details for Administrator:
  username: admin@example.com
  Password: admin123

**NOTES:**
- Check and edit the other files in the `config/` directory to customize your application as required.
- Refer to the README in the `tests` directory for information specific to basic application tests.
