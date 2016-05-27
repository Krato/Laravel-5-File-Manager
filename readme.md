# FileManager for Laravel 5

Custom file manager for Laravel 5

### Version
v2 - You can use with your original Laravel 5 files. Multiple fixes and addons.


### Installation

First require this package:

```sh
composer require infinety-es/filemanager
```

Add the provider on ‘app.php’:
```php
Infinety\FileManager\FileManagerServiceProvider::class,
```

Aliase to `Zipper` is automatic loaded from `FileManagerServiceProvider (It's required to download folders in zip format): 


Publish config, views and public files:
`php artisan vendor:publish --provider="Infinety\FileManager\FileManagerServiceProvider"
`

Then you need to modify options on new file on options `filemanager.php`

```php
<?php

return array(


    /*
    |--------------------------------------------------------------------------
    | Path home for your file manager
    |--------------------------------------------------------------------------
    |
    */
    'homePath'  => public_path(),

    /*
    |--------------------------------------------------------------------------
    | Default routes for your file manager. You can modify here:
    |--------------------------------------------------------------------------
    |
    */
    'defaultRoute'  => 'dashboard/filemanager',


    /*
    |--------------------------------------------------------------------------
    | User middleware. You can use or single string or array based
    |--------------------------------------------------------------------------
    |
    */
    'middleware'  => ['web', 'auth'],


    /*
    |--------------------------------------------------------------------------
    | Use this options if you want to sanitize file and folder names
    |--------------------------------------------------------------------------
    |
    */
    'validName'  => true,

    /*
    |--------------------------------------------------------------------------
    | Files You don't wont to show on File Manager
    |--------------------------------------------------------------------------
    |
    */
    'exceptFiles'   => array( 'robots.txt', 'index.php', '.DS_Store', '.Thumbs.db'),


    /*
    |--------------------------------------------------------------------------
    | Folders names you don't wont to show on File Manager
    |--------------------------------------------------------------------------
    |
    */
    'exceptFolders' => array( 'vendor', 'thumbs', 'filemanager_assets'),


    /*
    |--------------------------------------------------------------------------
    | Folders names you don't wont to show on File Manager
    |--------------------------------------------------------------------------
    |
    */
    'exceptExtensions'  => array( 'php', 'htaccess', 'gitignore'),

    /*
    |--------------------------------------------------------------------------
    | Append tu url. For if you use a custom service to load assets by url. Example here: http://stackoverflow.com/a/36351219/4042595
    |--------------------------------------------------------------------------
    |
    */
    'appendUrl'  => null,


);

?>
```

You can see your new FileManager. Default to: `admin/filemanager`.


### Todos

 * Better docs

### Thanks
Daniel Morales: [dmuploader][1]
SWIS: [contextMenu][2]
Nils Plaschke: [Chumper/Zipper] [3]

---- 
License: MIT




[1]:	https://github.com/danielm/uploader
[2]:	https://github.com/swisnl/jQuery-contextMenu
[3]:    https://github.com/Chumper/Zipper