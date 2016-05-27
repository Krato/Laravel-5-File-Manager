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
    'defaultRoute'  => 'admin/filemanager',


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