# Laravel Model Abstractor
Makes **AbstractModel** inside app/models directory, changes **make:model** command,to generate models which inherit from **AbstractModel**,
and provides php artisan command to move your existing models to app/models directory and change their inheritance to **AbstractModel**.
Thanks to that all your models will inherit from your custom class.<br />

# Installation
```
composer require "dominikstyp/laravel-model-abstractor @dev" -vvv
php artisan vendor:publish --provider='\\DominikStyp\\LaravelModelAbstractor\\LaravelModelAbstractorServiceProvider'
```

## Laravel >= 5.5
Due to package discovery feature introduced in Laravel 5.5, you don't have to add service provider to your providers any more.<br />
## Laravel < 5.5
For Laravel less than 5.5, you must add service provider to your **config/app.php** file, as follows: <br />
```php
 'providers' => [
    // ...
    DominikStyp\LaravelModelAbstractor\LaravelModelAbstractorServiceProvider::class,
    // ...
  ],
```

# Usage
**Laravel Model Abstractor** provides new console tasks: <br />
``` laravel-model-abstractor:list-models ``` Lists all your models which inherit from **Eloquent\Model** <br />
``` laravel-model-abstractor:change-models-inheritance ``` Changes default models inheritance to **AbstractModel**, <br />
and namespaces to **App\Models**, and moves them to **app\Models** directory.<br />
WARNING! This doesn't affect **User** model, because it inherits from **Authenticatable**, so you must change it manually,<br />
along with **config/auth.php - providers section**.<br />

# Example
Let's say you have a model file **app/Dummy1.php** which contains following code: <br />
```php
<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dummy1 extends Model
{
    //
}
```
That model is generated automatically by ```php artisan make:model Dummy1``` command. <br />
But you wish that your model (and others too) would inherit from your **AbstractModel** class like this: <br />
```php
<?php

namespace App\Models;

class Dummy1 extends AbstractModel
{
    //
}
```
With your **AbstractModel** looking like this: <br />
```php
<?php
namespace App\Models;

/**
 * AbstractModel
 *
 */
abstract class AbstractModel extends \Illuminate\Database\Eloquent\Model {
    /** your custom code **/
}
```
All you have to do is invoke ```php artisan laravel-model-abstractor:change-models-inheritance``` and you're done.
