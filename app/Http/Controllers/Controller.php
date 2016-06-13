<?php

namespace App\Http\Controllers;

use App\Http\Requests\Request;
use App\Models\File;
use App\Models\Person;
use App\Models\User;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Response;
use Storage;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

use Dropbox\WriteMode;

use GrahamCampbell\Flysystem\Facades\Flysystem;
use League\Flysystem\Filesystem;

//use Illuminate\Contracts\Filesystem\Factory as Filesystem;
class Controller extends BaseController
{
    use AuthorizesRequests, AuthorizesResources, DispatchesJobs, ValidatesRequests;

    /* VIEWS */
    public function index(Filesystem $filemanager)
    {

        $data = [];
        $data['persons'] = $this->getPerson();
        $data['users'] = $this->getUser();
        $data['dropbox'] = $this->dropbox($filemanager);
        $data['fileCount'] = $this->getFileNumbers($filemanager);
        return View::make('welcome', $data);
    }


    public function login()
    {
        return View::make('login');
    }

    public function ShowFiles($id, Filesystem $filemanager)
    {
        $data = [];
        $fileOwner = $this->getPersonById($id);
        $data['person'] = $fileOwner;
        $data['files'] = $this->getFileList($fileOwner['name'], $filemanager);
        return View::make('files', $data);
    }


    /* END VIEWS */
    public function getPerson()
    {
        $persons = Person::all()->toArray();
        return $persons;
    }

    public function getPersonById($id)
    {
        $persons = Person::findOrFail($id);
        return $persons;
    }

    public function getUser()
    {
        $users = User::all()->toArray();
        return $users;
    }

    public function dropbox($filemanager)
    {

        //$filemanager->put('filemanager.txt', 'HOla!! Que hace?');
        return $filemanager->listContents('', true);
        return $filemanager->read('filemanager.sql'); //if I use League/FlySystem then it would be read else it'll be get
    }

    public function getFileNumbers($filemanager)
    {
        $person = $this->getPerson();
        $files = [];
        foreach ($person as $p) {
            $files[$p['name']] = $filemanager->listContents($p['name']);
        }
        return $files;
    }

    public function getFileList($dirname, $filemanager)
    {
        $files = $filemanager->listContents($dirname);

        return $files;
    }

    public static function getFile($dirname, $fileName)
    {
        $adapter = Storage::getAdapter();
        $client = $adapter->getClient();
        $link = $client->createTemporaryDirectLink('/' . $dirname . '/' . $fileName);
        return $link[0];
    }


    public function addPerson()
    {
        $name = Input::get('name');
        // getting all of the post data
        $file = array('image' => Input::file('photo'));
        // setting up rules
        $rules = array('image' => 'required',); //mimes:jpeg,bmp,png and for max size max:10000
        // doing the validation, passing post data, rules and the messages
        $validator = Validator::make($file, $rules);
        if ($validator->fails()) {
            // send back to the page with the input data and errors
            return Redirect::to('upload')->withInput()->withErrors($validator);
        } else {
            // checking file is valid.
            if (Input::file('photo')->isValid()) {
                $destinationPath = 'assets/images/persons'; // upload path
                $extension = Input::file('photo')->getClientOriginalExtension(); // getting image extension
                $fileName = $name . '.' . $extension; // renameing image
                Input::file('photo')->move($destinationPath, $fileName); // uploading file to given path
                // sending back with message
                Session::flash('success', 'Upload successfully');
                $person = new Person();
                $person['name'] = $name;
                $person['image'] = $fileName;
                $person->save();
                return Redirect::to('/');
            } else {
                // sending back with error message.
                Session::flash('error', 'uploaded file is not valid');
                return Redirect::to('/');
            }
        }
    }

    public function addFiles(){

    }

    //Exmaple of file upload to dropbox.... not tested yet
    public function dropboxFileUpload(Filesystem $filemanager)
    {
        //$Client = new Client(env('DROPBOX_TOKEN'), env('DROPBOX_SECRET'));

        $file = fopen(public_path('assets/images/logo.png'), 'rb');
        $size = filesize(public_path('assets/images/logo.png'));
        $dropboxFileName = '/myphoto4.png';

        //$filemanager->uploadFile($dropboxFileName,WriteMode::add(),$file, $size);
        $filemanager->put($dropboxFileName, file_get_contents(Request::file('file')->getRealPath()));
        //$Client->uploadFile($dropboxFileName,WriteMode::add(),$file, $size);
        //$links['share'] = $Client->createShareableLink($dropboxFileName);
        //$links['view'] = $Client->createTemporaryDirectLink($dropboxFileName);

        //$links['share'] = $filemanager->createShareableLink($dropboxFileName);
        //$links['view'] = $filemanager->createTemporaryDirectLink($dropboxFileName);
        //print_r($links);
    }

}