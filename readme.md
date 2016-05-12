# FileManager for Laravel 5

Custom file manager for Laravel 5

### Version
1.2 - Still in beta. Some functions may not work.

### Installation

First require this package:

```sh
composer require infinety/filemanager
```

Add the provider on ‘app.php’:
```php
Infinety\FileManager\FileManagerServiceProvider::class,
Chumper\Zipper\ZipperServiceProvider:class
```

And aliase to Zipper (It's required to download folders in zip format): 
```php
'Zipper' => Chumper\Zipper\Zipper::class
```

Publish config and public files:
`php artisan vendor:publish --provider="Infinety\FileManager\FileManagerServiceProvider"
`

Then you need to modify options on new file on options `file manager.php`

Add Link for Admin routes:

`url('admin/filemanager')`  


### Todos

 * Better docs

### Thanks
Daniel Morales: [dmuploader][1]
SWIS: [contextMenu][2]

---- 
License: MIT




[1]:	https://github.com/danielm/uploader
[2]:	https://github.com/swisnl/jQuery-contextMenu