<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
use Illuminate\Contracts\Filesystem\Factory as Filesystem;

Route::get('/', 'Controller@index');
Route::get('login', 'Controller@login');
Route::get('files/{id}', 'Controller@ShowFiles');
Route::get('file/{dirname}/{fileName}', 'Controller@getFile');


Route::post('add-person', 'Controller@addPerson');
Route::post('add-file', 'Controller@addFile');

Route::get('file1', function (Filesystem $filesystem) {
    return $filesystem->disk('dropbox')->get('test.txt');
});

Route::get('upload', 'Controller@dropboxFileUpload');

Route::get('dropbox', 'Controller@dropbox');
Route::get('db',function()
{
    $filename = '/test.txt';
    $adapter = \Storage::disk('dropbox')->getAdapter();
    $client = $adapter->has($filename);
    //$link = $client->createTemporaryDirectLink($filename);
    return var_dump($client);
});