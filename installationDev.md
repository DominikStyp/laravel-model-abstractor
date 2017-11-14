# Installation for local development

## composer.json
```
"repositories": [
        {
            "type": "path",
            "url": "packages-repos/dominikstyp/laravel-model-abstractor",
            "options": {
                "symlink": false
            }
        }
    ],
```

## Installation commands
```
composer require "dominikstyp/laravel-model-abstractor @dev" -vvv
php artisan vendor:publish --provider='\\DominikStyp\\LaravelModelAbstractor\\LaravelModelAbstractorServiceProvider'
```