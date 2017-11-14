# Laravel Model Abstractor
Makes **AbstractModel** inside app/models directory, changes **make:model** command,to generate models which inherit from **AbstractModel**,
and provides php artisan command to move your existing models to app/models directory and change their inheritance to **AbstractModel**.
Thanks to that all your models will inherit from your custom class.<br />

# Installation
```
composer require "dominikstyp/laravel-model-abstractor @dev" -vvv
php artisan vendor:publish --provider='\\DominikStyp\\LaravelModelAbstractor\\LaravelModelAbstractorServiceProvider'
```

# Usage
**Laravel Model Abstractor** provides new console tasks: <br />
``` laravel-model-abstractor:list-models ``` Lists all your models which inherit from **Eloquent\Model** <br />
``` laravel-model-abstractor:change-models-inheritance ``` Changes default models inheritance to **AbstractModel**, <br />
and namespaces to **App\Models**, and moves them to **app\Models** directory.<br />
WARNING! This doesn't affect **User** model, because it inherits from **Authenticatable**, so you must change it manually,<br />
along with **config/auth.php - providers section**.<br />

