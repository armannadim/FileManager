<?php
/**
 * Created by PhpStorm.
 * User: NAseq
 * Date: 29/04/2016
 * Time: 12:15
 */

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    protected $table = 'persons';
    protected $primaryKey = 'person_id';

    public function File()
    {
        return $this->hasOne('App\Models\File', 'person_id', 'person_id');
    }
}