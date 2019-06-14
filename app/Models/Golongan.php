<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Golongan extends Model
{
	protected $connection   = 'usersDB';
    protected $table 	= 'golongan';
    protected $guarded 	= ['id', 'created_at', 'updated_at'];
}
