# FileManager for Laravel 5 

Custom file manager for Laravel 5

### Version
1.0

### Installation

First require this package:

```sh
composer require infinety/filemanager
```

Then you need to create a custom Filesystem drive on `filesystem.php`:
```php
    'filemanager' => [
        'driver' => 'local',
        'root'   => base_path('public/'),
    ]
```


Add Link for Admin routes:

`url('admin/filemanager')`   


### Todos

 * Better docs

License
----

MIT


