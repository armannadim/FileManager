<?php
/**
 * Created by PhpStorm.
 * User: NAseq
 * Date: 29/04/2016
 * Time: 12:15
 */

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $table = 'files';
    protected $primaryKey = 'file_id';

    public function User()
    {
        return $this->belongsTo('App\User', 'user_id', 'user_id');
    }
    public function Persons()
    {
        return $this->belongsTo('App\Models\Person', 'person_id', 'person_id');
    }

}